<?php

namespace App\Http\Controllers;

use App\Models\Pc;
use App\Models\Cart;
use App\Models\City;
use App\Models\Jeans;
use App\Models\Laptop;
use TCG\Voyager\Alert;
use App\Models\Category;
use App\Models\Phone;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        //For Sum Of Sum_price
        $sum = 0;
        foreach ($carts as $cart) {
            $sum = $sum + $cart->sum_price;
        }
        Cart::where([
            'user_id' => Auth::user()->id
        ])->update([
            'total_price' => $sum
        ]);
        $cart_Sum = Cart::where('user_id', Auth::user()->id)->sum('sum_price');

        /*For Total_Price
        Cart::where([
            'user_id' => Auth::user()->id
        ])->update([
            'total_price' => ($sum + 3000)
        ]);
        $carts2 = Cart::where('user_id', Auth::user()->id)->first();
        $cart_Total = $carts2->total_price;*/

        return view('cart.index', compact('carts', 'cart_Sum'));
    }

    function checkoutIndex()
    {
        //For Showing All Items In The Cart
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        //For Showing Total Product While Refreshing Page For The First Time
        $UserCartOnly = Cart::where('user_id', Auth::user()->id)->sum('sum_price');
        Cart::where('user_id', Auth::user()->id)->update(['total_price' => $UserCartOnly]);

        $countCart = Cart::where('user_id', Auth::user()->id)->count();
        if ($countCart > 0) {
            //send Total Price To Checkout View
            $UserCartOnly2 = Cart::where('user_id', Auth::user()->id)->first();
            $cart_Total = $UserCartOnly2->total_price;
            $cities = City::all();
            $number = 1;
            return view('cart.checkout', compact('carts', 'cart_Total', 'cities', 'number'));
        }
        //Display All Cities
        $number = 0;
        return view('cart.checkout', compact('number'));
    }

    //Add Jeans Function
    public function addJeans(Request $request)
    {
        //Add Jeans To Cart
        $findSingleJean = Jeans::find($request->product_id);
        if (Voyager::translatable($findSingleJean)) {
            // it's translatable
            $findSingleJean = $findSingleJean->translate(app()->getLocale(), false);
        }

        $carts = Cart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $findSingleJean->id,
            'size' => $request->size
        ])->count();
        if ($carts != 0) {
            //Add Jeans Depends On Size Which size will be increased
            $cart = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSingleJean->id,
                'size' => $request->size
            ])->first();
            //User Can not add more items because we do not have more items in the store
            if ($cart->size == 's28') {
                if ($cart->qty > $findSingleJean->s28 || $cart->qty == $findSingleJean->s28) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's29') {
                if ($cart->qty > $findSingleJean->s29 || $cart->qty == $findSingleJean->s29) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's30') {
                if ($cart->qty > $findSingleJean->s30 || $cart->qty == $findSingleJean->s30) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's31') {
                if ($cart->qty > $findSingleJean->s31 || $cart->qty == $findSingleJean->s31) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's32') {
                if ($cart->qty > $findSingleJean->s32 || $cart->qty == $findSingleJean->s32) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's33') {
                if ($cart->qty > $findSingleJean->s33 || $cart->qty == $findSingleJean->s33) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's34') {
                if ($cart->qty > $findSingleJean->s34 || $cart->qty == $findSingleJean->s34) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's36') {
                if ($cart->qty > $findSingleJean->s36 || $cart->qty == $findSingleJean->s36) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's37') {
                if ($cart->qty > $findSingleJean->s37 || $cart->qty == $findSingleJean->s37) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's38') {
                if ($cart->qty > $findSingleJean->s38 || $cart->qty == $findSingleJean->s38) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's39') {
                if ($cart->qty > $findSingleJean->s39 || $cart->qty == $findSingleJean->s39) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            if ($cart->size == 's40') {
                if ($cart->qty > $findSingleJean->s40 || $cart->qty == $findSingleJean->s40) {
                    return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
                }
            }
            $addQuantity = $cart->qty + 1.0;
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSingleJean->id,
                'size' => $request->size
            ])->update(['qty' => $addQuantity]);
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        } else {
            //if we do not have jeans in cart first we will add jeans to cart and the count for first time will be 1
            $cartJeans = new Cart;
            $cartJeans->user_id = Auth::user()->id;
            $cartJeans->product_id = $findSingleJean->id;
            $cartJeans->image = $findSingleJean->image1;
            $cartJeans->pro_name = $findSingleJean->name;
            $cartJeans->category_id = $findSingleJean->category_id;
            $cartJeans->size = $request->size;
            $cartJeans->qty = 1;
            if ($findSingleJean->discount > 0) {
                $cartJeans->price = $request->discountPrice;
            } else {
                $cartJeans->price = $findSingleJean->price;
            }
            $cartJeans->sum_price = $cartJeans->price * $cartJeans->qty;
            $cartJeans->save();
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        }
    } //End Of Add Jeans Function


    //Add Laptops Function
    public function addLaptops(Request $request)
    {
        //Add Jeans To Cart
        $findSingleLaptop = Laptop::find($request->product_id);

        $carts = Cart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $findSingleLaptop->id,
            'size' => $findSingleLaptop->hardsize,
        ])->count();
        if ($carts != 0) {
            //Add Jeans Depends On Size Which size will be increased
            $cart = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSingleLaptop->id,
                'size' => $findSingleLaptop->hardsize,
            ])->first();
            //User Can not add more items because we do not have more items in the store
            if ($cart->qty > $findSingleLaptop->qty || $cart->qty == $findSingleLaptop->qty) {
                return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
            }
            $addQuantity = $cart->qty + 1.0;
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSingleLaptop->id,
                'size' => $findSingleLaptop->hardsize,
            ])->update(['qty' => $addQuantity]);
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        } else {
            //if we do not have jeans in cart first we will add jeans to cart and the count for first time will be 1
            $cartLaptop = new Cart;
            $cartLaptop->user_id = Auth::user()->id;
            $cartLaptop->product_id = $findSingleLaptop->id;
            $cartLaptop->image = $findSingleLaptop->image1;
            $cartLaptop->pro_name = $findSingleLaptop->name;
            $cartLaptop->category_id = $findSingleLaptop->category_id;
            $cartLaptop->size = $findSingleLaptop->hardsize;
            $cartLaptop->qty = 1;
            if ($findSingleLaptop->discount > 0) {
                $cartLaptop->price = $request->discountPrice;
            } else {
                $cartLaptop->price = $findSingleLaptop->price;
            }
            $cartLaptop->sum_price = $cartLaptop->price * $cartLaptop->qty;
            $cartLaptop->save();
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        }
    }
    //End Of Add Jeans Function

    //Add PC-Desktop Function
    public function addPCDesktop(Request $request)
    {
        //Add Jeans To Cart
        $findSinglePCDesktop = Pc::find($request->product_id);

        $carts = Cart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $findSinglePCDesktop->id,
            'size' => $findSinglePCDesktop->harddisk_capacity,
        ])->count();
        if ($carts != 0) {
            //Add Jeans Depends On Size Which size will be increased
            $cart = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSinglePCDesktop->id,
                'size' => $findSinglePCDesktop->harddisk_capacity,
            ])->first();
            //User Can not add more items because we do not have more items in the store
            if ($cart->qty > $findSinglePCDesktop->qty || $cart->qty == $findSinglePCDesktop->qty) {
                return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
            }
            $addQuantity = $cart->qty + 1.0;
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSinglePCDesktop->id,
                'size' => $findSinglePCDesktop->harddisk_capacity,
            ])->update(['qty' => $addQuantity]);
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        } else {
            //if we do not have jeans in cart first we will add jeans to cart and the count for first time will be 1
            $cartPCDesktop = new Cart;
            $cartPCDesktop->user_id = Auth::user()->id;
            $cartPCDesktop->product_id = $findSinglePCDesktop->id;
            $cartPCDesktop->image = $findSinglePCDesktop->image1;
            $cartPCDesktop->pro_name = $findSinglePCDesktop->name;
            $cartPCDesktop->category_id = $findSinglePCDesktop->category_id;
            $cartPCDesktop->size = $findSinglePCDesktop->harddisk_capacity;
            $cartPCDesktop->qty = 1;
            if ($findSinglePCDesktop->discount > 0) {
                $cartPCDesktop->price = $request->discountPrice;
            } else {
                $cartPCDesktop->price = $findSinglePCDesktop->price;
            }
            $cartPCDesktop->sum_price = $cartPCDesktop->price * $cartPCDesktop->qty;
            $cartPCDesktop->save();
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        }
    }
    //End Of PC-Desktop Function

    //Add Add Phones Function
    public function addPhones(Request $request)
    {
        //Add Jeans To Cart
        $findSinglePhone = Phone::find($request->product_id);

        $carts = Cart::where([
            'user_id' => Auth::user()->id,
            'product_id' => $findSinglePhone->id,
            'size' => $findSinglePhone->storage_capacity,
        ])->count();
        if ($carts != 0) {
            //Add Jeans Depends On Size Which size will be increased
            $cart = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSinglePhone->id,
                'size' => $findSinglePhone->storage_capacity,
            ])->first();
            //User Can not add more items because we do not have more items in the store
            if ($cart->qty > $findSinglePhone->qty || $cart->qty == $findSinglePhone->qty) {
                return back()->with('fail', 'Sorry You Can Not Add More Of This Item Because We Do Not Have More Items In The Store Of This Size');
            }
            $addQuantity = $cart->qty + 1.0;
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $findSinglePhone->id,
                'size' => $findSinglePhone->storage_capacity,
            ])->update(['qty' => $addQuantity]);
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        } else {
            //if we do not have jeans in cart first we will add jeans to cart and the count for first time will be 1
            $cartPhone = new Cart;
            $cartPhone->user_id = Auth::user()->id;
            $cartPhone->product_id = $findSinglePhone->id;
            $cartPhone->image = $findSinglePhone->image1;
            $cartPhone->pro_name = $findSinglePhone->name;
            $cartPhone->category_id = $findSinglePhone->category_id;
            $cartPhone->size = $findSinglePhone->storage_capacity;
            $cartPhone->qty = 1;
            if ($findSinglePhone->discount > 0) {
                $cartPhone->price = $request->discountPrice;
            } else {
                $cartPhone->price = $findSinglePhone->price;
            }
            $cartPhone->sum_price = $cartPhone->price * $cartPhone->qty;
            $cartPhone->save();
            return redirect()->route('cart.index')->with('success', 'Your Item Has Been Added Successfully');
        }
    }
    //End Of Add Phone Function

    ///Update Quantity for items in the cart
    function Update(Cart $id, Request $request)
    {
        $findCategory = Category::find($request->category);
        //Jeans If
        if ($findCategory->slug == 'jeans') {
            $findJeans = Jeans::find($id->product_id);
            if ($id->size == 's28') {
                if ($request->quantity > $findJeans->s28) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's29') {
                if ($request->quantity > $findJeans->s29) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's30') {
                if ($request->quantity > $findJeans->s30) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's31') {
                if ($request->quantity > $findJeans->s31) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's32') {
                if ($request->quantity > $findJeans->s32) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's33') {
                if ($request->quantity > $findJeans->s33) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's34') {
                if ($request->quantity > $findJeans->s34) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's36') {
                if ($request->quantity > $findJeans->s36) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's37') {
                if ($request->quantity > $findJeans->s37) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's38') {
                if ($request->quantity > $findJeans->s38) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's39') {
                if ($request->quantity > $findJeans->s39) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            if ($id->size == 's40') {
                if ($request->quantity > $findJeans->s40) {
                    return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
                }
            }
            //update quantity for specific jeans
            $cartSumUpdate = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $id->size
            ])->first();

            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $id->size
            ])->update([
                'qty' => $request->quantity,
                'sum_price' => ($request->quantity * $cartSumUpdate->price)
            ]);

            return back()->with('success', 'Your Item Successfully Updated');
        }
        //End Jeans If

        //Laptops If
        if ($findCategory->slug == "laptops") {
            $findLaptop = Laptop::find($id->product_id);
            if ($request->quantity > $findLaptop->qty) {
                return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
            }
            //update quantity for specific Laptop
            $cartSumUpdate = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $findLaptop->hardsize,
            ])->first();
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $findLaptop->hardsize,
            ])->update([
                'qty' => $request->quantity,
                'sum_price' => ($request->quantity * $cartSumUpdate->price)
            ]);

            return back()->with('success', 'Your Item Successfully Updated');
        }
        //End Laptops If

        //PC-Desktop If
        if ($findCategory->slug == "pc-desktops") {
            $findPCDesktop = Pc::find($id->product_id);
            if ($request->quantity > $findPCDesktop->qty) {
                return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
            }
            //update quantity for specific Laptop
            $cartSumUpdate = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $findPCDesktop->harddisk_capacity,
            ])->first();
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $findPCDesktop->harddisk_capacity,
            ])->update([
                'qty' => $request->quantity,
                'sum_price' => ($request->quantity * $cartSumUpdate->price)
            ]);

            return back()->with('success', 'Your Item Successfully Updated');
        }
        //End PC-Desktop If

        //Phone If
        if ($findCategory->slug == "phones") {
            $findPCDesktop = Phone::find($id->product_id);
            if ($request->quantity > $findPCDesktop->qty) {
                return back()->with('fail', 'Sorry we do not have that amount that you are request from us');
            }
            //update quantity for specific Laptop
            $cartSumUpdate = Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $findPCDesktop->storage_capacity,
            ])->first();
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $findPCDesktop->storage_capacity,
            ])->update([
                'qty' => $request->quantity,
                'sum_price' => ($request->quantity * $cartSumUpdate->price)
            ]);

            return back()->with('success', 'Your Item Successfully Updated');
        }
        //End Phone If

    }

    ///Delete item in the cart
    function Destroy(Cart $id, Request $request)
    {
        $findCategory = Category::find($request->category);
        //Delete Jeans Item
        if ($findCategory->slug == 'jeans') {
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $id->size
            ])->delete();
            return back()->with('success', 'Item Has Been Successfully Deleted');
        }
        //Delete Laptop Item
        if ($findCategory->slug == 'laptops') {
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $id->size
            ])->delete();
            return back()->with('success', 'Item Has Been Successfully Deleted');
        }
        //Delete PC-Desktop Item
        if ($findCategory->slug == 'pc-desktops') {
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $id->size
            ])->delete();
            return back()->with('success', 'Item Has Been Successfully Deleted');
        }
        //Delete Phone Item
        if ($findCategory->slug == 'phones') {
            Cart::where([
                'user_id' => Auth::user()->id,
                'product_id' => $id->product_id,
                'size' => $id->size
            ])->delete();
            return back()->with('success', 'Item Has Been Successfully Deleted');
        }
    }

    //For Displaying City Price
    public function CityAjax(Request $request)
    {
        //return $request->slug;
        $findCity = City::where('slug', $request->slug)->first();

        $cartuser = Cart::where('user_id', Auth::user()->id)->sum('sum_price');

        //Update Total Price By City Price
        Cart::where([
            'user_id' => Auth::user()->id,
        ])->update([
            'total_price' => ($cartuser + $findCity->price)
        ]);

        $cityPrice = $findCity->price;
        return $cityPrice;
    }

    //Show total price
    public function totalPrice()
    {
        $findCity2 = Cart::where('user_id', Auth::user()->id)->first();
        return $findCity2->total_price;
    }
}
