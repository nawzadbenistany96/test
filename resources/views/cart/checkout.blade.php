@extends('layouts.app')

@section('styles')
<style>
  .StripeElement {
    box-sizing: border-box;

    padding: 16px 16px;

    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: white;

    box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
  }

  .StripeElement--focus {
    box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .StripeElement--invalid {
    border-color: #fa755a;
  }

  .StripeElement--webkit-autofill {
    background-color: #fefde5 !important;
  }

  #card-errors {
    color: #fa755a;
  }
</style>
@endsection


@section('content')
@if ($number > 0)
<div class="container">
  <div class="row">
    <div id="test">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 col-md-8 col-lg-7 mb-5">
      <h3>{{__('Shipping Information')}}</h3>
      <form action="{{ route('orders.store') }}" method="POST" id="payment-form">
        @csrf
        <!-- FullName Field -->
        <div class="form-group">
          <label for="full_name">{{__('Full Name')}}</label>
          <input type="text" name="shipping_fullname" id="full_name"
            class="form-control @error('shipping_fullname') is-invalid @enderror"
            placeholder="{{__('Your Complete Name')}}" value="{{ old('shipping_fullname') }}" required
            autocomplete="email">
          @error('shipping_fullname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!--
                <div class="form-group">
                    <div class="form-group">
                      <label for="zipcode">ZIP Code</label>
                      <select class="form-control" name="zip" id="zipcode">
                        <option>42001</option>
                        <option>42002</option>
                        <option>42003</option>
                      </select>
                      <small>This is Optional</small>
                    </div>
                </div>
            -->

        <!-- Full Address Field -->
        <div class="form-group">
          <label for="address">{{__('Full Address')}}</label>
          <input type="text" name="shipping_fulladdress" id="address"
            class="form-control @error('shipping_fulladdress') is-invalid @enderror" placeholder="Zakho Tilkabar"
            value="{{ old('shipping_fulladdress') }}" required autocomplete="shipping_fulladdress">
          @error('shipping_fulladdress')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <!-- Cities Field -->
        <div class="form-group">
          <label for="cities">{{__('City')}}</label>
          <select name="shipping_city" id="cities" class="form-control @error('shipping_city') is-invalid @enderror"
            required>
            <option value="" selected disabled>
              {{ __('Please Select The City') }}
            </option>
            @foreach ($cities as $city)
            <option value={{ $city->getTranslatedAttribute('slug',app()->getLocale(),false) }}>
              {{ $city->getTranslatedAttribute('name',app()->getLocale(),false) }} :
              {{ $city->price.'  '.__('IQD') }}
            </option>
            @endforeach
          </select>
          @error('shipping_city')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Mobile Field -->
        <div class="form-group">
          <label for="mb">{{__('Mobile')}}</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="my-addon">+964</span>
            </div>
            <input class="form-control @error('shipping_mobile') is-invalid @enderror" type="text"
              name="shipping_mobile" placeholder="{{__('Your Phone Number')}}" id="mb"
              value="{{ old('shipping_mobile') }}" required autocomplete="shipping_mobile" />
            @error('shipping_mobile')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <!-- Payment Methods -->
        <div class="form-group">
          <label>{{__('Payment Method')}}</label>

          <div class="form-check">

            <input type="radio" name="payment_method"
              class="form-check-input @error('payment_method') is-invalid @enderror" value="cash_on_delivery"
              id="cashondelivery">
            <label for="cashondelivery">{{__('Cash On Delivery')}}</label>
            @error('payment_method')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-3" id="complete-order">{{__('Place Order')}}</button>
      </form>
    </div>

    <!-- Cart items and delivery -->
    <div class="col-sm-12 col-md-4 order-md-2 col-lg-5 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">{{__('Your Cart')}}</span>
        <span class="badge badge-secondary badge-pill">
          {{ App\Models\Cart::where('user_id',Auth::user()->id)->count() }}
        </span>
      </h4>
      <ul class="list-group mb-3">
        @foreach ($carts as $cart)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{ $cart->pro_name }}</h6>
            <small class="text-muted">{{ $cart->qty }}</small>
          </div>
          <span class="text-muted">{{ $cart->sum_price }} {{__('IQD')}}</span>
        </li>
        @endforeach
        <br>
        <li class="list-group-item d-flex justify-content-between">
          <span style="font-weight: bold;">{{__('Delivery')}}</span>
          <!-- Just for first time when user come this page this will appear -->
          <span id="cityPriceFirstTime">
            <strong>
              {{ __('Please Select The City') }}
            </strong>
          </span>
          <!-- in here we will display the city price -->
          <span id="cityPriceSecondTimeAjax">
            <strong id="displayCityPrice">

            </strong>
            <strong>{{__('IQD')}}</strong>
          </span>

        </li>
        <li class="list-group-item d-flex justify-content-between" style="font-weight: bolder;">
          <span>{{__('Total (IQD)')}}</span>
          <span>
            <strong id="displayPriceReady">
              {{ $cart_Total }}
            </strong>
            <strong id="displayPriceAjax">

            </strong>
            {{__('IQD')}}
          </span>
        </li>
      </ul>



    </div>
  </div>
</div>
@else
<div class="container">
  <div class="row">
    <p class="badge badge-danger" style="font-size: 25px;">
      {{ __('You Have No Items In Your Cart Please Go Back And Buy Some Item Of Products') }}
    </p>
  </div>
</div>
@endif

@endsection

@section('scripts')
<script src="/js/jquery.min.js"></script>


<!-- For Selcecting City Using Ajax -->
<script>
  $('#cities').change(function(){
    $("#cityPriceSecondTimeAjax").show();
    $("#cityPriceFirstTime").hide();
    $('#displayPriceReady').hide();
    $('#displayPriceAjax').show();
  let slugname = $(this).val();
  $.post(
    '{{ route('ajaxCity') }}',
    {
      slug:slugname,
      _token:'{{ csrf_token() }}'
    },function(response){
      $("#displayCityPrice").text(response);
    }
  );
  $.post(
    '{{ route('totalPrice') }}',
    {
      _token:'{{ csrf_token() }}'
    },function(response){
      $("#displayPriceAjax").text(response);
    }
  );
});
</script>
<script>
  $(document).ready(function(){
    $("#cityPriceFirstTime").show();
    $("#cityPriceSecondTimeAjax").hide();
    $('#displayPriceReady').show();
    $('#displayPriceAjax').hide();
    $('#showcards').hide();
    $('#cashondelivery').click(function(){
        $('#showcards').hide('slow');
    });
    $('#paypal').click(function(){
        $('#showcards').hide('slow');
    });
    $('#striperbtn').click(function(){
        $('#showcards').show('slow');
    });
});
</script>

@endsection