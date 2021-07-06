@extends('layouts.app')
@section('styles')
<style>
    .img-cart {
        display: block;
        max-width: 50px;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }

    table tr td {
        border: 1px solid #FFFFFF;
    }

    table tr th {
        background: #eee;
    }

    .panel-shadow {
        box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
    }
</style>
@endsection
@section('content')
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container-fluid bootstrap snippets bootdey">
    @if (session('fail'))
    <div class="alert alert-danger">
        {{ __(session('fail')) }}
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ __(session('success')) }}
    </div>
    @endif
    <div class="col-md-12 col-sm-12 content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <div class="panel-heading">
                        <h3>
                            <img src="{{ asset('/storage/users/user_avatar/'.Auth::user()->id.'/'.Auth::user()->avatar) }}"
                                style="width: 100px;height: 100px;">
                            {{ Auth::user()->name }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        @if ($carts->count() != 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{__('Product')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Size')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Price per Unit')}}</th>
                                        <th>{{__('Sum Price')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                    <tr>
                                        <td><img src="{{ asset('/storage/'.$cart->image) }}" class="img-cart"></td>
                                        <td><strong>{{ $cart->pro_name }}</strong>
                                        </td>
                                        <td><strong>{{ $cart->size }}</strong></td>
                                        <td class="form-inline">
                                            <!-- Cart Update Quantity Items -->
                                            <form action="{{ route('Update',['id' => $cart->id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="category" value={{ $cart->category_id }}>
                                                <input class="form-control" type="text" value={{ $cart->qty }}
                                                    name="quantity">
                                                <button rel="tooltip" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </form>
                                            <!-- End Cart Update Quantity Items -->

                                            <!-- Cart Delete Items -->
                                            <form action="{{ route('Delete',['id' => $cart->id]) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="category" value={{ $cart->category_id }}>
                                                <button rel="tooltip" class="btn btn-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </form>
                                            <!-- End Cart Delete Items -->

                                        </td>
                                        <td>{{ $cart->price }} {{__('IQD')}}</td>
                                        <td>{{ $cart->sum_price }} {{__('IQD')}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="4" class="text-right" style="font-weight: bold;">
                                            {{__('Price (IQD)')}}</td>
                                        <td style="font-weight: bold;">{{ $cart_Sum.'  ' }} {{__('IQD')}}</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        @else
                        <h1>{{ __('there is no items in your carts') }}</h1>
                        @endif
                    </div>
                </div>
                @if ($carts->count() != 0)
                <a href="{{ route('shop.featuring') }}" class="btn btn-success"><span
                        class="glyphicon glyphicon-arrow-left"></span>&nbsp;{{__('Continue Shopping')}}</a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary pull-right">{{__('Checkout')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection