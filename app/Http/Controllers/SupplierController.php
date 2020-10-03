<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(){
      $data=Supplier::all();
      return view('welcome', compact('data'));
    }
    public function add(Request $request){
      if($request->has('submit')){
        
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
         ]);
        $data=Supplier::where('name',$request->name)->where('category_id', $request->category_id)->first();
        if($data){
          return redirect()->back()->withError('Name and category already exist.');
        }else{
          Supplier::create($request->all());
          return redirect()->back()->withSuccess('Added successfully.');
        }
      }
       $countries=Country::all();
       $categories=Category::all();
       return view('add', compact('countries','categories'));
    }
    public function edit(Request $request,$id){
      
      if($request->has('submit')){
        
        $validatedData = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
         ]);
        $data=Supplier::where('name',$request->name)->where('category_id', $request->category_id)->first();
        if($data){
          return redirect()->back()->withError('Name and category already exist.');
        }else{
          $data=Supplier::where('id', $request->id)->first();
          $data->name = $request->name;
          $data->category_id = $request->category_id;
          $data->country_id = $request->country_id;
          $data->save();
          return redirect()->back()->withSuccess('Edit successfully.');
        }
      }
      $data=Supplier::where('id', $id)->first();
      $countries=Country::all();
      $categories=Category::all();
      return view('edit', compact('data', 'countries','categories')); 
    }
    public function delete(Request $request){
      $data = $request->all();
      $sup = Supplier::find($data['id']);
      $res=$sup->delete();
      if($res){
        return response()->json(['message' => 'Record deleted successfully' ]);
      }else{
        return response()->json(['message' => 'Record not deleted successfully' ]);
      }
    }

}
