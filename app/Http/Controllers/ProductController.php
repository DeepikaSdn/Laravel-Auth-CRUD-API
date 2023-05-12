<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::all();
        return view('admin.product.index',compact('products'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            "title" => 'string|required|min:3|max:150',           
            'image'=> 'mimes:jpeg,jpg,png|required',
            "qty" =>'required',
            "price"=>'required',

             ];           
      
         $request->validate($rules);    

       // if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName_photo = Str::random(40).'.png';
            $path_image = Storage::disk('public')->putFileAs('product/',$request->file('image'),$fileName_photo);
            // Product::where('id',$product->id)->update(['image'=> $fileName_photo]);
       // }
        $product = Product::create([
            "title" => $request->title,
            "image" =>  $fileName_photo  ,      
            'status' => $request->status,
            'quantity' =>$request->qty,
            'price' =>$request->price,
        ]);
//dd($request->category);
        $product->categories()->sync($request->category);

        request()->session()->flash('success', 'Product  Created Successfully!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();

        $product = Product::with('categories')->where('id',$id)->first();
        return view('admin.product.edit',compact('product','categories'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            "title" => 'string|required|min:3|max:150',           
            'image'=> 'mimes:jpeg,jpg,png',
            "qty" =>'required',
            "price"=>'required',

             ];
                 
             $request->validate($rules);
    
        $product = Product::where('id',$id)->update([
            "title" => $request->title,
            'status' => $request->status,
            'quantity' =>$request->qty,
            'price'=>$request->price
        ]);
        $productdata=Product::find($id);
        $productdata->categories()->sync($request->category);

        if($request->hasFile('image')) {
            $image = $request->file('image');
           // $fileName_photo = Str::random(40).'.'.$request->file('photo')->getClientOriginalExtension();
            $fileName_photo = Str::random(40).'.png';
            $path_image = Storage::disk('public')->putFileAs('product/',$request->file('image'),$fileName_photo);
             Product::where('id',$id)->update(['image'=> $fileName_photo]);
        }
        request()->session()->flash('success', 'Product Updated Successfully!');
        return redirect()->route('admin.products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  Product::where('id', $id)->delete();
        if($data){
            request()->session()->flash('success', 'Product deleted Successfully!');
           
        }else{
            request()->session()->flash('success', 'Product deleted Failed!');

        }
        return redirect()->route('admin.products.index');
    }
}
