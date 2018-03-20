@extends('layouts.main')
@section('title')
Добавить объявление
@stop
@section('head')

@stop
@section('footer-script')
<script src="/script/jquery.maskedinput-1.2.2.js"></script>
<script src="/script/uploaderObject.js"></script>
<script src="/script/interface.js"></script>
@stop
@section('content')
@if(Auth::check())
<?php
 $errorsArray = $errors->toArray();
function ErrorPrint(){
}
if(old("id_region") !== null){
   $id_regionOld = "value-old='".old("id_region")."'";
if(old("id_city") !== null){
    $id_regionOld.=" value-children = 'id_city|".old("id_city")."'";
  }
} else $id_regionOld = '';

 ?>

<div id="add_post" class="col-sm-11">
<h4>Опубликовать объявление</h4>
<form id='add' fails='true' class='form-horizontal' role='form' action='/ad/add' method='POST' enctype='multipart/form-data'>
  <div id="input_name" class="form-group  has-feedback">

    <div class="col-sm-10">
      <input id='name' placeholder='Ваше Имя' class="form-control" name='name' value='{{old("name")}}'/>
    </div>
  </div>
  <div id="input_email" class="form-group has-feedback">
    <div class="col-md-10">
        <input id='email' placeholder='Ваш Email' class="form-control" name='email' value='{{old("email")}}'/>
    </div>
  </div>
  <div id="input_phone" class="form-group">
    <div class="col-sm-10">
        <input id='phone' placeholder='Ваш телефон' class="form-control" name='phone' value='{{old("phone")}}'/>
    </div>
  </div>
<div id='region' class="col-md-6 form-group has-feedback">
   <select data-placeholder="Регион" style="width:100%;" class="chosen-select" tabindex="7" id="region_select" name="id_region" <?php echo $id_regionOld; ?>>

  </select>
</div>
<?php
$id_categoryOld = '';$value_children = '';
if(old("id_category") !== null){
      $id_categoryOld = "value-old='".old("id_category")."'";
      $children = '';
      if(old("id_type") !== null){
        $children = "id_type|".old("id_type");
      }
      if(old("id_breed") !== null){
        $children .= " id_breed|".old("id_breed");
      }
      if(old("id_vozrast") !== null){
        $children .= " id_vozrast|".old("id_vozrast");
      }
      if(old("id_pol") !== null){
        $children .= " id_pol|".old("id_pol");dump(old("id_pol"));
      }
      if($children !== ''){
        $value_children = " value-children='".trim($children)."'";
      }
      $id_categoryOld .= $value_children;
}
 ?>
 
<div id="categorij" class="form-group has-feedback col-md-6" >
   <select data-placeholder="Категория" style="width:100%;" class="chosen-select" tabindex="7" id="category_select" name="id_category" <?php echo $id_categoryOld ?>>

    </select>
</div>

    <div id="input_title" class="col-sm-10 form-group  has-feedback" >
  <input id='title'  value='{{old("title")}}' placeholder='Названия объявления' class="form-control" name='title'/>
    </div>
<div class="form-group" >
  @if($errors->count())

  @endif
    <div  id="input_post" class="col-sm-10" >
 <textarea id='post' placeholder='Описание' class="form-control" name='text' type="text" rows='8'>{{old("text")}}</textarea>
    </div>
</div>

<h4>Добавить фотографии</h4>
<div class="form-group" >
    <div class="row">
        <div class="col-md-5">
   <input id='file-field'  class="btn btn-default" multiple='true' name='file' type="file" accept='image/*,image/jpeg'/>
        </div>
        <div class="col-md-7">
            <div>
         Обубликовать указанный Email: <input id='privat_email' class="form-control" name='privat_email' checked  type="checkbox"/>
            </div>

 @if(Auth::user()->pravo===88)
 <div>
  <input id='sostoynia' class="form-control" name='sostoynia' disabled  type="checkbox"/>
 </div>
 @endif
      </div>
    </div>
 <div class="col-sm-10">
  <span>
    <img src="/images/add_foto.png" alt="" />
  </span>

 <div class="form-group" >
    <div class="col-sm-10" >
 <div id="img-container">
      <ul id="img-list">

      </ul>
 </div>
    </div>
</div>
</div>
</div>

 <button id='button_add_annou' class="add btn btn-default" type="button" >Опубликовать</button>
 {!! csrf_field() !!}
</div>
@else
Для подачи объявления необходимо авторизироваться
@endif
@endsection
