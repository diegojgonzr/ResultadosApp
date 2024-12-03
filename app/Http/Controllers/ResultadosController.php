<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Facade\FlareClient\View;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ResultadosController extends Controller
{
    //

    public function index(){

        $client = new Client();

        // Mapa de traducción de días y meses
        $dias = [
            'Lunes' => 'Monday',
            'Martes' => 'Tuesday',
            'Miércoles' => 'Wednesday',
            'Jueves' => 'Thursday',
            'Viernes' => 'Friday',
            'Sábado' => 'Saturday',
            'Domingo' => 'Sunday'
        ];

        $meses = [
            'Enero' => 'January',
            'Febrero' => 'February',
            'Marzo' => 'March',
            'Abril' => 'April',
            'Mayo' => 'May',
            'Junio' => 'June',
            'Julio' => 'July',
            'Agosto' => 'August',
            'Septiembre' => 'September',
            'Octubre' => 'October',
            'Noviembre' => 'November',
            'Diciembre' => 'December'
        ];

        // Go to the symfony.com website
        $crawler = $client->request('GET', 'https://www.lottoresultados.com/resultados/animalitos');
        
        date_default_timezone_set('America/Caracas');
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');

        $fechaActual= strftime('%A, %e de %B de %Y');    //date('l, d \d\e  ').date('F')." de ".date('Y')."<br>";

        $fechaResultado = $crawler->filter(".card-header h2")->text();
        foreach ($dias as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }
        foreach ($meses as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }

        $fecha = Carbon::createFromFormat('l, d \d\e F \d\e Y', $fechaResultado);

        /*print utf8_encode(strtoupper($fechaActual))."-";
        print strtoupper($fechaResultado);*/
        //if (utf8_encode(strtoupper($fechaActual))==strtoupper($fechaResultado)){
            $resultados = [];
            $resultados["MSG"]="Resultados Encontrados";
            $crawler->filter(".row #resultado-de-condor-gana-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[31][]=$resultado;
                });
            });

            /*$crawler->filter(".row #resultado-de-lotto-activo-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[1][]=$resultado;
                });
            });*/

            $crawler->filter(".row #resultado-de-animalitos-granja-millonaria-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[9][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-guacharo-activo-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[18][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-el-granjazo-granja-millonaria-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[30][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-la-ricachona-animalitos-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[32][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-la-granjita-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[5][]=$resultado;
                });
            });

            /*$crawler->filter(".row #resultado-de-lotto-activo-rd-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[3][]=$resultado;
                });
            });*/

            $crawler->filter(".row #resultado-de-chance-con-animalitos-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    // Convierte la cadena de tiempo a un timestamp
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[33][]=$resultado;
                });
            });

            /*$crawler->filter(".row #resultado-de-ruleta-activa-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[2][]=$resultado;
                });
            });*/

            $crawler->filter(".row #resultado-de-lotto-rey-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[10][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-selva-plus-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[6][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-jungla-millonaria-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[11][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-ruleta-royal-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[7][]=$resultado;
                });
            });

            $crawler->filter(".row #resultado-de-super-gana-de-hoy")->each(function($node) use(&$resultados,&$fecha){
                $node->filter(".step-item")->each(function($item) use (&$resultados,&$fecha){
                    $resultado = [];
                    $timestamp = strtotime($item->filter("h4")->text());
                    $resultado["fecha"] = $fecha->format('Y-m-d');
                    $resultado["hora"] = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $resultado["numero"] = $item->filter("p")->text();
                    $resultados[34][]=$resultado;
                });
            });

            return $resultados;
        /*}else{
            return ["MSG"=>"No hay resultados de hoy"];
        }*/

    }

    public function loterias(){
        $client = new Client();

        // Go to the symfony.com website
        $crawler = $client->request('GET', 'https://www.lottoresultados.com/resultados/loterias');
        
        $dias = [
            'Lunes' => 'Monday',
            'Martes' => 'Tuesday',
            'Miércoles' => 'Wednesday',
            'Jueves' => 'Thursday',
            'Viernes' => 'Friday',
            'Sábado' => 'Saturday',
            'Domingo' => 'Sunday'
        ];
        
        $meses = [
            'Enero' => 'January',
            'Febrero' => 'February',
            'Marzo' => 'March',
            'Abril' => 'April',
            'Mayo' => 'May',
            'Junio' => 'June',
            'Julio' => 'July',
            'Agosto' => 'August',
            'Septiembre' => 'September',
            'Octubre' => 'October',
            'Noviembre' => 'November',
            'Diciembre' => 'December'
        ];
        
        date_default_timezone_set('America/Caracas');
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');
        
        $fechaActual= strftime('%A, %e de %B de %Y');    //date('l, d \d\e  ').date('F')." de ".date('Y')."<br>";
        
        $fechaResultado = $crawler->filter(".card-header h2")->text();
        foreach ($dias as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }
        foreach ($meses as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }
        
        $fecha = Carbon::createFromFormat('l, d \d\e F \d\e Y', $fechaResultado);
        
        /*print strtoupper($fechaActual)."-";
        print strtoupper($fechaResultado);*/
        //if (utf8_encode(strtoupper($fechaActual))==strtoupper($fechaResultado)){
            $results = [];
            $results["MSG"]="Resultados Encontrados";
            
            $crawler->filter('#resultado-de-loteria-del-zulia-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '22,23',
                            'A' => $numbers[0],
                            'B' => $numbers[1],
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '22,23',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-loteria-del-zulia-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'id' => '35,24',
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-loteria-del-tachira-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '14,16',
                            'A' => $numbers[0],
                            'B' => $numbers[1],
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '14,16',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-loteria-del-tachira-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'id' => '36,17',
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-loteria-de-caracas-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '25,26',
                            'A' => $numbers[0],
                            'B' => $numbers[1],
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '25,26',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-loteria-de-caracas-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'id' => '38,27',
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-chance-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '19,20',
                            'A' => $numbers[0],
                            'B' => $numbers[1],
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '19,20',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-chance-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'id' => '37,21',
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-triple-zamorano-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '63',
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '63',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-triple-zamorano-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '39',
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '39',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-triple-zamorano-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'id' => '40',
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-triple-caliente-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '41,42',
                            'A' => $numbers[0],
                            'B' => $numbers[1],
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '41,42',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-triple-caliente-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'id' => '43,44',
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-super-gana-de-hoy .card')->eq(0)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-super-gana-de-hoy .card')->eq(1)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '45,46',
                            'numbers' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-super-gana-de-hoy .card')->eq(2)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '29',
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '29',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-super-gana-de-hoy .card')->eq(3)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-super-gana-de-hoy .card')->eq(4)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-la-ruca-de-hoy .card')->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '50',
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-la-ricachona-de-hoy .card')->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '46',
                            'before' => $numbers[0],
                            'after' => $numbers[1],
                            'number' => $numbers[2],
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '46',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-centena-plus-de-hoy .card')->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-trio-activo-el-patronus-de-hoy .card')->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '47',
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '47',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-terminalito-de-hoy .card')->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    if (count($numbers)>0){
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '48',
                            'number' => $numbers[0]
                        ];
                    }else{
                        $entries[] = [
                            'time' => $time,
                            'fecha' => $fecha->format('Y-m-d'),
                            'id' => '48',
                            'number' => $numbers
                        ];
                    }
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            $crawler->filter('#resultado-de-loteria-de-caracas-de-hoy .card')->eq(2)->each(function ($card) use (&$results,&$fecha) {
                $title = $card->filter('h4 a')->text();
                $entries = [];
    
                $card->filter('.row.border-bottom')->each(function ($row) use (&$entries,&$fecha) {
                    $timestamp = strtotime($row->filter('h4.fs-4')->text());
                    $time = sprintf("%02d:%s-%s", date("g", $timestamp), date("i", $timestamp), date("A", $timestamp));
                    $numbers = $row->filter('.row.text-center .col-6.pt-2, .row.text-center .col-12.pt-2')->each(function ($col) {
                        return $col->text();
                    });
                    $entries[] = [
                        'time' => $time,
                        'fecha' => $fecha->format('Y-m-d'),
                        'numbers' => $numbers,
                    ];
                });
    
                $results[] = [
                    'title' => $title,
                    'entries' => $entries,
                ];
            });

            return $results;
       /*}else{
            return ["MSG"=>"No hay resultados de hoy"];
        }*/

    }


    public function diaEspanol($dia){

        //return $diaE;
    }

    public function mesEspanol($mes){

    }

    public function prueba(){

        $client = new Client();
        $url = 'https://www.lotochaima.com/resultados'; // Cambia a la URL real
        $crawler = $client->request('GET', $url);

        // Extraer datos de las tarjetas
        $results = $crawler->filter('.grid > div')->each(function ($node) {
            return [
                'hora' => $node->filter('.text-lg.font-medium.text-blue-500')->text(),
                'numero' => $node->filter('.text-2xl.font-medium')->eq(0)->text(),
                'animal' => $node->filter('.text-2xl.font-medium')->eq(1)->text(),
                'fecha' => $node->filter('.block.w-full.rounded-b-3xl')->text(),
                'imagen' => $node->filter('img')->attr('src'),
            ];
        });

        // Mostrar resultados
        return response()->json($results);

        /*$client = new Client();
        $crawler = $client->request('GET', 'https://www.tuazar.com/loteria/animalitos/resultados/');
        $htmlContent = $crawler->html();
        echo $htmlContent;*/
    }

    public function granjaPlus(){
        $client = new Client();

        // Especifica la URL de la página a la que deseas acceder
        $url = 'https://granjaplus.com/';

        try {
            $crawler = $client->request('GET', $url);

            // Extraer la información de los resultados
            $resultados = $crawler->filter('.row .col-md-3')->each(function ($node) {
                $hora = $node->filter('span.hour')->text();
                $imagenSrc = $node->filter('img')->attr('src');
                $nombreAnimal = $node->filter('span.name')->text();

                // Extraer el número del nombre del archivo de la imagen
                $numero = basename($imagenSrc, '.jpg'); // Obtener el nombre del archivo sin la extensión .jpg

                // Devolver los datos en un array
                return [
                    'hora' => $hora,
                    'numero' => $numero,
                    'nombre_animal' => $nombreAnimal,
                ];
            });

            // Retornar los resultados en formato JSON
            return $resultados;

        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir al hacer la solicitud
            return ['error' => $e->getMessage()];
        }
    }

    public function tuAzarAnimalitos(){

        // Mapa de traducción de días y meses
        $dias = [
            'Lunes' => 'Monday',
            'Martes' => 'Tuesday',
            'Miércoles' => 'Wednesday',
            'Jueves' => 'Thursday',
            'Viernes' => 'Friday',
            'Sábado' => 'Saturday',
            'Domingo' => 'Sunday'
        ];

        $meses = [
            'Enero' => 'January',
            'Febrero' => 'February',
            'Marzo' => 'March',
            'Abril' => 'April',
            'Mayo' => 'May',
            'Junio' => 'June',
            'Julio' => 'July',
            'Agosto' => 'August',
            'Septiembre' => 'September',
            'Octubre' => 'October',
            'Noviembre' => 'November',
            'Diciembre' => 'December'
        ];

        $url = 'https://www.tuazar.com/loteria/animalitos/resultados/';

        // Inicializar Goutte
        $client = new Client();

        // Hacer la solicitud GET a la URL
        $crawler = $client->request('GET', $url);
        
        date_default_timezone_set('America/Caracas');
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');

        $fechaActual= strftime('%A, %e de %B de %Y');    //date('l, d \d\e  ').date('F')." de ".date('Y')."<br>";

        $fecha = $crawler->filter("time")->attr('datetime');
        
        /*foreach ($dias as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }
        foreach ($meses as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }

        $fecha = Carbon::createFromFormat('l, d \d\e F \d\e Y', $fechaResultado);*/

        $resultados = [];
        // Extraer la información de cada resultado
        $crawler->filter('.resultados')->each(function ($node) use (&$fecha,&$resultados) {
            if ($node->filter("h2")->text()=="GRANJA PLUS"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[52][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="LOTTO ACTIVO"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[1][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            /*if ($node->filter("h2")->text()=="LOTTOREY"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[10][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="LA GRANJITA"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[5][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="CHANCE CON ANIMALITOS"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[33][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="JUNGLA MILLONARIA"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[11][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="GUACHARO ACTIVO"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[18][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="SELVA PLUS"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[6][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }

            if ($node->filter("h2")->text()=="TROPI GANA"){
                $node->filter(".resultado .col-xs-6")->each(function ($item) use (&$fecha,&$resultados) {
                    $hora = trim($item->filter('.horario span')->text());
                    $imagenSrc = $item->filter('img')->attr('alt');

                    $imagenSrc = explode(" - ",$imagenSrc);

                    if (!isset($imagenSrc[0]))
                        $imagenSrc[0]="";
                    if (!isset($imagenSrc[1]))
                        $imagenSrc[1]="";

                    // Devolver los datos en un array asociativo
                    $resultados[12][]=[
                        'fecha'=>$fecha,
                        'hora' => $hora,
                        'numero' => $imagenSrc[0],
                        'nombre' => $imagenSrc[1],
                    ];
                });
            }*/
        });

        // Retornar los resultados en formato JSON
        return $resultados;
    }

    function translateMonthToEnglish($dateText) {
        $months = [
            'enero' => 'January',
            'febrero' => 'February',
            'marzo' => 'March',
            'abril' => 'April',
            'mayo' => 'May',
            'junio' => 'June',
            'julio' => 'July',
            'agosto' => 'August',
            'septiembre' => 'September',
            'octubre' => 'October',
            'noviembre' => 'November',
            'diciembre' => 'December'
        ];
    
        foreach ($months as $spanish => $english) {
            $dateText = str_replace(" $spanish ", " $english ", $dateText);
        }
    
        return $dateText;
    }

    public function loteriasHoyLottoInt(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://loteriadehoy.com/animalito/lottoactivordint/resultados/');
        
        // Extrae la fecha del título de la página
        $dateText = $crawler->filter('.section-title h1 p.text-h1 strong')->text();
        $dateText = $this->translateMonthToEnglish($dateText); // Convierte los meses al inglés

        // Usa Carbon para parsear la fecha y formatearla
        try {
            $date = Carbon::createFromFormat('j \d\e F \d\e Y', $dateText)->format('Y-m-d');
            } catch (\Exception $e) {
            return response()->json(['error' => 'Error al parsear la fecha'], 500);
        }

        $results = [];
    
        $crawler->filter('.row.text-center.js-con .col-sm-6.col-md-4.col-lg-16.mb-5')->each(function ($node) use ($date, &$results) {
            // Extrae el texto completo (número y nombre del animal)
            $animalText = $node->filter('.circle-legend h4')->text();
    
            // Separa el número y el nombre del animal
            preg_match('/(\d+)\s+(.+)/', $animalText, $matches);
            $number = $matches[1];
            $animalName = $matches[2];
    
            // Extrae la hora
            $timeText = $node->filter('.circle-legend h5')->text();
            preg_match('/(\d{1,2}:\d{2} (AM|PM))/', $timeText, $timeMatches);
            $time = str_replace(' ', '-', $timeMatches[1]);
    
            // Agrega los resultados al array
            $results[53][] = [
                'fecha' => $date,
                'numero' => $number." ".$animalName,
                'hora' => $time,
            ];
        });
    
        return $results;
    }

    public function loteriasHoyCazaloton(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://loteriadehoy.com/animalito/cazaloton/resultados/');
        
        // Extrae la fecha del título de la página
        $dateText = $crawler->filter('.section-title h1 p.text-h1 strong')->text();
        $dateText = $this->translateMonthToEnglish($dateText); // Convierte los meses al inglés

        // Usa Carbon para parsear la fecha y formatearla
        try {
            $date = Carbon::createFromFormat('j \d\e F \d\e Y', $dateText)->format('Y-m-d');
            } catch (\Exception $e) {
            return response()->json(['error' => 'Error al parsear la fecha'], 500);
        }

        $results = [];
    
        $crawler->filter('.row.text-center.js-con .col-sm-6.col-md-4.col-lg-16.mb-5')->each(function ($node) use ($date, &$results) {
            // Extrae el texto completo (número y nombre del animal)
            $animalText = $node->filter('.circle-legend h4')->text();
    
            // Separa el número y el nombre del animal
            preg_match('/(\d+)\s+(.+)/', $animalText, $matches);
            $number = $matches[1];
            $animalName = $matches[2];
    
            // Extrae la hora
            $timeText = $node->filter('.circle-legend h5')->text();
            preg_match('/(\d{1,2}:\d{2} (AM|PM))/', $timeText, $timeMatches);
            $time = str_replace(' ', '-', $timeMatches[1]);
    
            // Agrega los resultados al array
            $results[54][] = [
                'fecha' => $date,
                'numero' => $number." ".$animalName,
                'hora' => $time,
            ];
        });
    
        return $results;
    }

    public function loteriasHoyMegaAnimal(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://loteriadehoy.com/animalito/megaanimal40/resultados/');
        
        // Extrae la fecha del título de la página
        $dateText = $crawler->filter('.section-title h1 p.text-h1 strong')->text();
        $dateText = $this->translateMonthToEnglish($dateText); // Convierte los meses al inglés

        // Usa Carbon para parsear la fecha y formatearla
        try {
            $date = Carbon::createFromFormat('j \d\e F \d\e Y', $dateText)->format('Y-m-d');
            } catch (\Exception $e) {
            return response()->json(['error' => 'Error al parsear la fecha'], 500);
        }

        $results = [];
    
        $crawler->filter('.row.text-center.js-con .col-sm-6.col-md-4.col-lg-16.mb-5')->each(function ($node) use ($date, &$results) {
            // Extrae el texto completo (número y nombre del animal)
            $animalText = $node->filter('.circle-legend h4')->text();
    
            // Separa el número y el nombre del animal
            preg_match('/(\d+)\s+(.+)/', $animalText, $matches);
            $number = $matches[1];
            $animalName = $matches[2];
    
            // Extrae la hora
            $timeText = $node->filter('.circle-legend h5')->text();
            preg_match('/(\d{1,2}:\d{2} (AM|PM))/', $timeText, $timeMatches);
            $time = str_replace(' ', '-', $timeMatches[1]);
    
            // Agrega los resultados al array
            $results[55][] = [
                'fecha' => $date,
                'numero' => $number." ".$animalName,
                'hora' => $time,
            ];
        });
    
        return $results;
    }

    public function loteriasHoyLottoRD(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://loteriadehoy.com/animalito/lottoactivordominicana/resultados/');
        
        // Extrae la fecha del título de la página
        $dateText = $crawler->filter('.section-title h1 p.text-h1 strong')->text();
        $dateText = $this->translateMonthToEnglish($dateText); // Convierte los meses al inglés

        // Usa Carbon para parsear la fecha y formatearla
        try {
            $date = Carbon::createFromFormat('j \d\e F \d\e Y', $dateText)->format('Y-m-d');
            } catch (\Exception $e) {
            return response()->json(['error' => 'Error al parsear la fecha'], 500);
        }

        $results = [];
    
        $crawler->filter('.row.text-center.js-con .col-sm-6.col-md-4.col-lg-16.mb-5')->each(function ($node) use ($date, &$results) {
            // Extrae el texto completo (número y nombre del animal)
            $animalText = $node->filter('.circle-legend h4')->text();
    
            // Separa el número y el nombre del animal
            preg_match('/(\d+)\s+(.+)/', $animalText, $matches);
            $number = $matches[1];
            $animalName = $matches[2];
    
            // Extrae la hora
            $timeText = $node->filter('.circle-legend h5')->text();
            preg_match('/(\d{1,2}:\d{2} (AM|PM))/', $timeText, $timeMatches);
            $time = str_replace(' ', '-', $timeMatches[1]);
    
            // Agrega los resultados al array
            $results[3][] = [
                'fecha' => $date,
                'numero' => $number." ".$animalName,
                'hora' => $time,
            ];
        });
    
        return $results;
    }

    public function loteriasHoyRuletaActiva(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://loteriadehoy.com/animalito/ruletaactiva/resultados/');
        
        // Extrae la fecha del título de la página
        $dateText = $crawler->filter('.section-title h1 p.text-h1 strong')->text();
        $dateText = $this->translateMonthToEnglish($dateText); // Convierte los meses al inglés

        // Usa Carbon para parsear la fecha y formatearla
        try {
            $date = Carbon::createFromFormat('j \d\e F \d\e Y', $dateText)->format('Y-m-d');
            } catch (\Exception $e) {
            return response()->json(['error' => 'Error al parsear la fecha'], 500);
        }

        $results = [];
    
        $crawler->filter('.row.text-center.js-con .col-sm-6.col-md-4.col-lg-16.mb-5')->each(function ($node) use ($date, &$results) {
            // Extrae el texto completo (número y nombre del animal)
            $animalText = $node->filter('.circle-legend h4')->text();
    
            // Separa el número y el nombre del animal
            preg_match('/(\d+)\s+(.+)/', $animalText, $matches);
            $number = $matches[1];
            $animalName = $matches[2];
    
            // Extrae la hora
            $timeText = $node->filter('.circle-legend h5')->text();
            preg_match('/(\d{1,2}:\d{2} (AM|PM))/', $timeText, $timeMatches);
            $time = str_replace(' ', '-', $timeMatches[1]);
    
            // Agrega los resultados al array
            $results[2][] = [
                'fecha' => $date,
                'numero' => $number." ".$animalName,
                'hora' => $time,
            ];
        });
    
        return $results;
    }

    public function tuAzarTriples(){

        // Mapa de traducción de días y meses
        $dias = [
            'Lunes' => 'Monday',
            'Martes' => 'Tuesday',
            'Miércoles' => 'Wednesday',
            'Jueves' => 'Thursday',
            'Viernes' => 'Friday',
            'Sábado' => 'Saturday',
            'Domingo' => 'Sunday'
        ];

        $meses = [
            'Enero' => 'January',
            'Febrero' => 'February',
            'Marzo' => 'March',
            'Abril' => 'April',
            'Mayo' => 'May',
            'Junio' => 'June',
            'Julio' => 'July',
            'Agosto' => 'August',
            'Septiembre' => 'September',
            'Octubre' => 'October',
            'Noviembre' => 'November',
            'Diciembre' => 'December'
        ];

        $url = 'https://www.tuazar.com/loteria/resultados/';

        // Inicializar Goutte
        $client = new Client();

        // Hacer la solicitud GET a la URL
        $crawler = $client->request('GET', $url);
        
        date_default_timezone_set('America/Caracas');
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');

        $fechaActual= strftime('%A, %e de %B de %Y');    //date('l, d \d\e  ').date('F')." de ".date('Y')."<br>";

        $fecha = $crawler->filter("time")->attr('datetime');
        
        /*foreach ($dias as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }
        foreach ($meses as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }

        $fecha = Carbon::createFromFormat('l, d \d\e F \d\e Y', $fechaResultado);*/

        $resultados = [];
        // Extraer la información de cada resultado
        $crawler->filter('.resultados')->each(function ($node) use (&$fecha,&$resultados) {
            if ($node->filter("h2")->text()=="TRIPLE FÁCIL"){
                $node->filter(".resultado")->each(function ($item, $i) use (&$fecha,&$resultados) {
                    // Saltar la primera iteración
                    if ($i == 0) {
                        return; // Continuar con la siguiente iteración
                    }
                    $horaNode = $item->filterXPath('//div[contains(@class, "col-xs-4")]');
                    $numeroNode = $item->filterXPath('//div[contains(@class, "col-xs-8")]');
        
                    if ($horaNode->count() > 0 && $numeroNode->count() > 0) {
                        $hora = trim($horaNode->text());
                        $numero = trim($numeroNode->text());
        
                        // Devolver los datos en un array asociativo
                        $resultados[51][] = [
                            'fecha'=>$fecha,
                            'hora' => $hora,
                            'numero' => $numero,
                        ];
                    }
                });
            }
        });

        

        // Retornar los resultados en formato JSON
        return $resultados;
    }

    public function tuAzarTripleDorado(){

        // Mapa de traducción de días y meses
        $dias = [
            'Lunes' => 'Monday',
            'Martes' => 'Tuesday',
            'Miércoles' => 'Wednesday',
            'Jueves' => 'Thursday',
            'Viernes' => 'Friday',
            'Sábado' => 'Saturday',
            'Domingo' => 'Sunday'
        ];

        $meses = [
            'Enero' => 'January',
            'Febrero' => 'February',
            'Marzo' => 'March',
            'Abril' => 'April',
            'Mayo' => 'May',
            'Junio' => 'June',
            'Julio' => 'July',
            'Agosto' => 'August',
            'Septiembre' => 'September',
            'Octubre' => 'October',
            'Noviembre' => 'November',
            'Diciembre' => 'December'
        ];

        $url = 'https://www.tuazar.com/loteria/resultados/';

        // Inicializar Goutte
        $client = new Client();

        // Hacer la solicitud GET a la URL
        $crawler = $client->request('GET', $url);
        
        date_default_timezone_set('America/Caracas');
        setlocale(LC_TIME, 'es_VE.UTF-8','esp');

        $fechaActual= strftime('%A, %e de %B de %Y');    //date('l, d \d\e  ').date('F')." de ".date('Y')."<br>";

        $fecha = $crawler->filter("time")->attr('datetime');
        
        /*foreach ($dias as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }
        foreach ($meses as $es => $en) {
            $fechaResultado = str_replace($es, $en, $fechaResultado);
        }

        $fecha = Carbon::createFromFormat('l, d \d\e F \d\e Y', $fechaResultado);*/

        $resultados = [];
        // Extraer la información de cada resultado
        $crawler->filter('.resultados')->each(function ($node) use (&$fecha,&$resultados) {
            if ($node->filter("h2")->text()=="TRIPLE DORADO"){
                $node->filter(".resultado")->each(function ($item, $i) use (&$fecha,&$resultados) {
                    // Saltar la primera iteración
                    if ($i == 0) {
                        return; // Continuar con la siguiente iteración
                    }
                    $horaNode = $item->filterXPath('//div[contains(@class, "col-xs-4")]');
                    $numeroNode = $item->filterXPath('//div[contains(@class, "col-xs-8")]');
        
                    if ($horaNode->count() > 0 && $numeroNode->count() > 0) {
                        $hora = trim($horaNode->text());
                        $numero = trim($numeroNode->text());
        
                        // Devolver los datos en un array asociativo
                        $resultados[72][] = [
                            'fecha'=>$fecha,
                            'hora' => $hora,
                            'numero' => $numero,
                        ];
                    }
                });
            }
        });

        

        // Retornar los resultados en formato JSON
        return $resultados;
    }

    public function scrapeAnimalitos(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://triples.bet/products-results/resultados-animalitos-loteria/');

        // Extraer la fecha
        $fechaTexto = $crawler->filter('.panel-results-header h4')->text();
        $fechaTexto = trim(str_replace('Sorteos de Hoy', '', $fechaTexto));
        $fecha = $this->convertirFechaAFormatoYYYYMMDD($fechaTexto);

        // Inicializar el array que contendrá todos los resultados
        $resultados = [];

        // Iterar sobre cada tabla de resultados
        $crawler->filter('.result-week-table')->each(function ($table, $index) use (&$resultados, $fecha) {
            // Obtener el nombre de la lotería
            $loteriaNombre = $table->filter('div.producto55')->first()->text();
            $loteriaNombre = 57;//trim(str_replace(' Resultados', '', $loteriaNombre));

            $resultados[$loteriaNombre] = [];

            // Extraer los resultados dentro de cada tabla
            $table->filter('tr')->each(function ($tr) use (&$resultados, $loteriaNombre, $fecha) {
                $tds = $tr->filter('td');

                if ($tds->count() > 0) {
                    $tds->each(function ($td) use (&$resultados, $loteriaNombre, $fecha) {
                        $hora = $this->getTextFromFilter($td, '.producto55_estilo_2');
                        $numeroNombre = $this->getTextFromFilter($td, '.boxresults_55');
                        if (!empty(trim($numeroNombre))) {
                            $hora = $this->convertirHora($hora);

                            $resultados[$loteriaNombre][] = [
                                'fecha' => $fecha,
                                'hora' => $hora,
                                'numero' => $numeroNombre,
                            ];
                        }
                    });
                }
            });
            // Filtrar resultados para eliminar aquellos con 'numero' vacío
            $resultados[$loteriaNombre] = array_filter($resultados[$loteriaNombre], function($resultado) {
            // Verificar que el número no esté vacío y no contenga solo caracteres especiales
            $numero = trim($resultado['numero']);
            return !empty($numero) && $numero !== "&nbsp;" && $numero !== " ";
            });
        });

        // Imprimir el JSON con los resultados
        return $resultados;
    }

    private function getTextFromFilter($node, $filter){
        $filteredNode = $node->filter($filter);
        return $filteredNode->count() > 0 ? $filteredNode->text() : '';
    }

    private function convertirFechaAFormatoYYYYMMDD($fechaTexto)    {
        // Meses en español a inglés
        $meses = [
            'enero' => 'January', 'febrero' => 'February', 'marzo' => 'March', 'abril' => 'April',
            'mayo' => 'May', 'junio' => 'June', 'julio' => 'July', 'agosto' => 'August',
            'septiembre' => 'September', 'octubre' => 'October', 'noviembre' => 'November', 'diciembre' => 'December'
        ];

        // Reemplaza el nombre del mes en español con el nombre en inglés
        $fechaTexto = str_replace(array_keys($meses), array_values($meses), strtolower(trim($fechaTexto)));

        // Convertir la fecha al formato yyyy-mm-dd
        $date = \DateTime::createFromFormat('d F Y', $fechaTexto);
        return $date ? $date->format('Y-m-d') : $fechaTexto;
    }

    private function convertirHora($hora){
        // Convertir la hora de 24h a formato AM/PM
        $time = \DateTime::createFromFormat('H:i:s', $hora);
        return $time ? $time->format('h:i-A') : $hora;
    }

}