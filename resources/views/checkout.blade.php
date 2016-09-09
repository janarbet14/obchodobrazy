@extends('layouts.layout')

@section('content')       
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Objednávka</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="shopper-informations">
            <div class="row">

                {!! Form::open( array('url' => 'control', 'class' => 'shopper-info')) !!}

                <div class="col-sm-4">
                    <div class="shopper-info">
                        <p>Fakturačné údaje</p>

                        {!! Form::text('meno', $fakt_udaje->meno, ['placeholder'=>'Meno']) !!}
                        {!! Form::text('priezvisko', $fakt_udaje->priezvisko, ['placeholder'=>'Priezvisko'])!!}
                        {!! Form::text('ulica', $fakt_udaje->ulica, ['placeholder'=>'Ulica']) !!}
                        {!! Form::text('mesto', $fakt_udaje->mesto, ['placeholder'=>'Mesto']) !!}
                        {!! Form::text('psc', $fakt_udaje->psc, ['placeholder'=>'PSČ']) !!}
                        {!! Form::text('telefon', $fakt_udaje->telefon, ['placeholder'=>'Telefón']) !!}
                        {!! Form::email('email', $fakt_udaje->email, ['placeholder'=>'E-mail']) !!}

                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="shopper-info">
                        <p>Dodacia adresa</p>

                        {!! Form::text('meno2', $fakt_udaje->meno2, array('placeholder'=>'Meno' )) !!}
                        {!! Form::text('priezvisko2', $fakt_udaje->priezvisko2, array('placeholder'=>'Priezvisko' ))!!}
                        {!! Form::text('ulica2', $fakt_udaje->ulica2, array('placeholder'=>'Ulica' )) !!}
                        {!! Form::text('mesto2', $fakt_udaje->mesto2, array('placeholder'=>'Mesto' )) !!}
                        {!! Form::text('psc2', $fakt_udaje->psc2, array('placeholder'=>'PSČ' )) !!}

                    </div>
                    <label>
                        {!! Form::checkbox('name', 'value', false) !!}
                        Dodávacia adresa totožná s fakturačnou
                    </label>
                </div>

                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Dodatočné informácie</p>
                        {!! Form::textarea('info', $fakt_udaje->info, array('placeholder'=>'Dodatočné informácie o objednávke', 'rows'=>'16' )) !!}
                    </div>
                </div>

            </div>
            {!! Form::submit('Pokračuj', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>

        <div class="review-payment">
            <h2>Obsah košíka</h2>
        </div>

        <div class="table-responsive cart_info">
            @if(count($cart))
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Položka</td>
                        <td class="description"></td>
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
                                <p>${{$item->price}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <meta name="token2" content="{{csrf_token()}}" />
                                    <a class="cart_quantity_up" href="" onclick="increase({{$item->id}})" > + </a>
                                    <input class="cart_quantity_input" type="text" id="quantity" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2" onchange="update({{$item}})" >
                                    <a class="cart_quantity_down" href="" onclick="decrease({{$item->id}})" value="{{$item->id}}"> - </a>
                                </div>

                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{$item->subtotal}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" name="cart_delete" href="{!! route('cart_remove') !!}\{{$item->rowid}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <p>V košíku sa nenachádzajú žiadne produkty</p>
                    @endif
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Tovar spolu </td>
                                    <td>{{Cart::total()}}€</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Poštovné </td>
                                    <td>2€</td>
                                </tr>
                                <tr>
                                    <td>Spolu</td>
                                    <td><span>{{Cart::total()+2}}€</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection