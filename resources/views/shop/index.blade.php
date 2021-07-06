@extends('layouts.app')
@section('content')

@if ($num == 0)
<div class="container">

    <div class="row my-3">
        <div class="col-sm-1 col-md-2 col-lg-2"></div>
        <div class="col-sm-10 col-md-9 col-lg-9">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select name="category" class="form-control">
                            <option value="" selected disabled>{{ __('Select Category') }}</option>
                            <option value="">Jeans</option>
                            <option value="">Laptopts</option>
                        </select>
                    </div>
                    <input type="text" class="form-control col-md-6 col-sm-7"
                        aria-label="Text input with dropdown button" placeholder="{{ __('Search For Products...') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-block" type="button">{{__('Search')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
    </div>

    <div class="row">
        <!-- Side Navbar Shows Category Name -->
        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">
            <ul class="list-group list-group-flush">
                <h4 class="m-2 p-2" style="font-weight: bold">{{__('Categories')}}</h4>
                @foreach ($categories as $category)
                <a href="{{route('shop.index',['id' => $category->id ])}}"
                    class="list-group-item list-group-item-action"
                    style="font-weight: bold;background-color: gray;color:white;">{{ $category->getTranslatedAttribute('name', app()->getLocale(), false) }}</a>
                @php
                $children = TCG\Voyager\Models\Category::whereTranslation('parent_id', $category->id,
                app()->getLocale())->get();
                @endphp
                @if ($children->isNotEmpty())
                <ul class="list-group list-group-flush">
                    @foreach ($children as $child)
                    <a href="{{route('shop.index',['id' => $child->id ])}}"
                        class="list-group-item list-group-item-action">-
                        {{ $child->getTranslatedAttribute('name', app()->getLocale(), false) }}</a>
                    @endforeach
                </ul>
                @endif
                @endforeach
            </ul>
            <h5 class="my-3" style="font-weight: bold">{{__('Sort By Price')}}</h5>
            <ul class="list-group list-group-flush mb-3">
                <a href="#" class="list-group-item list-group-item-action">25$ - 50$</a>
                <a href="#" class="list-group-item list-group-item-action">75$ - 90$</a>
                <a href="#" class="list-group-item list-group-item-action">95$ - 110$</a>
            </ul>
        </div>
        <!-- End Side Navbar Shows Category Name -->

        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-9" style="margin-left:-5px;">
            <div style="width: 100%;height:40px;">

            </div>
            <div class="row">
                @foreach ($products as $product)
                <!-- Only Show That Product That Is Available -->

                <div
                    class="col-6 offset-3 offset-md-0 offset-sm-0 offset-lg-0 offset-xl-0 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3">
                    <div class="card text-center">
                        <img class="card-img-top" src="{{ asset('storage/'.$product->image1) }}" alt="Card image cap"
                            style="height: 245px" />
                        @if (!empty($product->new))
                        <span class="badge badge-danger rounded-circle p-2"
                            style="position: absolute;top: 10px;right: 20px;">{{ $product->new }}</span>
                        @endif
                        @if ($product->discount > 0)
                        <span class="badge badge-danger p-2"
                            style="position: absolute;left: 0;top: 0;">{{ __('Special') }}</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $product->name }}</h5>
                            <span class="card-text">
                                @if ($product->discount > 0)
                                <span
                                    style="text-decoration: line-through;font-size: 15px;">{{ $product->price ." " . __('IQD') }}</span>
                                <span>-</span>
                                <span>
                                    @php
                                    $newPrice = $product->price - ($product->price * ($product->discount / 100));
                                    echo $newPrice;
                                    @endphp
                                    {{ __('IQD') }}
                                </span>
                                @else
                                <span>{{ $product->price ." ". __('IQD') }}</span>
                                @endif
                            </span>
                            <br>
                            <a href="{{ route('shop.show',['id'=>$product->id ,'category_id'=>$product->category_id ]) }}"
                                class="btn btn-primary btn-sm" style="width: 100px;">{{ __('View') }}</a>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>

</div>
@endif


