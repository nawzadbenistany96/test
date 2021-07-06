<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaid;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Jeans;
use App\Models\Laptop;
use App\Models\Order;
use App\Models\Pc;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => ['required', 'string', 'min:3', 'max:30'],
            'shipping_fulladdress' => ['required', 'string', 'min:3', 'max:40'],
            'shipping_city' => ['required', 'string', 'min:3', 'max:20'],
            'shipping_mobile' => ['required', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/', 'min:10', 'max:11'],
            'payment_method' => ['required'],
        ]);

        //Add Order To Database
        $order = new Order;

        $order->order_number = uniqid('OrderNumber-');

        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_fulladdress = $request->input('shipping_fulladdress');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_mobile = $request->input('shipping_mobile');
        $order->payment_method = $request->input('payment_method');

        if (!$request->has('billing_fullname')) {
            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_fulladdress = $request->input('shipping_fulladdress');
            $order->billing_city = $request->input('shipping_city');
            $order->billing_mobile = $request->input('shipping_mobile');
        } else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_fulladdress = $request->input('billing_fulladdress');
            $order->billing_city = $request->input('billing_city');
            $order->billing_mobile = $request->input('billing_mobile');
        }

        //For Cart Items Count
        $cartItem = Cart::where([
            'user_id' => Auth::user()->id
        ])->count();
        //For Total Price Of Cart
        $cartTotal = Cart::where([
            'user_id' => Auth::user()->id
        ])->first();

        $order->item_count = $cartItem;
        $order->grand_total = $cartTotal->total_price;

        //store user id to orders table
        $order->user_id = auth()->id();

        //Save Order
        $order->save();

        //Let's Save Order Items
        $cartItems = Cart::where('user_id', auth()->id())->get();
        foreach ($cartItems as $item) {
            $order->carts()->attach($item->id, [
                'price' => $item->price,
                'quantity' => $item->qty,
                'total_price' => $item->total_price,
                'category_id' => $item->category_id
            ]);
        }
        //end if for cash on delivery

        //Send email For User Order
        Mail::to($order->user->email)->send(new OrderPaid($order));

        //Let's Decrease The Quantity Amount Of Our Products
        foreach ($cartItems as $iteminCart) {
            $categoryFind = Category::where('id', $iteminCart->category_id)->first();
            if ($categoryFind->slug == 'jeans') {
                $jeans = Jeans::find($iteminCart->product_id);
                if ($iteminCart->size == 's28') {
                    $jeans->s28 = $jeans->s28 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's29') {
                    $jeans->s29 = $jeans->s29 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's30') {
                    $jeans->s30 = $jeans->s30 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's31') {
                    $jeans->s31 = $jeans->s31 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's32') {
                    $jeans->s32 = $jeans->s32 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's33') {
                    $jeans->s33 = $jeans->s33 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's34') {
                    $jeans->s34 = $jeans->s34 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's36') {
                    $jeans->s36 = $jeans->s36 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's37') {
                    $jeans->s37 = $jeans->s37 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's38') {
                    $jeans->s38 = $jeans->s38 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's39') {
                    $jeans->s39 = $jeans->s39 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
                if ($iteminCart->size == 's40') {
                    $jeans->s40 = $jeans->s40 - $iteminCart->qty;
                    $jeans->qty = $jeans->qty - $iteminCart->qty;
                    $jeans->save();
                }
            }

            if ($categoryFind->slug == 'laptops') {
                $laptops = Laptop::find($iteminCart->product_id);
                $laptops->qty = $laptops->qty - $iteminCart->qty;
                $laptops->save();
            }

            if ($categoryFind->slug == 'phones') {
                $phones = Phone::find($iteminCart->product_id);
                $phones->qty = $phones->qty - $iteminCart->qty;
                $phones->save();
            }

            if ($categoryFind->slug == 'pc-desktops') {
                $PcDesktops = Pc::find($iteminCart->product_id);
                $PcDesktops->qty = $PcDesktops->qty - $iteminCart->qty;
                $PcDesktops->save();
            }
        }

        //Let's Empty The User Cart
        Cart::where('user_id', auth()->id())->delete();

        //Redirect user to Landing Page
        return redirect()->route('landingpage')->with('success', 'Thanks For Your Order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
