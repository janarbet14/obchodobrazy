<?php
/**
 * Created by PhpStorm.
 * User: jajo
 * Date: 30.08.2016
 * Time: 10:51
 */

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class OrderDataController extends Controller{
    var $meno;
    var $priezvisko;
    var $ulica;
    var $mesto;
    var $psc;
    var $telefon;
    var $email;
    var $meno2;
    var $priezvisko2;
    var $ulica2;
    var $mesto2;
    var $psc2;
    var $info;
    var $cart;

    function __construct(){
        $this->meno="";
        $this->priezvisko="";
        $this->ulica="";
        $this->mesto="";
        $this->psc="";
        $this->telefon="";
        $this->email="";
        $this->meno2="";
        $this->priezvisko2="";
        $this->ulica2="";
        $this->mesto2="";
        $this->psc2="";
        $this->info="";
        $this->cart=Cart::content();


        /*$request->session()->put('meno',$array['meno']);
        $request->session()->put('priezvisko',$array['priezvisko']);
        $request->session()->put('ulica',$array['ulica']);
        $request->session()->put('mesto',$array['mesto']);
        $request->session()->put('psc',$array['psc']);
        $request->session()->put('telefon',$array['telefon']);
        $request->session()->put('email',$array['email']);
        $request->session()->put('meno2',$array['meno2']);
        $request->session()->put('priezvisko2',$array['priezvisko2']);
        $request->session()->put('ulica2',$array['ulica2']);
        $request->session()->put('mesto2',$array['mesto2']);
        $request->session()->put('psc2',$array['psc2']);
        $request->session()->put('info2',$array['info']);*/



    }
    public function getTotal(){
        return Cart::total();
    }
    public function createSession(Request $request){
            $array=$request->all();
            $this->meno=$array['meno'];
            $this->priezvisko=$array['priezvisko'];
            $this->ulica=$array['ulica'];
            $this->mesto=$array['mesto'];
            $this->psc=$array['psc'];
            $this->telefon=$array['telefon'];
            $this->email=$array['email'];
            $this->meno2=$array['meno2'];
            $this->priezvisko2=$array['priezvisko2'];
            $this->ulica2=$array['ulica2'];
            $this->mesto2=$array['mesto2'];
            $this->psc2=$array['psc2'];
            $this->info=$array['info'];
            $this->cart=Cart::content();
            $request->session()->put('fakt_udaje', $this);
    }
    public function getSession(Request $request){
        if($request->session()->has('fakt_udaje')){
            $fakt_udaje=$request->session()->get('fakt_udaje');
            $this->meno=$fakt_udaje->meno;
            $this->priezvisko=$fakt_udaje->priezvisko;
            $this->ulica=$fakt_udaje->ulica;
            $this->mesto=$fakt_udaje->mesto;
            $this->psc=$fakt_udaje->psc;
            $this->telefon=$fakt_udaje->telefon;
            $this->email=$fakt_udaje->email;
            $this->meno2=$fakt_udaje->meno2;
            $this->priezvisko2=$fakt_udaje->priezvisko2;
            $this->ulica2=$fakt_udaje->ulica2;
            $this->mesto2=$fakt_udaje->mesto2;
            $this->psc2=$fakt_udaje->psc2;
            $this->info=$fakt_udaje->info;
            $this->cart=Cart::content();
            return 1;
        }

        return 0;
    }
    public function clearSession(Request $request){
        $request->session()->forget('fakt_udaje');
        Cart::destroy();
        $this->meno="";
        $this->priezvisko="";
        $this->ulica="";
        $this->mesto="";
        $this->psc="";
        $this->telefon="";
        $this->email="";
        $this->meno2="";
        $this->priezvisko2="";
        $this->ulica2="";
        $this->mesto2="";
        $this->psc2="";
        $this->info="";
    }
    public function toArray(){
        $array['meno']=$this->meno;
        $array['priezvisko']=$this->priezvisko;
        $array['ulica']=$this->ulica;
        $array['mesto']=$this->mesto;
        $array['psc']=$this->psc;
        $array['telefon']=$this->telefon;
        $array['email']=$this->email;
        $array['meno2']=$this->meno2;
        $array['priezvisko2']=$this->priezvisko2;
        $array['ulica2']=$this->ulica2;
        $array['mesto2']=$this->mesto2;
        $array['psc2']=$this->psc2;
        $array['info']=$this->info;
        $array['cart']=Cart::content();
        return $array;
    }

    public function sendEmail(Request $request){
        Mail::send('email', ['fakt_udaje' => $fakt_udaje, 'cart' => $this->cart], function ($message)
        {

            $message->from('obchodobrazy@gmail.com', 'E-shop');
            $message->to($this->email);
            $message->subject('Objednávka obrazov');

        });

        $this->clearSession($request);
    }
}

