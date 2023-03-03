<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MsgResponse extends Controller
{
    public function msgResponse($data=[], $errors=[]){
        //dd($data);
        $msg = [
            "meta"=>[
                    "success"=>"true",
                    "errors"=>$errors,
            ],
            "data"=>$data,
        ];

        return $msg;
    }
}
