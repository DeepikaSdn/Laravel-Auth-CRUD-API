<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Hash;
use Illuminate\Support\Str;

class APIController extends Controller
{
    public function login(Request $request){

        $rules = [            
            'email' => 'required',
            'password' => 'required',           
             ];           
      
           $request->validate($rules);    
        $User = User::where('email',$request->email)->first();
        if(!$User || !Hash::check($request->password,$User->password)){

            return response()->json([

                'status'=>false,

                'message'=>'Credentials donot match with our recods!'

            ],403);

        }else{
        $token = $User->createToken('user-token')->plainTextToken;
   
            return response()->json([
                'message' => 'User Logged In Successfully',
                'status'=>true,
                'token' => $token,
                'data' =>$User
            ], 200);
       
        }
    }

    public function products(Request $request)
    {

        $products = Product::with('categories')->where('status',1)->get();
        
        if($products){
            return response()->json([
                'message' => 'Product List',
                'status' => true,   
                'data' => $products         

            ], 200);
        }else{
            return response()->json([
                'message' => 'No Products',
                'status' => false,            

            ], 403);
        }


    }
}
