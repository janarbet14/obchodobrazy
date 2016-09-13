@extends('layouts.layout')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        @include('shared.sidebar')
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{$category}}</h2>
                        @foreach ($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">

                                        <div class="productinfo text-center">
                                            <img src="{{asset("$product->img_src")}}" alt="" />
                                            <h2>{{$product->getPrice()}}€</h2>
                                            <p>{{$product->name}}</p>
                                            <a href="{{url('cart_process')}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Pridaj do košíka</a>
                                            <a href='{{url("products/details/$product->id")}}' class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Zobraziť detail</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{$product->name}}</h2>
                                                <p>{{$product->design}}</p>
                                                <p>{{$product->sizeX}} cm x {{$product->sizeY}} cm</p>
                                                <p>{{$product->unit_price}}€/cm^2</p>
                                                <h2>{{$product->getPrice()}}€</h2>

                                                <form id="frmProduct" name="frmProduct" method="POST" action="{{url('cart_process')}}">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="hidden" name="product_price" value="{{$product->getPrice()}}">
                                                    <input type="hidden" name="product_qty" id="product_qty{{$product->id}}" value="1">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-default add-to-cart" type="submit" name="cart_add" id="cart_add" value="{{$product->id}}">
                                                        <i class="fa fa-shopping-cart"></i>
                                                        Pridaj do košíka
                                                    </button>
                                                </form>
                                                <a href='{{url("products/details/$product->id")}}' class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Zobraziť detail</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endforeach


                        <ul class="pagination">
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">»</a></li>
                        </ul>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection