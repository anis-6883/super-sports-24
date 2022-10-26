<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Utilities\Overrider;
use App\Models\Subscription;
use App\Models\Payment;

use Cache;

class SubscriptionController extends Controller
{
    public function subscriptions(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'app_id' => 'required',
            'platform' => 'nullable',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->first()]);
        }

        $app_unique_id = $request->app_id;
        $platform = $request->platform;

        $subscriptions = Cache::rememberForever("subscriptions_{$app_unique_id}_{$platform}", function () use ($app_unique_id, $platform){

            $where = [];

            $where['status'] = 1;
            if($platform != ''){
                $where['platform'] = $platform;
            }

            $subscriptions = Subscription::whereHas('app', function($query) use($app_unique_id) {
                                            $query->where('app_unique_id', $app_unique_id);
                                        })
                                        ->where($where)
                                        ->orderBy('position', 'ASC')
                                        ->get()
                                        ->makeHidden(['app_id', 'status', 'created_at', 'updated_at', 'position']);
            return $subscriptions;
        });
        
        $status = true;

        return response()->json(['status' => $status, 'data' => $subscriptions]);
    }

    public function subscription_update(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'subscription_id' => 'required|string',
            'amount' => 'required|string',
            'platform' => 'required|string|max:20',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->first()]);
        }

        $user = $request->user();
        $subscription = Subscription::find($request->subscription_id);


        if($user->expired_at != null && $user->expired_at > now()){
            $expired_at = $user->expired_at;
            $date = date("Y-m-d H:i:s", strtotime("+{$subscription->duration} {$subscription->duration_type}", \Carbon\Carbon::parse($expired_at)->timestamp));
        }else{
            $date = date("Y-m-d H:i:s", strtotime("+{$subscription->duration} {$subscription->duration_type}", now()->timestamp));
        }

        $user->expired_at = $date;
        $user->subscription_id = $subscription->id;

        $user->save();

        $payment = new Payment();

        $payment->user_id = $user->id;
        $payment->subscription_id = $subscription->id;
        $payment->date = now();
        $payment->amount = $request->amount;
        $payment->platform = $request->platform;
        $payment->app_id = $user->app_id;

        $payment->save();

        Cache::forget("payments_{$user->id}");

        $user->email = $user->display_email;
        $user->subscription_name = $user->subscription->name;

        $this->send_message($payment);
        
        return response()->json([
            'status' => true,
            'data' => $user->makeHidden(['id', 'user_type', 'created_at', 'updated_at', 'apps', 'app_id', 'email_verified_at', 'status', 'subscription']),
        ]);
    }

    public function subscription_expired(Request $request)
    {
        $user = $request->user();

        $user->subscription_id = 0;
        //$user->expired_at = date('Y-m-d');

        $user->save();

        $user->email = $user->display_email;
        $user->subscription_name = $user->subscription->name;
        
        return response()->json([
            'status' => true,
            'data' => $user->makeHidden(['id', 'user_type', 'created_at', 'updated_at', 'apps', 'app_id', 'email_verified_at', 'status', 'subscription']),
        ]);
    }

    public function subscription_restore(Request $request)
    {
        $validator = \Validator::make($request->all(), [

            'product_id' => 'required|string',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->first()]);
        }

        $user = $request->user();

        $subscription = Subscription::where('product_id', $request->product_id)
                                        ->where('app_id', $user->app_id)
                                        ->first();
        if(!$subscription){
            return response()->json(['result' => false, 'message' => 'Product not found.']);
        }

        $payments = Payment::where('user_id', $user->id)
                            ->where('subscription_id', $subscription->id)
                            ->first();
        if(!$payments){
            return response()->json(['result' => false, 'message' => 'illegal activity.']);
        }
                      
        

        if($user->expired_at != null && $user->expired_at > now()){
            $expired_at = $user->expired_at;
            $date = date("Y-m-d H:i:s", strtotime("+{$subscription->duration} {$subscription->duration_type}", \Carbon\Carbon::parse($expired_at)->timestamp));
        }else{
            $date = date("Y-m-d H:i:s", strtotime("+{$subscription->duration} {$subscription->duration_type}", now()->timestamp));
        }

        $user->expired_at = $date;
        $user->subscription_id = $subscription->id;

        $user->save();

        $user->email = $user->display_email;
        $user->subscription_name = $user->subscription->name;
        
        return response()->json([
            'status' => true,
            'user' => $user->makeHidden(['id', 'user_type', 'created_at', 'updated_at', 'apps', 'app_id', 'email_verified_at', 'status', 'subscription']),
        ]);
    }

    public function payments(Request $request)
    {
        $user = $request->user();
        $payments = Cache::rememberForever("payments_{$user->id}", function () use ($user){
            $payments = Payment::select('date', 'amount', 'subscriptions.name AS subscription_name', 'duration', 'duration_type')
                                        ->join('subscriptions', 'subscriptions.id', 'subscription_id')
                                        ->where('user_id', $user->id)
                                        ->orderBy('payments.id', 'DESC')
                                        ->get();
            return $payments;
        });
        
        $status = true;

        return response()->json(['status' => $status, 'data' => $payments]);
    }

    public function send_message($payment)
    {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        // Timezone
        config(['app.timezone' => get_option('timezone')]);

        // Email
        config(['mail.driver' => 'smtp']);
        config(['mail.from.name' => $payment->app->from_name]);
        config(['mail.from.address' => $payment->app->from_mail]);
        config(['mail.host' => $payment->app->smtp_host]);
        config(['mail.port' => $payment->app->smtp_port]);
        config(['mail.username' => $payment->app->smtp_username]);
        config(['mail.password' => $payment->app->smtp_password]);
        config(['mail.encryption' => $payment->app->smtp_encryption]);
        
        $mail  = new \stdClass();
        $mail->name = $payment->user->name;
        $mail->email = $payment->user->display_email;
        $mail->subject = 'Subscription Invoice';
        $mail->message = 'Subscription Invoice';
        $mail->payment = $payment;
        
        if($payment->user->display_email != ''){
            try{
                Mail::to($payment->user->display_email)->send(new InvoiceMail($mail));      
                return json_encode(array('result' => true, 'message' => _lang('Your Message send sucessfully.')));
            }catch (\Exception $e) {
                return json_encode(array('result' => false, 'message' => _lang('Error Occured, Please try again !')));
            }        
        }
    }
}
