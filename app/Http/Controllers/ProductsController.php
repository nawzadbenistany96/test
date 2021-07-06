<?php

namespace App\Http\Controllers;

use App\Models\Jeans;
use App\Models\Category;
use App\Models\Laptop;
use App\Models\Pc;
use App\Models\Phone;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function featuring()
    {
        $num = 0;
        $categories = Category::whereNull('parent_id')->withTranslation(app()->getLocale())->get();
        $date = date('Y-m-d');
        $jeans = Jeans::where('date_available', '<=', $date)->get();
        if (Voyager::translatable($jeans)) {
            $jeans = $jeans->translate(app()->getLocale(), false);
        }
        return view('shop.index', ['categories' => $categories, 'products' => $jeans, 'num' => $num]);
    }

    public function index($id)
    {
        //
        //$requestID = request('id');
        $categoryID = Category::findOrFail($id);
        //start if
        if ($categoryID->parent_id == null) {
            $num = 1;
            $findSubCategory = Category::where('parent_id', $categoryID->id)->withTranslation(app()->getLocale())->get();
            $categories1 = Category::whereNull('parent_id')->withTranslation(app()->getLocale())->get();
            //empty string for the name of Category example (Men) have (jeans,watch,t-shirt) i mean (Men)
            $empty = 0;
            foreach ($categories1 as $item) {
                foreach ($findSubCategory as $child1) {
                    if ($item->id == $child1->parent_id) {
                        $empty = $item->id;
                    }
                }
            }
            $empty1 = Category::where('id', $empty)->withTranslation(app()->getLocale())->get();
            if (Voyager::translatable($empty1)) {
                // it's translatable
                $empty1 = $empty1->translate(app()->getLocale(), false);
            }
            return view('shop.index', ['num' => $num, 'request' => $findSubCategory, 'nameCategory' => $empty1]);
        } //end if
        else { //Start else
            $num = 2;
            //start jeans
            if ($categoryID->slug == "jeans") {
                $categories2 = Category::whereNull('parent_id')->withTranslation(app()->getLocale())->get();
                $findJeansProductsOnly = Jeans::where('category_id', $categoryID->id)->withTranslation(app()->getLocale())->get();
                $Parent_id_Null = Category::where('parent_id', '!=', Null)->get();
                //For Finding specific name of category
                $find_ID_Category = 0;
                foreach ($Parent_id_Null as $k) {
                    if ($k->id == $categoryID->id)
                        $find_ID_Category = $k->id;
                }
                $dd = Category::find($find_ID_Category);
                return view('shop.index', ['num' => $num, 'products' => $findJeansProductsOnly, 'categories' => $categories2, 'categoryy' => $dd]);
            }
            //End jeans

            //For Laptops Products
            //start Laptops
            if ($categoryID->slug == "laptops") {
                $categories2 = Category::whereNull('parent_id')->withTranslation(app()->getLocale())->get();
                $findLaptopsProductsOnly = Laptop::where('category_id', $categoryID->id)->withTranslation(app()->getLocale())->get();
                $Parent_id_Null = Category::where('parent_id', '!=', Null)->get();
                //For Finding specific name of category
                $find_ID_Category = 0;
                foreach ($Parent_id_Null as $k) {
                    if ($k->id == $categoryID->id)
                        $find_ID_Category = $k->id;
                }
                $dd = Category::find($find_ID_Category);
                return view('shop.index', ['num' => $num, 'products' => $findLaptopsProductsOnly, 'categories' => $categories2, 'categoryy' => $dd]);
            }
            //End Laptops

            //For PC-Desktop Products
            //start PC-Desktop
            if ($categoryID->slug == "pc-desktops") {
                $categories2 = Category::whereNull('parent_id')->withTranslation(app()->getLocale())->get();
                $findPCDesktopProductsOnly = Pc::where('category_id', $categoryID->id)->withTranslation(app()->getLocale())->get();
                $Parent_id_Null = Category::where('parent_id', '!=', Null)->get();
                //For Finding specific name of category
                $find_ID_Category = 0;
                foreach ($Parent_id_Null as $k) {
                    if ($k->id == $categoryID->id)
                        $find_ID_Category = $k->id;
                }
                $dd = Category::find($find_ID_Category);
                return view('shop.index', ['num' => $num, 'products' => $findPCDesktopProductsOnly, 'categories' => $categories2, 'categoryy' => $dd]);
            }
            //End Laptops

            //For Phone Products
            //start Phone
            if ($categoryID->slug == "phones") {
                $categories2 = Category::whereNull('parent_id')->withTranslation(app()->getLocale())->get();
                $findPhoneProductsOnly = Phone::where('category_id', $categoryID->id)->withTranslation(app()->getLocale())->get();
                $Parent_id_Null = Category::where('parent_id', '!=', Null)->get();
                //For Finding specific name of category
                $find_ID_Category = 0;
                foreach ($Parent_id_Null as $k) {
                    if ($k->id == $categoryID->id)
                        $find_ID_Category = $k->id;
                }
                $dd = Category::find($find_ID_Category);
                return view('shop.index', ['num' => $num, 'products' => $findPhoneProductsOnly, 'categories' => $categories2, 'categoryy' => $dd]);
            }
            //End Phone

        } //end else
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id, $category_id)
    {
        //$cat_id = request('n');
        //
        $find = Category::findOrFail($category_id); //5
        //For Jeans Product
        if ($find->slug == "jeans") {
            //$id = request('i');
            $jeansFind = Jeans::findOrFail($id);
            if (Voyager::translatable($jeansFind)) {
                $jeansFind = $jeansFind->translate(app()->getLocale(), false);
            }
            if (Voyager::translatable($find)) {
                $find = $find->translate(app()->getLocale(), false);
            }
            $youMayalsoLike = Jeans::where('id', '!=', $jeansFind->id)->take(3)->get();
            if (Voyager::translatable($youMayalsoLike)) {
                $youMayalsoLike = $youMayalsoLike->translate(app()->getLocale(), false);
            }
            return View('shop.showjeans', ['product' => $jeansFind, 'category' => $find, 'youmayalsolike' => $youMayalsoLike]);
        }
        //End Jeans Product

        //For Laptops Product
        if ($find->slug == "laptops") {
            //$id = request('i');
            $LaptopsFind = Laptop::findOrFail($id);
            if (Voyager::translatable($LaptopsFind)) {
                $LaptopsFind = $LaptopsFind->translate(app()->getLocale(), false);
            }
            if (Voyager::translatable($find)) {
                $find = $find->translate(app()->getLocale(), false);
            }
            $youMayalsoLike = Jeans::where('id', '!=', $LaptopsFind->id)->take(3)->get();
            if (Voyager::translatable($youMayalsoLike)) {
                $youMayalsoLike = $youMayalsoLike->translate(app()->getLocale(), false);
            }
            return View('shop.showLaptop', ['product' => $LaptopsFind, 'category' => $find, 'youmayalsolike' => $youMayalsoLike]);
        }
        //End Laptops Product

        //For Laptops Product
        if ($find->slug == "pc-desktops") {
            //$id = request('i');
            $PCDesktopFind = Pc::findOrFail($id);
            if (Voyager::translatable($PCDesktopFind)) {
                $PCDesktopFind = $PCDesktopFind->translate(app()->getLocale(), false);
            }
            if (Voyager::translatable($find)) {
                $find = $find->translate(app()->getLocale(), false);
            }
            $youMayalsoLike = Pc::where('id', '!=', $PCDesktopFind->id)->take(3)->get();
            if (Voyager::translatable($youMayalsoLike)) {
                $youMayalsoLike = $youMayalsoLike->translate(app()->getLocale(), false);
            }
            return View('shop.showPCDesktop', ['product' => $PCDesktopFind, 'category' => $find, 'youmayalsolike' => $youMayalsoLike]);
        }
        //End Laptops Product

        //For Phone Product
        if ($find->slug == "phones") {
            $PhoneFind = Phone::findOrFail($id);
            if (Voyager::translatable($PhoneFind)) {
                $PhoneFind = $PhoneFind->translate(app()->getLocale(), false);
            }
            if (Voyager::translatable($find)) {
                $find = $find->translate(app()->getLocale(), false);
            }
            $youMayalsoLike = Phone::where('id', '!=', $PhoneFind->id)->take(3)->get();
            if (Voyager::translatable($youMayalsoLike)) {
                $youMayalsoLike = $youMayalsoLike->translate(app()->getLocale(), false);
            }
            return View('shop.showPhone', ['product' => $PhoneFind, 'category' => $find, 'youmayalsolike' => $youMayalsoLike]);
        }
        //End Phone Product

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
