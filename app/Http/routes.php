<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', 'Front@index');
Route::get('/products', 'Front@products');
Route::get('/products/details/{id}', 'Front@product_details');
Route::get('/products/categories/{id}', 'Front@product_categories');
Route::get('/products/brands/{name}/{category?}', 'Front@product_brands');
Route::get('/blog', 'Front@blog');
Route::get('/blog/post/{id}', 'Front@blog_post');
Route::get('/contact-us', 'Front@contact_us');
Route::get('/login', 'Front@login');
Route::get('/logout', 'Front@logout');

Route::get('/cart', 'Front@cart');
Route::post('/cart', 'Front@cart_parse');
Route::put('/cart/{task_id?}',function(Request $request,$task_id){
    $task = Task::find($task_id);

    $task->task = $request->task;
    $task->description = $request->description;

    $task->save();

    return Response::json($task);
});

Route::get('/checkout', 'Front@checkout');
Route::get('/search/{query}', 'Front@search');

Route::get('/insert', function() {
    App\Category::create(array('name' => 'Music'));

    return 'category added';
});

Route::get('/read', function() {
    $category = new App\Category();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '<br>';
    }
});

Route::get('/update', function() {
    $category = App\Category::find(16);
    $category->name = 'HEAVY METAL';
    $category->save();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '<br>';
    }
});

Route::get('/delete', function() {
    $category = App\Category::find(5);
    $category->delete();
    
    $data = $category->all(array('name','id'));

    foreach ($data as $list) {
        echo $list->id . ' ' . $list->name . '<br>';
    }
});



Route::get('/raw', function () {
    $sql = "INSERT INTO categories (name) VALUES ('POMBE')";

    DB::statement($sql);
    $results = DB::select(DB::raw("SELECT * FROM categories"));

    print_r($results);
}
);

Route::get('blade', function () {
    $drinks = array('Vodka', 'Gin', 'Brandy');
    return view('page', array('name' => 'The Raven', 'day' => 'Friday', 'drinks' => $drinks));
});



