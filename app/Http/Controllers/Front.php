<?php



namespace App\Http\Controllers;



use App\Brand;
use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;
use Cart;
use App\Http\Controllers\OrderDataController;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Null_;


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
        $this->products = Product::all(array('id','name','price','category_id','img_src'));
    }

    public function index() {
        return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
    }

    public function products() {
        return view('products', array('title' => 'Products Listing','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products, 'category' => "Všetko"));
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

    public function cart()
    {
        $cart = Cart::content();
        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function cart_process(){
        echo Request::getMethod();
        return Response::json("ahoj");
    }

    public function cart_parse(){

        echo Request::getMethod();

       if(Request::isMethod('POST')){
            $option=Request::get('option');
            echo $option;
            switch ($option){
                case "add": {
                    $product_id = Request::get('product_id');
                    $product = Product::find($product_id);
                    Cart::add(array('id' => $product_id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'img_src' => $product->img_src));
                    break;
                }

            }
        }else{
            echo "bla";
        }


        //$cart = Cart::content();
        //return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function checkout(Request $request) {
        $fakt_udaje=new OrderDataController();
        $fakt_udaje->getSession($request);
        if(Input::has('objednaj')){
            $fakt_udaje->sendEmail($request);
            //return \Redirect::route('control')->with('message', 'Ďakujeme za nákup!');
            return view('home', array('title' => 'Welcome','description' => '','page' => 'home', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products));
        }

        return view('checkout', array('fakt_udaje' => $fakt_udaje, 'cart' => Cart::content(), 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function search($query) {
        return view('products', array('title' => 'Welcome','description' => '','page' => 'products'));
    }



    public function product_get($cart_id)
    {
        $cart_item = Product::find($cart_id);
        return Response::json($cart_item);
    }
    public function cart_all() {
        $cart = Cart::content();
        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }
    public function cart_add(Request $request){
        $product = Product::find($request->get('product_id'));
        $product_qty = $request->get('product_qty');
        $product_price = $request->get('product_price');
        $product_info=array('product_img_src' => $product->img_src,
            'product_price' => $request->get('product_price'),
            'product_sizeX' => $request->get('product_sizeX'),
            'product_sizeY' => $request->get('product_sizeY'),
            'product_design' => $request->get('product_design'));

        $cartItem=Cart::add(array('id' => $product->id, 'name' => $product->name, 'qty' => $product_qty, 'price' => $product_price, 'options' => $product_info ));
        return view('cart', array('cart' => Cart::content(), 'title' => 'Nákupný košík', 'description' => '', 'page' => 'home'));
    }

    public function cart_remove($rowId){
        Cart::remove($rowId);
        $cart = Cart::content();
        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function cart_clear(){
        Cart::destroy();
        $cart=Cart::content();
        return view('cart', array('cart' => $cart, 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
    }

    public function product_search(Closure $search)
    {
        $content = Cart::content();
        return $content->filter($search);
    }

    public function control(Request $request)
    {
        $fakt_udaje = new OrderDataController();
        $fakt_udaje->createSession($request);
        return view('control', array('title' => 'Kontrola údajov','description' => '','page' => 'control', 'fakt_udaje' => $fakt_udaje));
    }
    public function order(Request $request){
        $fakt_udaje=$request->session()->get('fakt_udaje');
        if(Input::has('spat')){
            return view('checkout', array('fakt_udaje' => $fakt_udaje, 'cart' => Cart::content(), 'title' => 'Welcome', 'description' => '', 'page' => 'home'));
        }
        if(Input::has('objednaj')){
            echo("OBJEDNAJ");
        }

    }

}
