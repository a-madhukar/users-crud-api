<?php

namespace App\Http\Controllers;

use App\User; 
use Illuminate\Http\Request; 


class UsersController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    



    public function index()
    {

        return response()->json([
            "data" => User::all(), 
        ], 200); 
    }



    

    public function show($userId)
    {
        return response()->json([
            "data" => User::findById($userId), 
        ], 200); 
    }




    public function store(Request $request)
    {
        return response()->json([
            "data" => User::persist(
                $request->all(["username","email","role"])
            )
        ]); 
    }




    public function update(Request $request, $userId)
    {
        return response()->json([
            "data" => User::findAndUpdate(
                $userId, 
                $request->all(["username","email","role"])
            )
        ]); 
    }




    public function destroy(Request $request, $userId)
    {
        
        return response()->json([
            "data" => User::delete($userId)
        ]); 


    }


}
