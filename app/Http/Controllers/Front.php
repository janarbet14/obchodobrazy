<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Cart;
use Illuminate\Support\Facades\Redirect;



class Front extends Controller {

    var $brands;
    var $categories;
    var $products;
    var $title;
    var $description;
    var $category;

    public function __construct() {
        $this->brands = Brand::all(array('name'));
        $this->categories = Category::all(array('id','name'));
        $this->products = Product::all(array('id','name','price','category_id'));
    }

    public function index() {
        return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function products() {
        return view('products', array('title' => 'Products Listing','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products, 'category' => "All"));
    }

    public function product_details($id) {
        $product = Product::find($id);
        return view('product_details', array('product' => $product, 'title' => $product->name,'description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function product_categories($id) {
        $category = Category::find($id);
        $products_filtered=array();
        foreach ($this->products as $product){
            if($product->category_id==$category->id) {
                array_push($products_filtered, $product);
            }
        }
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $products_filtered, 'category' => $category->name));
    }

    public function product_brands($name, $category = null) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog() {
        return view('blog', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function blog_post($id) {
        return view('blog_post', array('title' => 'Welcome','description' => '','page' => 'blog', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function contact_us() {
        return view('contact_us', array('title' => 'Welcome','description' => '','page' => 'contact_us'));
    }

    public function login() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function logout() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function cart() {
        echo "funkcia CART";
        echo Request::getMethod();
        $cart = Cart::content();
        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function cart_parse(){
        echo "PARSE";

        if(Request::isMethod('POST')){
            $option=Request::get('option');
            echo $option;
            switch ($option){
                case "add": {
                    $this->cart_add();
                    break;
                }

            }
        }else{
            echo "bla";
        }

        $cart = Cart::content();
        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));

    }

    public function cart_update(Request $request, $id) {
        echo "Update";
    }

    public function cart_add() {
        $product_id = Request::get('product_id');
        $product = Product::find($product_id);
        Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price));
    }

    public function checkout() {
        return view('checkout', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

    public function search($query) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products'));
    }
}