@if ($num == 1)
<div class="container">

    <div class="row my-3">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select name="category" class="form-control">
                            <option value="" selected disabled>{{ __('Select Category') }}</option>
                            <option value="">Jeans</option>
                            <option value="">Laptopts</option>
                        </select>
                    </div>
                    <input type="text" class="form-control col-md-9 col-sm-6"
                        aria-label="Text input with dropdown button" placeholder="{{ __('Search For Products...') }}">
                    <button type="submit" class="btn btn-primary col-md-3 col-sm-3">
                        {{__('Search')}}
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="row">
        @foreach ($nameCategory as $item)
        <h1>{{ $item->name }}</h1>
        @endforeach
    </div>

    <div class="row">

        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-9" style="margin-left:-5px;">
            <div style="width: 100%;height:40px;">

            </div>
            <div class="row">
                @foreach ($request as $product)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3">
                    <div class="card text-center">
                        <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="Card image cap"
                            style="height: 245px" />
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                {{ $product->getTranslatedAttribute('name',app()->getLocale(),false) }}</h5>
                            <a href="{{ route('shop.index',['id' => $product->id ]) }}" class="btn btn-primary btn-sm"
                                style="width: 100px;">{{__('View')}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endif


<!-- For Showing SubCategory Products=>Jeans Products and so on... -->
@if ($num == 2)
<div class="container">

    <div class="row my-3">
        <div class="col-sm-1 col-md-2 col-lg-2"></div>
        <div class="col-sm-10 col-md-9 col-lg-9">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select name="category" class="form-control">
                            <option value="" selected disabled>{{ __('Select Category') }}</option>
                            <option value="">Jeans</option>
                            <option value="">Laptopts</option>
                        </select>
                    </div>
                    <input type="text" class="form-control col-md-6 col-sm-7"
                        aria-label="Text input with dropdown button" placeholder="{{ __('Search For Products...') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-block" type="button">{{__('Search')}}</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
    </div>

    <div class="row">
        <!-- Side Navbar Shows Category Name -->
        <div class="col-sm-4 col-md-4 col-lg-3 col-xl-3">
            <ul class="list-group list-group-flush">
                <h4 class="m-2 p-2" style="font-weight: bold">{{__('Categories')}}</h4>
                @foreach ($categories as $category)
                <a href="{{route('shop.index',['id' => $category->id ])}}"
                    class="list-group-item list-group-item-action"
                    style="font-weight: bold;background-color: gray;color:white;">{{ $category->getTranslatedAttribute('name', app()->getLocale(), false) }}</a>
                @php
                $children = TCG\Voyager\Models\Category::whereTranslation('parent_id', $category->id,
                app()->getLocale())->get();
                @endphp
                @if ($children->isNotEmpty())
                <ul class="list-group list-group-flush">
                    @foreach ($children as $child)
                    <a href="{{route('shop.index',['id' => $child->id ])}}"
                        class="list-group-item list-group-item-action">
                        - {{ $child->getTranslatedAttribute('name', app()->getLocale(), false) }}
                    </a>
                    @endforeach
                </ul>
                @endif
                @endforeach
            </ul>
            <h5 class="my-3" style="font-weight: bold">{{__('Sort By Price')}}</h5>
            <ul class="list-group list-group-flush mb-3">
                <a href="#" class="list-group-item list-group-item-action">25$ - 50$</a>
                <a href="#" class="list-group-item list-group-item-action">75$ - 90$</a>
                <a href="#" class="list-group-item list-group-item-action">95$ - 110$</a>
            </ul>
        </div>
        <!-- End Side Navbar Shows Category Name -->

        <!-- First We will check if we have products or no -->
        @if ($products->count() > 0)
        <div class="col-sm-8 col-md-8 col-lg-9 col-xl-9" style="margin-left:-5px;">
            <div style="width: 100%;height:50px;margin-top: 20px;">
                <div style="width: 100px;height: 3px;background-color: black;border-radius: 20px;"></div>
                <h2 class="p-1">
                    {{ $categoryy->getTranslatedAttribute('name',app()->getLocale(),false) }}
                </h2>
                <div style="width: 150px;height: 3px;background-color: black;border-radius: 20px;"></div>
            </div>
            <!-- Show Products By Category -->
            <div class="row">
                @foreach ($products as $product)
                <!-- Only Show That Product That Is Available -->
                @if ($product->date_available <= date("Y-m-d")) <div
                    class="col-6 offset-3 offset-md-0 offset-sm-0 offset-lg-0 offset-xl-0 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-3">
                    <div class="card text-center">
                        <img class="card-img-top" src="{{ asset('storage/'.$product->image1) }}" alt="Card image cap"
                            style="height: 245px" />
                        @if (!empty($product->new))
                        <span class="badge badge-danger rounded-circle p-2"
                            style="position: absolute;top: 10px;right: 20px;">{{ $product->getTranslatedAttribute('new',app()->getLocale(),false) }}</span>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                {{ $product->getTranslatedAttribute('name',app()->getLocale(),false) }}</h5>
                            <span class="card-text" style="text-align: left;">
                                @if ($product->discount > 0)
                                <span
                                    style="text-decoration: line-through;font-size: 15px;">{{ $product->price."  ".__('IQD') }}</span>
                                <span>
                                    @php
                                    $newPrice = $product->price - ($product->price * ($product->discount / 100));
                                    @endphp
                                    {{ $newPrice."  ".__('IQD') }}
                                </span>
                                @else
                                <span>{{ $product->price."  ".__('IQD') }}</span>
                                @endif
                            </span>
                            <br>
                            <a href="{{ route('shop.show',['id'=>$product->id ,'category_id'=>$product->category_id ]) }}"
                                class="btn btn-primary btn-sm" style="width: 100px;">{{ __('View') }}</a>
                        </div>
                    </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="col-sm-8 col-md-8 col-lg-9 col-xl-9 mt-5" style="margin-left:-5px;">
        <span style="font-size: 25px;">{{ __('Sorry We Do not Have Any ') }}</span>
        <span
            style="font-size: 35px;font-weight: bolder;">{{ $categoryy->getTranslatedAttribute('name',app()->getLocale(),false) }}</span>
        <span style="font-size: 25px;">{{ __('In The Store') }}</span>
    </div>
    @endif
</div>

</div>
@endif


@endsection