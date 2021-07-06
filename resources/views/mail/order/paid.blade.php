@component('mail::message')
<h1 style="text-align: center;">{{ __('Your Order Details') }}</h1>

{{ __('Thanks For Your Purchase') }}

@component('mail::panel')
{{ __('Please Do Not Remove This Message') }}
@endcomponent

{{ __('Here is Your Reciept') }}
{{ __('Your Order Number') }} : {{ $order->order_number}}

@component('mail::table')
@foreach ($order->carts as $item)
<table class="table table-bordered">
    <tr>
        <th>{{ __('Product Name') }}</th>
        <th>{{ __('Quantity') }}</th>
        <th>{{ __('Price') }}</th>
    </tr>
    <tr>
        <td>{{ $item->pro_name }}</td>
        <td>{{ $item->pivot->quantity }}</td>
        <td>{{ $item->pivot->price .'  '. __('IQD')}}</td>
    </tr>
</table>
@endforeach
@endcomponent

{{ __('Delivery') }} : {{ $city->price .'  '. __('IQD')}}

{{ __('Total') }} : {{ $order->grand_total .'  '. __('IQD')}}


{{ config('app.name') }}
@endcomponent