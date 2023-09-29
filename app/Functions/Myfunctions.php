<?php
namespace App\Functions;


trait Myfunctions
{
    private $var;
    public function myName($var){
        return "test trait" . $var;
    }

    public function FixedDate($date):string{
       
        $temp = explode("-", $date);
        $annee = $temp[0];
        $mois = $temp[1];
        $jour = $temp[2];
        // $mydate = new \DateTime($date);
        // $annee = $mydate->format("yyyy");
        // $mois = $mydate->format("mm");
        // $jour = $mydate->format("dd");

        $dateFixed = $jour . "/" . $mois . "/" . $annee;
        return $dateFixed;
    } 
}

?>