<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('email', 191)->unique();
            $table->string('phone', 30)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->string('user_type', 100);
            $table->string('image', 191)->default('public/default/profile.png');
            $table->longText('apps')->nullable();
            $table->bigInteger('app_id')->nullable();
            $table->string('provider', 191)->default('email');
            $table->bigInteger('subscription_id')->default(0);
            $table->string('expired_at', 191)->nullable();
            $table->string('device_token', 191)->nullable();
            $table->integer('status')->default(1);
            $table->rememberToken();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
