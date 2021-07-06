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
            <form method="post" action="{{ route('addJeans') }}">
                @csrf
                <table class="table table-dark">
                    <tbody>
                        <!-- Name Product  -->
                        <tr>
                            <td>
                                <span style="font-size: 25px;font-weight: bold;">{{ $product->name }}</span>
                                &nbsp&nbsp&nbsp
                                @if ($product->new != "")
                                <span style="font-size: 15px;font-weight: bold;"
                                    class="badge badge-danger">{{ $product->new }}</span>
                                @endif
                                @if ($product->discount > 0)
                                <span style="font-size: 15px;font-weight: bold;"
                                    class="badge badge-success">{{ __('Special') }}</span>
                                @endif
                            </td>
                        </tr>
                        <!-- Product In Stock  -->
                        <tr>
                            <td>
                                <span style="font-size: 25px;font-weight: bold;">{{ __('In Stock') }} : </span>
                                &nbsp&nbsp&nbsp
                                <span style="font-size: 20px">{{ $product->qty }}</span>
                            </td>
                        </tr>
                        <!-- Product Price  -->
                        <tr>
                            <td>
                                @if ($product->discount > 0)
                                @php
                                $newPrice = $product->price - ($product->price * ($product->discount / 100));
                                @endphp
                                <span style="font-size: 25px;font-weight: bold;">{{ __('Price') }} : </span>
                                &nbsp&nbsp&nbsp
                                <span style="font-size: 20px">{{ $newPrice }} {{ __('IQD') }}</span>
                                @else
                                <span style="font-size: 25px;font-weight: bold;">{{ __('Price') }} : </span>
                                &nbsp&nbsp&nbsp
                                <span style="font-size: 20px">{{ $product->price }} {{ __('IQD') }}</span>
                                @endif
                            </td>
                        </tr>
                        <!-- Product Color  -->
                        <tr>
                            <td>
                                <span style="font-size: 25px;font-weight: bold;">{{ __('Color') }} : </span>
                                &nbsp&nbsp&nbsp
                                <span style="font-size: 20px">{{ $product->color }}</span>
                            </td>
                        </tr>
                        <!-- Category Name  -->
                        <tr>
                            <td>
                                <span style="font-size: 25px;font-weight: bold;">{{ __('Category') }} : </span>
                                &nbsp&nbsp&nbsp
                                <span style="font-size: 23px">{{ $category->name }}</span>
                            </td>
                        </tr>
                        <!-- Size Jeans  -->
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="waistsize"
                                        style="font-size: 25px;font-weight: bold;">{{ __('Size Of The Waist') }}</label>
                                    <select id="waistsize" class="form-control" name="size">
                                        @if ($product->s28 > 0)
                                        <option value="s28">Size-28</option>
                                        @endif
                                        @if ($product->s29 > 0)
                                        <option value="s29">Size-29</option>
                                        @endif
                                        @if ($product->s30 > 0)
                                        <option value="s30">Size-30</option>
                                        @endif
                                        @if ($product->s31 > 0)
                                        <option value="s31">Size-31</option>
                                        @endif
                                        @if ($product->s32 > 0)
                                        <option value="s32">Size-32</option>
                                        @endif
                                        @if ($product->s33 > 0)
                                        <option value="s33">Size-33</option>
                                        @endif
                                        @if ($product->s34 > 0)
                                        <option value="s34">Size-34</option>
                                        @endif
                                        @if ($product->s36 > 0)
                                        <option value="s36">Size-36</option>
                                        @endif
                                        @if ($product->s37 > 0)
                                        <option value="s37">Size-37</option>
                                        @endif
                                        @if ($product->s38 > 0)
                                        <option value="s38">Size-38</option>
                                        @endif
                                        @if ($product->s39 > 0)
                                        <option value="s39">Size-39</option>
                                        @endif
                                        @if ($product->s40 > 0)
                                        <option value="s40">Size-40</option>
                                        @endif
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <!-- Add To Cart Button  -->
                        <tr>
                            <td>
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