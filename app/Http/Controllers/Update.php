<?php

namespace App\Http\Controllers;

use App\Models\Container;
use Illuminate\Http\Request;

class Update extends Controller
{
    public function save(){
      
        $containerSave =  Container::all();

        foreach ($containerSave as $key => $value) {
            
dd($value);

        }



        
      
        return $containerSave ;
    }
}
