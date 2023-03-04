<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Candidate;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MsgResponse;


class UserController extends Controller
{
    public function register(Request $request){
        $msg = new MsgResponse;
        $validation = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'is_active' => 'required',
            'role' => 'required',
        ]);

        if ($validation->fails()){
            return response()->json($msg->msgResponse([], ['Error de validaciones']));
        }

        $d = User::create([
            'username'=>trim($request['username']),
            'password' => trim(Hash::make($request['password'])),
            'is_active'=>trim($request['is_active']),
            'role'=>trim($request['role']),
        ]);
        return response()->json($msg->msgResponse($d, []));
    }

    public function candidate(Request $request){
        $msg = new MsgResponse;
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'source' => 'required',
            'owner' => 'required',
        ]);

        //respuesta error validacion
        if ($validation->fails()){
            return response()->json($msg->msgResponse([], ['Error de validaciones']));
        }
        if(!Auth::check()){
            return response()->json($msg->msgResponse([], ['Debe logearse']));
        }

        if(Auth::user()->role != 'manager'){
            return response()->json($msg->msgResponse([], ['Solo el manager puede crear candidatos']));
        }else{
            if (!empty($request->all())) {
                $d = Candidate::create([
                    'name'=>trim($request->input('name')),
                    'source'=>trim($request->input('source')),
                    'owner'=>trim($request->input('owner')),
                    'created_by'=>Auth::user()->id,
                ]);
            }
            
            $dataMsg=[
                    'id'=>$d['id'],
                    'name'=>$d['name'],
                    'source'=>$d['source'],
                    'owner'=>$d['owner'],
                    "created_at"=>time(),
                    'created_by'=>Auth::user()->id,
            ];
            return response()->json($msg->msgResponse($dataMsg, []));

        }
    }

    public function getCandidate($id = null){
        $msg = new MsgResponse;
        if ($id==null) {
            return response()->json($msg->msgResponse([], ['No hay id']));
        }
        if(!Auth::check()){
            return response()->json($msg->msgResponse([], ['Debe loguearse']));
        }

        if(Auth::user()->role != 'manager'){
            $candidate = Candidate::where([['id', $id],['owner', Auth::user()->id]])->get();
        }else{
            $candidate = Candidate::find($id);
        }
        if ($candidate) {
            return response()->json($msg->msgResponse($candidate, []));
        }else{
            return response()->json($msg->msgResponse([], ['No hay registros en la BD']));
        }
    }

    public function getCandidates(){
        $msg = new MsgResponse;
        if(!Auth::check()){
            return response()->json($msg->msgResponse([], ['Debe loguearse']));
        }
        if(Auth::user()->role != 'manager'){
            $candidate = User::find(Auth::user()->id)->getCandidates;
        }else{
            $candidate = Candidate::all();
        }
        //dd(count($candidate));
        if (count($candidate) > 0) {
            return response()->json($msg->msgResponse($candidate, []));
        }else{
            return response()->json($msg->msgResponse([], ['No se encuentran candidatos registrados']));
        }
    }
}
