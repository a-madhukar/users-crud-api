<?php

namespace App\Http\Controllers;

use App\User; 
use Illuminate\Http\Request; 


class UsersController extends Controller
{



    public function index()
    {

        return response()->json([
            "data" => User::all(), 
        ], 200); 
    }



    

    public function show($userId)
    {
        if(!$this->checkValidIdlength($userId)) 
            return $this->invalidIdResponse(); 

        return response()->json([
            "data" => User::findById($userId), 
        ], 200); 
    }




    public function store(Request $request, $userId = null)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]); 

        if(!is_null($userId) && !$this->checkValidIdlength($userId))
            return $this->invalidIdResponse(); 


        return response()->json([
            "data" => User::persist(
                $request->all(["username","email","role"]), 
                $userId
            )
        ]); 
    }





    public function destroy(Request $request, $userId)
    {
        if(!$this->checkValidIdlength($userId)) 
            return $this->invalidIdResponse(); 

        return response()->json([
            "data" => User::delete($userId)
        ]); 


    }




    protected function checkValidIdlength($id)
    {
        return strlen($id) == 24; 
    }




    protected function invalidIdResponse()
    {
        return response()->json([
            "error" => "Incorrect Id"
        ], 400); 
    }


}
