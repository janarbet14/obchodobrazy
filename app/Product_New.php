<?php
/**
 * Created by PhpStorm.
 * User: jajo
 * Date: 12.09.2016
 * Time: 18:37
 */

namespace App;
use Illuminate\Support\Facades\DB;


class Product_New
{

    private $all_products;

    public function __construct()
    {
        $this->all_products = DB::select('SELECT `name`,`title`,`description`,`unit_price`,`category_id`, (sizeX * sizeY) as price,`design`,`img_src` FROM `products`');


        /// teraz mas vsetky data v poli ..a mozes s tym co chces
        foreach ($this->all_products as $product) {
            echo $product->name."<BR>";
            echo $product->price."<BR>";
        }
        // tu si uz kludne mozes vytvorit pole attributes a poslat ho do classy illuminate collection ci co to do pici bolo ..
        // a zrazu mas vystavany objekt ten stejny .. ale jednoducho ..
        // dokonca mozes podedit rovno ..
        // chapes ? pomohol som ? hej hej chapem :)... no dako to idem doriadit :)




        // aby si este raz pochopil ako mas pisat tieto typy veci DB

        // model je vzdy jeden pre nieco ...model je nieco ako objekt
        // 1 obraz , jedna kava, jeden cukor, jeden samopal
        // pokial mas model ... v nasom pripade ktory priamo zavisi na datach z DB
        // dam si konstruktor ..do parametru co chcem tahat ..alebo ked som chuj tak nic .. a taham vsetko
        // vo vnutri modelu mozes mat arraylist pole ..hocaku picovinu ..ale v konstruktore zabezpecim vnutorne naplnenie objektu

        // to je vsetko ..tu uloha modela skoncila

        // construtor - > vytah z DB -> zapis do niakeho fajneho datoveho typu
        // chcem model na CENA ? tak si ho napisem ..za par SEKUND ...

        // ak chcem od modelu nieco viac ...mozem ..kludne


        // samopal->strielaj
        // kava->premiesaj sa
        // obraz->dajMicenuObrazu
        // obraz->chodDoPice

        // ale na zaciatku v kostruktore ...v kazdom ! vytiahnes z db a hotovo

        //  a byt tebou tak si naozaj spravim model Obraz a spravil obrazA = new Obraz(a)
        //obrazB = new obraz (b)
        //
        //
        // no a pak a ten skurveny laravel interaguje jenom s Illuminate\blabla picovina\Collection ..
        // no tak si stlac ctrl + shift + f a hladaj proste __construct ..alebo funckce...
        // pohybuj sa stylom neco var_dump(neco);die(); aby si videl kde ti to umrelo a co to robi
        //
        //
        //pak podedis a implementujes co chces ..
        //
        //chapes ? helpol som ? ides vsetko prerobit na jednoduchy sposob ? :)
        // no hej pomohlo mi to cosi, inak teraz rozmyslam...no skusim to poprerabat dako, len nech to uz dopice dokoncim
        //neznasam to cele :D al
        //e
        // tak vela som sa naucil uz
        //
        //tak samozrejme ze ano ... podla mna sa PHPcku aj naucis mysliet dakedy mozno aj troska lepsie ...lebo to neni take pospajane vsetko
        //a musis prave vyuzivat frameworky ine ... NETTE, SYMPHONY. LARAVEL ...atd ..a ich funkce nepoznas ..ale kazdy ma vzdy framework ..
        //
        //tutorialy ani necitaj uz potom ..staci docka ..var_dump
        // a este print_r
        // no ved to...ja len zozaciatku...var dump teraz furt pouzivam, vtedy som nevedel ani nic ako si vypisat ani nic...vsetko sa mi miesalo...
        //
        //aha ukazem ti details
        //










        die();
    }

    //zavolaj toto od niekial

//
//    protected $primaryKey = 'id';
//    protected $table = 'products';
//    protected $fillable = array('name', 'title', 'description', 'unit_price', 'category_id', 'sizeX', 'sizeY ', 'design', 'img_src');
//    // do fillable chces dostat jednoduchy int price ? ano, ale tam to nemozes dat lebo fillable su len nazvy ktore su realne v db
//    // ta
//    protected $attributes = array('price');
//
//
//    // asi stale nechapes myslienku ... alebo mozno ja nechapem ..ak toto su vsetky ..alebo model vsetkych produktov..
//    // ocakavame teda ze chceme metodu ktora spravi getAllPrices() ?
//    // alebo toto je model vsetkych ale ty chces iba pre jeden ...
//    // no ja chcem to aby ked ich vsetkych vytiahnem...alebo ak si aj len jeden vytiahnem,, to je jedno...tak aby som Tam mal tu CENU
//    //// ok no chapem ...ale to je proste presne ten SQL dotaz co som napisal ...
//    //staci tento model napisat tak ..aby pri konstruktore zavolal tvoj upraveny sql ktory si vymyslis ( viz pred chvilou)
//    // pak mas hodnoty ake chces hned ...
//
//
//
//
//
//    public function getPrice()
//    {
//        $pole = $this->select(DB::raw('sizeX * sizeY as price'))->get();
//        var_dump($pole->toArray());die();
//        // mas tam pravdepodobne 2x niake ID ..pretoze ti ukazuje dve hodnoty ..je tak ?
//        // ci to daco insie ukazuje ? ...ano dva produkty su...lebo som odstranil to where...aha
//        // no a teraz co s tym ?
//
//
//        return $this->select(DB::raw('sizeX * sizeY as price'))->get()->values();
 //   }



}