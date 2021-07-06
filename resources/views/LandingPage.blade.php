@extends('layouts.app')
@section('styles')
<style>
  .owl-carousel .item {
    height: 20rem;
    width: 12rem;
    background: #4DC7A0;
    margin: 10px;
  }

  .owl-carousel-someproducts .item {
    height: 20rem;
    width: 12rem;
    background: #4DC7A0;
    margin: 10px;
  }
</style>
@endsection

@section('scripts')
<script src="/js/jquery1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css">
<script>
  jQuery(document).ready(function($){
    $('#someproducts').owlCarousel({
      loop:true,
      margin:10,
      //nav:false,
      autoplay:true,
      autoplayTimeout:5000,
      //dots: true,
      stagePadding: 40,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:1
        },
        700:{
          items:2
        },
        1000:{
          items:3
        },
        1200:{
          items:4
        }
      }
    })
    $('.owl-carousel').owlCarousel({
      loop:false,
      margin:10,
      nav:false,
      autoplay:false,
      autoplayTimeout:5000,
      dots: true,
      stagePadding: 50,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:2
        },
        1000:{
          items:3
        },
        1200:{
          items:4
        }
      }
    })
  })
</script>
@endsection

@section('content')
<div class="container">
  @if (session('success'))
  <div class="alert alert-success w-100 text-center" role="alert">
    {{ __(session('success')) }}
  </div>
  @endif
  <!-- Start Product Slider -->
  <div class="owl-carousel owl-theme mt-3"
    style="background: linear-gradient(90deg,rgba(2,0,.6,1) 0%,rgba(9,9,121,1) 35%,rgba(2,0,.6,1) 100%);padding:10px;border-radius: 13px;">
    <div class="item">
      <div class="card">
        <img class="card-img-top" src="/images/1.jpg" alt="Card image cap" style="height: 200px" />
        <span class="badge badge-danger rounded-circle p-2"
          style="position: absolute;top: 10px;right: 20px;">{{__('New')}}</span>
        <div class="card-body">
          <h5 class="card-title text-center">Card title</h5>
          <span class="card-text">
            <h5 style="text-align: center;">
              <span style="text-decoration: line-through">35$</span>
              <span>-</span>
              <span>25$</span>
            </h5>
          </span>
          <a href="#" class="btn btn-primary btn-sm" style="width: 100px;margin-left:25px;">{{__('Buy Now')}}</a>
        </div>

      </div>
    </div>
    <div class="item">
      <h4>2</h4>
    </div>
    <div class="item">
      <h4>3</h4>
    </div>
    <div class="item">
      <h4>4</h4>
    </div>
    <div class="item">
      <h4>5</h4>
    </div>
    <div class="item">
      <h4>6</h4>
    </div>
    <div class="item">
      <h4>7</h4>
    </div>
    <div class="item">
      <h4>8</h4>
    </div>
    <div class="item">
      <h4>9</h4>
    </div>
    <div class="item">
      <h4>10</h4>
    </div>
    <div class="item">
      <h4>11</h4>
    </div>
    <div class="item">
      <h4>12</h4>
    </div>

  </div>
  <!-- End Product Slider -->

  <!-- Start Jumbotron -->
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron mt-3">
        <h1 class="display-4">Hello, world!</h1>
        <p class="lead">
          This is a simple hero unit, a simple jumbotron-style component for
          calling extra attention to featured content or information.
        </p>
        <hr class="my-4" />
        <p>
          It uses utility classes for typography and spacing to space
          content out within the larger container.
        </p>
        <a class="btn btn-primary btn-lg" href="{{ route('shop.index',app()->getLocale()) }}"
          role="button">{{__('Go To Shopping')}}</a>
      </div>
    </div>
  </div>
  <!-- Start Jumbotron -->

  <h2 class="p-3">{{__('Some Of Our Products')}}</h2>
  <!-- Start Some Products-->
  <div class="owl-carousel owl-theme mt-3" id="someproducts"
    style="background: linear-gradient(90deg,rgba(2,0,.6,1) 0%,rgba(9,9,121,1) 35%,rgba(2,0,.6,1) 100%);padding:10px;border-radius: 13px;">
    <div class="item">
      <div class="card text-center">
        <img class="card-img-top" src="/images/1.jpg" alt="Card image cap" style="height: 200px" />
        <span class="badge badge-danger rounded-circle p-2"
          style="position: absolute;top: 10px;right: 20px;">{{__('New')}}</span>
        <div class="card-body">
          <h5 class="card-title text-center">Card title</h5>
          <span class="card-text">
            <h5 style="text-align: center;">
              <span style="text-decoration: line-through">35$</span>
              <span>-</span>
              <span>25$</span>
            </h5>
          </span>
          <a href="#" class="btn btn-primary btn-sm" style="width: 100px;">{{__('Buy Now')}}</a>
        </div>

      </div>
    </div>
    <div class="item">
      <h4>2</h4>
    </div>
    <div class="item">
      <h4>3</h4>
    </div>
    <div class="item">
      <h4>4</h4>
    </div>
    <div class="item">
      <h4>5</h4>
    </div>
    <div class="item">
      <h4>6</h4>
    </div>
    <div class="item">
      <h4>7</h4>
    </div>
    <div class="item">
      <h4>8</h4>
    </div>
    <div class="item">
      <h4>9</h4>
    </div>
    <div class="item">
      <h4>10</h4>
    </div>
    <div class="item">
      <h4>11</h4>
    </div>
    <div class="item">
      <h4>12</h4>
    </div>

  </div>
  <!-- End Some Products-->

  <br />

  <!-- Start Tabs-->
  <div class="row">
    <div class="col-md-12">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs md-tabs nav-justified primary-color p-1" role="tablist">
        <li class="nav-item">
          <a class="nav-link active btn btn-secondary" data-toggle="tab" href="#panel555" role="tab">
            {{__('Our New Products')}}
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-success" data-toggle="tab" href="#panel666" role="tab">
            {{__('Special Products')}}
          </a>
        </li>
      </ul>
      <!-- Nav tabs -->

      <!-- Tab panels -->
      <div class="tab-content">
        <!-- Panel 1  Our New Products -->
        <div class="tab-pane fade in show active" id="panel555" role="tabpanel">
          <!-- Nav tabs -->
          <div class="owl-carousel owl-theme mt-3 custom"
            style="background: linear-gradient(90deg,rgba(2,0,.6,1) 0%,rgba(9,9,121,1) 35%,rgba(2,0,.6,1) 100%);padding:10px;border-radius: 13px;">
            <div class="item">
              <div class="card text-center">
                <img class="card-img-top" src="/images/1.jpg" alt="Card image cap" style="height: 200px" />
                <span class="badge badge-danger rounded-circle p-2"
                  style="position: absolute;top: 10px;right: 20px;">{{__('New')}}</span>
                <div class="card-body">
                  <h5 class="card-title text-center">Card title</h5>
                  <span class="card-text">
                    <h5 style="text-align: center;">
                      <span style="text-decoration: line-through">35$</span>
                      <span>-</span>
                      <span>25$</span>
                    </h5>
                  </span>
                  <a href="#" class="btn btn-primary btn-sm" style="width: 100px;">{{__('Buy Now')}}</a>
                </div>

              </div>
            </div>
            <div class="item">
              <h4>2</h4>
            </div>
            <div class="item">
              <h4>3</h4>
            </div>
            <div class="item">
              <h4>4</h4>
            </div>
            <div class="item">
              <h4>5</h4>
            </div>
            <div class="item">
              <h4>6</h4>
            </div>
            <div class="item">
              <h4>7</h4>
            </div>
            <div class="item">
              <h4>8</h4>
            </div>
            <div class="item">
              <h4>9</h4>
            </div>
            <div class="item">
              <h4>10</h4>
            </div>
            <div class="item">
              <h4>11</h4>
            </div>
            <div class="item">
              <h4>12</h4>
            </div>

          </div>
          <!-- Nav tabs -->
        </div>
        <!-- Panel 1 -->

        <!-- Panel 2 Special Products Discounts -->
        <div class="tab-pane fade" id="panel666" role="tabpanel">
          <div class="owl-carousel owl-theme mt-3 custom"
            style="background: linear-gradient(90deg,rgba(2,0,.6,1) 0%,rgba(9,9,121,1) 35%,rgba(2,0,.6,1) 100%);padding:10px;border-radius: 13px;">
            <div class="item">
              <div class="card text-center">
                <img class="card-img-top" src="/images/1.jpg" alt="Card image cap" style="height: 200px" />
                <span class="badge badge-danger rounded-circle p-2"
                  style="position: absolute;top: 10px;right: 20px;">{{__('New')}}</span>
                <div class="card-body">
                  <h5 class="card-title text-center">Card title</h5>
                  <span class="card-text">
                    <h5 style="text-align: center;">
                      <span style="text-decoration: line-through">35$</span>
                      <span>-</span>
                      <span>25$</span>
                    </h5>
                  </span>
                  <a href="#" class="btn btn-primary btn-sm" style="width: 100px;">{{__('Buy Now')}}</a>
                </div>

              </div>
            </div>
            <div class="item">
              <h4>2</h4>
            </div>
            <div class="item">
              <h4>3</h4>
            </div>
            <div class="item">
              <h4>4</h4>
            </div>
            <div class="item">
              <h4>5</h4>
            </div>
            <div class="item">
              <h4>6</h4>
            </div>
            <div class="item">
              <h4>7</h4>
            </div>
            <div class="item">
              <h4>8</h4>
            </div>
            <div class="item">
              <h4>9</h4>
            </div>
            <div class="item">
              <h4>10</h4>
            </div>
            <div class="item">
              <h4>11</h4>
            </div>
            <div class="item">
              <h4>12</h4>
            </div>

          </div>
        </div>
        <!-- Panel 2 -->
      </div>
      <!-- Tab panels -->
    </div>
  </div>
  <!-- End Tabs-->

</div>
@endsection