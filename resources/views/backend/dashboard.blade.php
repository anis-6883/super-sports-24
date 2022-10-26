@extends('layouts.app')
@section('content')
{{-- <div class="row">
<div class="col-md-4">
<div class="card card-secondary">
<div class="card-body skew-shadow">
<h1>{{ counter('orders') }}</h1>
<h5 class="op-8">{{ _lang('Total Orders') }}</h5>
<div class="pull-right">
<h3 class="fw-bold op-8">{{ _lang('Lifetime') }}</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-dark bg-secondary-gradient">
<div class="card-body bubble-shadow">
@php
$query = \DB::select("SELECT IFNULL(SUM(total - (IFNULL((SELECT SUM(purchase_price) FROM order_items WHERE orders.id = order_items.order_id), '0.00'))), '0.00') AS profit FROM `orders`")
@endphp
<h1>{{ get_option('currency') }} {{ isset($query[0]) ? $query[0]->profit : '0.00' }}</h1>
<h5 class="op-8">{{ _lang('Total Profit') }}</h5>
<div class="pull-right">
<h3 class="fw-bold op-8">{{ _lang('Lifetime') }}</h3>
</div>
</div>
</div>
</div>
<div class="col-md-4">
<div class="card card-dark bg-secondary2">
<div class="card-body curves-shadow">
<h1>{{ counter('users', ['user_type' => 'customer']) }}</h1>
<h5 class="op-8">{{ _lang('Total Customers') }}</h5>
<div class="pull-right">
<h3 class="fw-bold op-8">{{ _lang('Lifetime') }}</h3>
</div>
</div>
</div>
</div>
</div> --}}
{{-- <div class="row row-card-no-pd">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-coins text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">{{ _lang('Total Sales') }}</p>
                            @php
                            $oders = \App\Order::where('status', 1)->sum('total');
                            @endphp
                            <h4 class="card-title">{{ get_option('currency') }} {{ $oders }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-cart text-success"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">{{ _lang('Total Orders') }}</p>
                            <h4 class="card-title">{{ counter('orders') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-box text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">{{ _lang('Total Products') }}</p>
                            <h4 class="card-title">{{ counter('products', ['status' => '1']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="flaticon-users text-primary"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category">{{ _lang('Total Customers') }}</p>
                            <h4 class="card-title">{{ counter('users', ['user_type' => 'customer']) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="orders"></div>
                </figure>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="card-heading">
                    <div class="card-title" >
                        <h3>{{ _lang('Latest Orders') }}</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>

                                <th>{{ _lang('Customer') }}</th>
                                <th>{{ _lang('Sub Total') }}</th>
                                <th>{{ _lang('Delivery Charge') }}</th>
                                <th>{{ _lang('Total') }}</th>
                                <th>{{ _lang('Profit') }}</th>
                                <th>{{ _lang('Status') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $currency = get_option('currency')
                            @endphp
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    #{{ sprintf("%06d", $order->id) }}
                                </td>
                                <td>
                                    {{ $order->customer->user->first_name . ' ' . $order->customer->user->last_name }}
                                </td>
                                <td>{{ "$currency $order->sub_total" }}</td>
                                <td>{{ "$currency $order->delivery_charge" }}</td>
                                <td>{{ "$currency $order->total" }}</td>
                                <td>{{ $order->status == 1 ? "$currency " . profit($order->id) : '' }}</td>
                                <td>
                                    @if ($order->status == 0)
                                    {!! status(_lang('Pending'), 'warning') !!}
                                    @elseif ($order->status == 1)
                                    {!! status(_lang('Accepted'), 'success') !!}
                                    @elseif ($order->status == 2)
                                    {!! status(_lang('Rejected'), 'danger') !!}
                                    @elseif ($order->status == 3)
                                    {!! status(_lang('Canceled'), 'danger') !!}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @if ($orders->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">{{ _lang('No data available in table') }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection


{{-- @section('js-script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('orders', {
        chart: {
            type: 'line'
        },
        title: {
            text: '{{ _lang('Yearly orders') }} - {{ date('Y') }}'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        // yAxis: {
        //     title: {
        //         text: '{{ _lang('All expenses are in') }} ({{ get_option('currency') }})'
        //     }
        // },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'orders',
            data: {{ $yearly_orders }}
        }]
    });
</script>
@stop --}}