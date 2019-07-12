<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemitaMandateController extends Controller
{

    public function setUpMandate(Request $request){
        $this->validate($request, [
            ''
        ]);
        
    }
    
}