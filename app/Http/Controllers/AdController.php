<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Image;
use App\Ad;

class AdController extends Controller
{
  public function ViewAdAdd(){
  return view('ad.add');
  }

  public static function PostImgSeveTmp($data){
      if($data['my-pic']){
          $data_mesec=date('/Y-m/');
         $dir = 'images_tmp'.$data_mesec;

          $rules = array('my-pic' => 'mimes:jpeg,png');
          $Vralidato_img['my-pic']=&$data['my-pic'];

          $validator = Validator::make($Vralidato_img, $rules);
              if ($validator->fails()) {
                  return 0;
                }
             $sizeMax=1048576*15;
             if($data['my-pic']->getClientSize()>$sizeMax){
             return 0;
              }
              if((Auth::user()->id) && (Auth::check())){
                  $data['id_user'] = Auth::user()->id;
              }
           $filename_original=$data['id_user'].'_'.str_random(14).'.jpg';
           $imgUrl_original=$dir.$filename_original;
          $data['my-pic']->move(public_path().'/'.$dir, $filename_original);
          $img_url=$dir.$filename_original;
      return $img_url;
  }else {return 0;}
  }

public function addImg(Request $request){
      $data = $request->all();
      return AdController::PostImgSeveTmp($data);
  }

  private function ValidateFoto($dataArray){
    $re = "/^(images_tmp\/)(.+)\.(png|jpg)$/";
    return preg_grep($re, $dataArray);
  }

  private function PriveiFoto($foto, $id_user){
       $Img_oreg=Image::make($_SERVER['DOCUMENT_ROOT'].'/'.$foto);
          $width=$Img_oreg->width();
         $height=$Img_oreg->height();
      if($width>$height){
           $otnW=$height/$width;
            $width115=200;
           $height115=$otnW*200;
         }elseif($width<$height){
              $otnW=$height/$width;
             $width115=200/$otnW;
            $height115=200;
         }else{
           $width115=200;
            $height115=200;
         }
         $name_img='images_post'.date('/Y-m/').$id_user.'_'.str_random(9).'_pri.jpg';
      $Img_oreg->resize($width115, $height115)->save($name_img);
      return $name_img;
  }

  private function DeleteFails($data){
    if(is_array($data)){
        foreach ($data as $value) {
          if(file_exists($value)){
              unlink($value);
          }
        }
    } else if(file_exists($data)){
         unlink($data);
     }
  }

  private function FotoSave($data,$id_user){
      $data_mesec=date('/Y-m/');
      $i=0;
      $dir = '/images_post'.$data_mesec; //date('/Y-m/')
      if(!is_dir('images_post'.date('/Y-m'))){
         mkdir('images_post'.date('/Y-m'), 0666);
      }
      $url_img = false;
      foreach ($this->ValidateFoto($data) as $value){
          if(file_exists($value)){
         $Img_oreg=Image::make($_SERVER['DOCUMENT_ROOT'].'/'.$value);
         $width=$Img_oreg->width();
         $height=$Img_oreg->height();
         if($width>$height){
           $otnW=$height/$width;
           $widthImg640=640;
            $widthImg240=240;
           $widthImg480=$otnW*640;
            $widthImg200=$otnW*240;
         }elseif($width<$height){
              $otnW=$height/$width;
             $widthImg640=480/$otnW;
            $widthImg240=200/$otnW;
            $widthImg480=480;
            $widthImg200=200;
         }else{
            $widthImg480=480;
            $widthImg200=200;
            $widthImg640=480;
            $widthImg240=200;
         }
         $filename_original[$i]=$id_user.'_'.str_random(14).'.jpg';
         $url_img[$i][0]='images_post'.$data_mesec.$filename_original[$i];
         $Img_oreg->save($url_img[$i][0]);
         $filename_640x480[$i]=$id_user.'_'.str_random(14).'.jpg';
         $url_img[$i][640]='images_post'.$data_mesec.$filename_640x480[$i];
          $Img_oreg->resize($widthImg640, $widthImg480)->save($url_img[$i][640]);
         $filename_240x200[$i]=$id_user.'_'.str_random(14).'.jpg';
         $url_img[$i][240]='images_post'.$data_mesec.$filename_240x200[$i];
         $Img_oreg->resize($widthImg240, $widthImg200)->save($url_img[$i][240]);
          $i++;
          }
      }
      $this->DeleteFails($data);
    return $url_img;
  }

  private function DeleteImg($id,$mass){
      foreach ($id as $value_id){
          foreach ($mass as $key_mass=>$value_mass){
              foreach ($value_mass as $value_value_mass){
                if($value_value_mass==$value_id){
                    foreach ($mass[$key_mass] as $value_key_mass){
                     if(file_exists($value_key_mass)){
                          unlink($value_key_mass);
                      }
                }
                   unset($mass[$key_mass]);
                }
              }
          }
        }
        return $mass;
  }

  private function PhoneImg($phone, $id_user=''){
      $pattern='/^([+]+)*[0-9\x20\x28\x29-]{5,20}$/';
           if(!preg_match($pattern, $phone)){
               return $this->getMessage('Номер телефона неправильно указан!!!');
           }
          $data_mesec=date('/Y-m/');
          if(!file_exists('images_post'.$data_mesec)){
              mkdir('images_post'.$data_mesec, 0666);}
          $img = Image::canvas(255, 26, '#ffffff');
          $img->text(strip_tags($phone),5,20, function($font) {
          $font->file('images_post/latha.ttf');
          $font->size(22);
          });
          $filename_phone=$id_user.'_phone_'.str_random(6).'.jpg';
           $img->save('images_post'.$data_mesec.$filename_phone);
          $e='images_post'.$data_mesec.$filename_phone;
  return $e;}

public function AdAdd(Request $request){
        $data = $request->all();
        unset($data['file']);
        $validator = Validator::make($data, [
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
                    'phone'=>'regex:/^([+]+)*[0-9\x20\x28\x29-]{5,20}$/',
                    'text' => 'required']);

         if ($validator->fails()) {
            return redirect('ad/add')
                        ->withErrors($validator)
                        ->withInput();
          }

        $user = Auth::user();

       if(isset($data['privat_email'])) {
          $data['privat_email'] = true;
        } else $data['privat_email'] = false;

      if(($data['sostoynia']) && ($user->hasRole('admin'))) {
          $sostoynia = true;
        } else {$sostoynia = false;}

       $data['id_user'] = $user->id;
       $data['title'] = strip_tags($data['title']);
       $data['text'] = strip_tags($data['text']);
       unset($data['sostoynia']);
       if(isset($data['phone'])){
         $data['phone'] = $this -> PhoneImg($data['phone'], $user->id);
       }
       if(isset($data['img'])){
          $foto = $this -> FotoSave($data['img'],$user->id);
          $preview_foto = $foto[0][0];
          $data['foto'] = json_encode($foto);
          unset($data['img']);
          $data['preview_foto'] = $this -> PriveiFoto($preview_foto, $user->id);
       } else {$data['foto'] = NULL;
               $data['preview_foto'] = NULL;}

      return Ad::CreateAd($data, $sostoynia);

      }

}
