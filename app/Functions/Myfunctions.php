<?php
namespace App\Functions;


trait Myfunctions
{
    private $var;
    public function myName($var){
        return "test trait" . $var;
    }
}

?>