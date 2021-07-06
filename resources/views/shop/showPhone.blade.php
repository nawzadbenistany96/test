@extends('layouts.app')

@section('styles')
<style>
    .glass {
        border-radius: 50%;
        border: 2px solid white;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('/js/jquery1.min.js') }}"></script>
<script src="{{ asset('/js/zoomsl.js') }}"></script>
<script>
    $('.small_img').hover(function(){
            $('.main_img').attr('src', $(this).attr('src'));
        });
    $('.main_img').imagezoomsl(
        {
        zoomrange:[2,30],
        innerzoommagnifier:true,
        classmagnifier:'glass',
        magnifiersize:[180,180],
        }
        );

</script>
@endsection

@section('content')

<div class="container">
    @if (session('fail'))
    <div class="alert alert-danger">
        {{ __(session('fail')) }}
    </div>
    @endif
    <div class="row">
        <!-- Display Images -->
        <div class="col-md-6 mb-5">
            <img src="{{ asset('storage/'.$product->image1) }}" style="width: 100%;height: 400px;"
                class="main_img mb-3">
            <div class="row">
                <div class="col"><img src="{{ asset('storage/'.$product->image1) }}"
                        style="width: 100%;height:100%;margin-left: 5%;" class="small_img"></div>
                <div class="col"><img src="{{ asset('storage/'.$product->image2) }}"
                        style="width: 100%;height:100%;margin-left: 5%;" class="small_img"></div>
                <div class="col"><img src="{{ asset('storage/'.$product->image3) }}"
                        style="width: 100%;height:100%;margin-left: 5%;" class="small_img"></div>
                <div class="col"><img src="{{ asset('storage/'.$product->image4) }}"
                        style="width: 100%;height:100%;margin-left: 5%;" class="small_img"></div>
            </div>
        </div>
        <!-- End Display Images -->

        <!-- Display Details -->
        <div class="col-md-6">
            <form method="post" action="{{ route('addPhones') }}">
                @csrf
                <table class="table table-dark">
                    <tbody>

                        <tr>
                            <!-- Name Product  -->
                            <td colspan="2">
                                <span style="font-size: 20px;font-weight: bold;">{{ $product->name }}</span>
                                &nbsp
                                @if ($product->new != "")
                                <span style="font-size: 13px;font-weight: bold;"
                                    class="badge badge-danger">{{ $product->new }}</span>
                                @endif
                                @if ($product->discount > 0)
                                <span style="font-size: 13px;font-weight: bold;"
                                    class="badge badge-success">{{ __('Special') }}</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <!-- In Stock  -->
                            <td colspan="2">
                                <span style="font-size: 20px;font-weight: bold;">{{ __('In Stock') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $product->qty }}</span>
                            </td>
                        </tr>

                        <tr>
                            <!-- Product Price  -->
                            <td>
                                @if ($product->discount > 0)
                                @php
                                $newPrice = $product->price - ($product->price * ($product->discount / 100));
                                @endphp
                                <span style="font-size: 20px;font-weight: bold;">{{ __('Price') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $newPrice }} {{ __('IQD') }}</span>
                                @else
                                <span style="font-size: 20px;font-weight: bold;">{{ __('Price') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $product->price }} {{ __('IQD') }}</span>
                                @endif
                            </td>
                            <!-- Product Color  -->
                            <td>
                                <span style="font-size: 20px;font-weight: bold;">{{ __('Color') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $product->color }}</span>
                            </td>
                        </tr>

                        <tr>
                            <!-- Category Name  -->
                            <td>
                                <span style="font-size: 20px;font-weight: bold;">{{ __('Category') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $category->name }}</span>
                            </td>
                            <!-- Laptop CPU  -->
                            <td>
                                <div class="form-group">
                                    <span style="font-size: 17px;font-weight: bold;">{{ __('SIM Card') }} : </span>
                                    &nbsp
                                    <span style="font-size: 15px">{{ $product->simcard }}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <!-- Connectivity  -->
                            <td colspan="2">
                                <span style="font-size: 20px;font-weight: bold;">{{ __('Connectivity') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $product->connectivity }}</span>
                            </td>

                        </tr>

                        <tr>
                            <!-- Model -->
                            <td>
                                <span style="font-size: 20px;font-weight: bold;">{{ __('Model') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $product->model }}</span>
                            </td>
                            <!-- Laptop Brand  -->
                            <td>
                                <div class="form-group">
                                    <span style="font-size: 20px;font-weight: bold;">{{ __('Brand') }} : </span>

                                    <span style="font-size: 15px">{{ $product->brand }}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <!-- Laptop OS  -->
                            <td>
                                <span style="font-size: 20px;font-weight: bold;">{{ __('OS') }} : </span>
                                &nbsp
                                <span style="font-size: 15px">{{ $product->os }}</span>
                            </td>
                            <!-- Laptop HDD Capacity  -->
                            <td>
                                <div class="form-group">
                                    <span style="font-size: 19px;font-weight: bold;">{{ __('HDD Capacity') }} : </span>

                                    <span style="font-size: 15px">{{ $product->storage_capacity }}</span>
                                </div>
                            </td>
                        </tr>

                        <!-- Add To Cart Button  -->
                        <tr>
                            <td colspan="2">
                                @if ($product->discount > 0)
                                @php
                                $newPrice = $product->price - ($product->price * ($product->discount / 100));
                                @endphp
                                <input type="hidden" name="discountPrice" value={{ $newPrice }}>
                                <input type="hidden" name="product_id" value={{ $product->id }}>
                                <button type="submit" class="btn btn-success btn-block">{{ __('Add To Cart') }}</button>
                                @else
                                <input type="hidden" name="product_id" value={{ $product->id }}>
                                <button type="submit" class="btn btn-success btn-block">{{ __('Add To Cart') }}</button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <!-- End Display Details -->
    </div>
    <hr>

    <!-- Product Describtion -->
    <h2 class="mb-3">{{ __('Description') }}</h2>
    <div class="container" style="border-left: 2px solid rgb(43, 37, 37);">
        <div class="row p-3">
            <div class="col-md-12" style="font-size: 25px;font-weight: bolder;">
                @php
                echo $product->describtion;
                @endphp
            </div>
        </div>
    </div>
    <!-- End Product Describtion -->

    <br>
    <h1 class="mt-4 mb-4">{{ __('You May Also Like This') }}</h1>
    <div class="row" style="border-left: 2px solid black;">
        @foreach ($youmayalsolike as $item)
        <div class="col-md-3 mb-3">
            <a href="{{ route('shop.show',['id' => $item->id , 'category_id' => $item->category_id]) }}">
                <img src="{{ asset('storage/'.$item->image1) }}" style="width: 80%;height: 225px;margin-left:10%;">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection