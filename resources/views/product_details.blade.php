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
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{asset('images/product-details/1.jpg')}}" alt="" />
                        </div>
                    </div>
                    <div class="col-sm-7">

                        <div class="product-information"><!--/product-information-->
                            <h2>{{$product->name}}</h2>
                            <p>Web ID: {{$product->id}}</p>
                            <p><b>Popis:</b> {{$product->description}}</p>
                            <p id="product_unitprice_label" name="product_untiprice_label">Jednotková cena: {{$product->price}} €/cm^2</p>
                            <form method="POST" action="{{url('cart_process')}}" id="frmProduct" name="frmProduct">
                                <span>
                                    <div>
                                        <label>Prevedenie</label>
                                        <select id="product_design" name="product_design" form="frmProduct" onchange="onChange()">
                                            <option value="Plátno">Plátno</option>
                                            <option value="Papier">Papier</option>
                                            <option value="Tapeta">Tapeta</option>
									    </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label>Pomer strán</label>
                                        <select>
                                            <option>16:9</option>
									    </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label>Rozmery (x:y):</label>
                                        <input type="text" value="" id="product_sizeX" name="product_sizeX" />
                                        :
                                        <input type="text" value="" id="product_sizeY" name="product_sizeY" />
                                    </div>
                                    <br>

                                    <div id="product_info" style="display: none;">
                                        <?php
                                        echo $product;
                                        ?>
                                    </div>

                                    <span style="color: #FE980F"><p id="product_price_label" name="product_price_label">{{$product->price}}€</p></span>
                                    <label>Počet:</label>
                                    <input type="text" value="1" id="product_qty" name="product_qty" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="product_price" id="product_price" value="{{$product->price}}">
                                    <button type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Pridať do košíka
                                    </button>

                                    <script>
                                        var product_info= JSON.parse(document.getElementById("product_info").textContent);
                                        function onChange() {
                                            var unitprice=product_info.price;
                                            var sizeX=parseFloat(document.getElementById("product_sizeX").value);
                                            var sizeY=parseFloat(document.getElementById("product_sizeY").value);
                                            var design=document.getElementById("product_design").value;
                                            if(design=="Plátno") var c=0.1;
                                            if(design=="Papier") var c=0.2;
                                            if(design=="Tapeta") var c=0.3;
                                            var cena=sizeX*sizeY*unitprice*c;

                                            document.getElementById("product_price").value = cena;
                                            document.getElementById("product_price_label").innerHTML = cena+"€";

                                            alert(cena);
                                        }
                                    </script>

                                </span>
                            </form>
                        </div><!--/product-information-->
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection