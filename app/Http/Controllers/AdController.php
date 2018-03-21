<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class AdController extends Controller
{
  public function ViewAdAdd(){
  return view('ad.add');
  }
public function ValidateAd(Request $request){
  $validator = Validator::make($request->all(), [
              'name' =>'required',
              'id_region' => 'integer|required',
              'id_city' => 'integer|required',
              'id_category' =>'integer|required',
              'id_breed' =>'integer',
              'id_type' =>'integer',
              'id_pol' =>'integer',
              'id_vozrast' =>'integer',
              'title' =>'required',
              'email' =>'required|email',
              'text' => 'required']);

   if ($validator->fails()) {
      return redirect('/ad/add')
                  ->withErrors($validator)
                  ->withInput();

    }
    return dd($request->all());
}


}
