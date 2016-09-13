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
                            <p id="product_unitprice_label" name="product_untiprice_label">Jednotková cena: {{$product->unit_price}} €/cm^2</p>
                            <form method="POST" action="{{url('cart_process')}}" id="frmProduct" name="frmProduct">
                                <span>
                                    <div>
                                        <label>Prevedenie</label>
                                        <select id="product_design" name="product_design" form="frmProduct" onchange="onChange()">
                                            @if($product->design=="Plátno")
                                                <option value="Plátno" selected>Plátno</option>
                                                <option value="Papier">Papier</option>
                                                <option value="Tapeta">Tapeta</option>
                                            @endif
                                            @if($product->design=="Papier")
                                                <option value="Plátno">Plátno</option>
                                                <option value="Papier" selected>Papier</option>
                                                <option value="Tapeta">Tapeta</option>
                                            @endif
                                            @if($product->design=="Tapeta")
                                                <option value="Plátno">Plátno</option>
                                                <option value="Papier">Papier</option>
                                                <option value="Tapeta" selected>Tapeta</option>
                                            @endif

									    </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label>Pomer strán</label>
                                        <select id="ratio" name="ratio" onchange="onChangeRatio(this.value)">
                                            <option value="16:9">16:9</option>
                                            <option value="4:3">4:3</option>
                                            <option value="3:2">3:2</option>
									    </select>
                                    </div>
                                    <br>
                                    <div>
                                        <label>Rozmery (x:y):</label>
                                        <input type="text" value="{{$product->sizeX}}" id="product_sizeX" name="product_sizeX" onchange="onChangeSizeX()"  />
                                        :
                                        <input type="text" value="{{$product->sizeY}}" id="product_sizeY" name="product_sizeY" onchange="onChangeSizeY()"/>
                                    </div>
                                    <br>

                                    <div id="product_info" style="display: none;">
                                        <?php
                                        echo $product;
                                        ?>
                                    </div>

                                    <span style="color: #FE980F"><p id="product_price_label" name="product_price_label">{{$product->getPrice()}}€</p></span>
                                    <label>Počet:</label>
                                    <input type="text" value="1" id="product_qty" name="product_qty" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="product_price" id="product_price" value="{{$product->getPrice()}}">
                                    <button type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Pridať do košíka
                                    </button>

                                    <script>
                                        var product_info= JSON.parse(document.getElementById("product_info").textContent);
                                        var ratioX=0;
                                        var ratioY=0;

                                       // onChangeRatio(document.getElementById("ratio").value);


                                        function onChange() {

                                            var unitprice=product_info.unit_price;
                                            var sizeX=parseFloat(document.getElementById("product_sizeX").value);
                                            var sizeY=parseFloat(document.getElementById("product_sizeY").value);
                                            var design=document.getElementById("product_design").value;
                                            if(design=="Plátno") var c=1.01;
                                            if(design=="Papier") var c=1.02;
                                            if(design=="Tapeta") var c=1.03;
                                            var cena=sizeX*sizeY*unitprice*c;

                                            document.getElementById("product_price").value = cena.toFixed(2);
                                            document.getElementById("product_price_label").innerHTML = cena.toFixed(2)+"€";
                                            return cena;
                                        }
                                        function onChangeSizeX(){
                                            var sizeX=parseFloat(document.getElementById("product_sizeX").value);
                                            var sizeY=(sizeX*ratioY)/ratioX;
                                            document.getElementById("product_sizeY").value=sizeY.toFixed(2);
                                            document.getElementById("product_sizeY").value;
                                            onChange();

                                        }
                                        function onChangeSizeY(){
                                            var sizeY=parseFloat(document.getElementById("product_sizeY").value);
                                            var sizeX=(sizeY*ratioX)/ratioY;
                                            document.getElementById("product_sizeX").value=sizeX.toFixed(2);
                                            document.getElementById("product_sizeX").value;
                                            onChange();
                                        }
                                        function onChangeRatio(ratio_label){
                                            ratioX=parseFloat(ratio_label.substr(0,ratio_label.indexOf(":")));
                                            ratioY=parseFloat(ratio_label.substr(ratio_label.indexOf(":")+1));
                                            onChangeSizeX();
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