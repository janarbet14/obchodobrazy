@extends('layouts.layout')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Objednávka</li>
                <li class="active">Kontrola údajov</li>
            </ol>
        </div><!--/breadcrums-->


        <div class="shopper-informations">
            <div class="row">

                <div class="col-sm-4">
                    <div class="shopper-info">
                        <p>Fakturačné údaje</p>
                        <tr>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td><b>Meno</b></td>
                                        <td>{{ $fakt_udaje->meno }}</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td><b>Priezvisko</b></td>
                                        <td>{{ $fakt_udaje->priezvisko }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Ulica</b></td>
                                        <td>{{ $fakt_udaje->ulica }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mesto</b></td>
                                        <td>{{ $fakt_udaje->mesto }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>PSČ</b></td>
                                        <td>{{ $fakt_udaje->psc }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Telefón</b></td>
                                        <td>{{ $fakt_udaje->telefon }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>E-mail</b></td>
                                        <td>{{ $fakt_udaje->email }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="shopper-info">
                        <p>Dodacia adresa</p>

                        <tr>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td><b>Meno</b></td>
                                        <td>{{ $fakt_udaje->meno2 }}</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td><b>Priezvisko </b></td>
                                        <td>{{ $fakt_udaje->priezvisko2 }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Ulica</b></td>
                                        <td>{{ $fakt_udaje->ulica2 }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mesto</b></td>
                                        <td>{{ $fakt_udaje->mesto2 }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>PSČ</b></td>
                                        <td>{{ $fakt_udaje->psc2 }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Dodatočné informácie</p>
                        {{ $fakt_udaje->info }}
                    </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Obsah košíka</h2>
            @if(count($fakt_udaje->cart))
                <tr>
                    <td colspan="3">
                        <table class="table table-condensed total-result">
                            <thead>
                            <tr class="cart_menu">
                                <td><b>Položka</b></td>
                                <td><b>Cena</b></td>
                                <td><b>Rozmery</b></td>
                                <td><b>Prevedenie</b></td>
                                <td><b>Množstvo</b></td>
                                <td><b>Spolu</b></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fakt_udaje->cart as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>10x10</td>
                                    <td>Prev.</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->subtotal }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="2">
                                    <table class="table table-condensed total-result">
                                        <thead>
                                        <tr class="cart_menu">
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Tovar spolu </td>
                                            <td>{{$fakt_udaje->getTotal()}}€</td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Poštovné </td>
                                            <td>2€</td>
                                        </tr>
                                        <tr>
                                            <td>Spolu</td>
                                            <td><span>{{$fakt_udaje->getTotal()+2}}€</span></td>
                                        </tr>



                                        </tbody>
                                    </table>

                                    {!! Form::open(array('url' => 'checkout', 'class' => 'shopper-info')) !!}
                                    <div class="form-group" align="right">
                                        {!! Form::submit('Späť', ['class' => 'btn btn-primary', 'name' => 'spat', 'value' => 'spat']) !!}
                                        {!! Form::submit('Objednaj', ['class' => 'btn btn-primary', 'name' => 'objednaj', 'value' => 'objednaj']) !!}
                                    </div>
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @else
                <p>V košíku sa nenachádzajú žiadne produkty</p>
            @endif
        </div>
    </div>




</section> <!--/#cart_items-->

@endsection