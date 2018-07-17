<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SelectController;


class AdminController extends Controller
{
    public function index(){
      return view("admin.index");
    }

    public function selects(){
      $arrayCountrys = SelectController::DataSelectCountrys()->all();
      $optionCountrys = SelectController::ConvertOption($arrayCountrys);
      $arrayRegions = SelectController::DataSelectRegions()->all();
      $optionRegions = SelectController::ConvertOption($arrayRegions);
      $arrayCategorey = SelectController::DataSelectCategorey()->all();
      $optionCategorey = SelectController::ConvertOption($arrayCategorey);
      return view('admin.select.selects',['country'=>$optionCountrys,'region'=>$optionRegions, 'category'=>$optionCategorey]);
    }
}
