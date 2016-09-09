@extends('layouts.layout')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Nákupný košík</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                @if(count($cart))
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Položka</td>
                            <td class="description"></td>
                            <td class="description">Prevedenie</td>
                            <td class="description">Rozmery</td>
                            <td class="price">Cena</td>
                            <td class="quantity">Množstvo</td>
                            <td class="total">Spolu</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img src="images/cart/one.png" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$item->name}}</a></h4>
                                    <p>Web ID: {{$item->id}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{$item->options["product_design"]}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{$item->options["product_sizeX"]}}:{{$item->options["product_sizeY"]}}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{$item->price}}€</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <meta name="token2" content="{{csrf_token()}}" />
                                        <a class="cart_quantity_up" href="" onclick="increase({{$item->product_id}})" > + </a>
                                        <input class="cart_quantity_input" type="text" id="quantity" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2" onchange="update({{$item}})" >
                                        <a class="cart_quantity_down" href="" onclick="decrease({{$item->product_id}})" value="{{$item->product_id}}"> - </a>
                                    </div>

                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{$item->subtotal}}€</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" name="cart_delete" href="{!! route('cart_remove') !!}\{{$item->rowid}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <p>V košíku sa nenachádzajú žiadne produkty</p>
                        @endif
                        </tbody>
                    </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tovar spolu <span>{{Cart::total()}}€</span></li>
                            <li>Poštovné <span>2€</span></li>
                            <li>Spolu <span>{{Cart::total()+2}}€</span></li>
                        </ul>
                        <a class="btn btn-default update" href="{!! route('cart_clear') !!}">Vyprázdniť košík</a>
                        <a class="btn btn-default check_out" href="{{url('checkout')}}">Pokračovať</a>
                    </div>
                </div>
            </div>
        </div>
        <meta name="_token" content="{!! csrf_token() !!}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    </section><!--/#do_action-->
@endsection