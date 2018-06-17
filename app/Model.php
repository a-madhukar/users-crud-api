<?php 

namespace App;

use Mongo; 


trait Model 
{

    protected static function collection()
    {
        $instance = new static; 

        return Mongo::get()->usersdatabase->{$instance->collection};
    }




}