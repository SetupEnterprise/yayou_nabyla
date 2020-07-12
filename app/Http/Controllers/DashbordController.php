<?php

namespace App\Http\Controllers;

use App\models\Automobile;
use DateTime;
use Illuminate\Http\Request;

class DashbordController extends Controller
{

    function getNbAutoVendus( $mois){
        
        $moisCount = Automobile::whereMonth('date_vente', $mois)->where('estVendu', 1)->count();
            
        return $moisCount;
    }

    function getDonneesAutoMensuels(){
        $mois = ['1' => 'Jan', '2' =>'Fev','3'=>'Mar','4'=>'Avr','5'=>'Mai','6'=>'Juin','7'=>'Juil','8'=>'Aout','9'=>'Sept','10'=>'Oct','11'=>'Nov','12'=>'Dec'];
        $mois_count_array = [];
        $month_name_array = [];
        if(!empty($mois)){
            foreach ($mois as $month_no => $month_name) {
                $mois_count = $this->getNbAutoVendus($month_no);
                array_push($mois_count_array, $mois_count);
                array_push($month_name_array, $month_name);
            }
        }
        $max_nb = collect($mois_count_array)->max();
        $mx= round( ( $max_nb + 10/2 ) / 10 ) * 10;
        $autos_mensuels_tab = [
            'mois' => $month_name_array,
            'nb_vente_mensuel' => $mois_count_array,
            'max' => $mx
        ];
        
        return $autos_mensuels_tab;

    }

    function getStatusVente(){
        $vendu = Automobile::where('estVendu', 1)->count();
        $non_vendu = Automobile::where('estVendu', 0)->count();
        $vente = [($vendu*100)/$vendu+$non_vendu, ($non_vendu/100)/$vendu+$non_vendu];
        $auto = [
            'vente' => $vente
        ];
        return $auto;
    }

}
