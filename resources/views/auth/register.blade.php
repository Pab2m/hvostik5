@extends('layouts.main')

@section('content')
<div id='enter_html' class="col-md-7">
@if((Session::has('message')) && (Auth::user()))
{{Session::get('message')}}
@else
@if(!Auth::user())
    <h3>Регистрация </h3>
   <form id="form-registr" class="form-horizontal" method="POST" action="/registration">
     {{ csrf_field() }}
       <div class="form-group">
   <div class="col-sm-2">
    <label for="inputEmail3" class="ccontrol-label">Имя</label>
   </div>
    <div class="col-sm-9">
      <input id="name" class="form-control" placeholder="Ваше имя" type="name" name="name" value="{{ old('name') }}" />
    </div>
  </div>
  <div class="form-group">
   <div class="col-sm-2">
    <label for="inputEmail3" class="ccontrol-label">Email</label>
   </div>
    <div class="col-sm-9">
      <input id="inputEmail3" class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" />
    </div>
  </div>
  <div class="form-group">
   <div class="col-sm-2">
    <label for="inputPassword3" class="control-label">Пароль</label>
   </div>
    <div class="col-sm-9">
       <input id="inputPassword3" class="form-control" placeholder="Пароль" type="password" name="password" />
    </div>
    <div class="col-sm-1 padding0">
      {!! $errors->has('password') ? '<span class="glyphicon glyphicon-remove margin0" style="color: red; display: inline-block; opacity: 1;"></span>' :"" !!}
    </div>
  </div>
     <div class="form-group">
    <div class="col-sm-2">
    <label for="inputPassword3" class="control-label">Пароль</label>
    </div>
    <div class="col-sm-9">
      <input id="repeat_inputPassword3" class="form-control" placeholder="Повторите пароль" type="password" name="repeat_password" />
    </div>
    <div class="col-sm-1 padding0">
      {!! $errors->has('repeat_password') ? '<span class="glyphicon glyphicon-remove margin0" style="color: red; display: inline-block; opacity: 1;"></span>' :"" !!}
    </div>
  </div>
<div class="form-group container">
    <div class="g-recaptcha" data-sitekey="6LcQUxgTAAAAAIPKtxdvQpU6khJph9w3s80swrpi"></div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-default" id="registracion">Зарегистрироваться</button>
    </div>
  </div>
</form>
  @else
  Вы уже зарегистрированы! И зашли на сайт!
  @endif
 @endif
</div>

@endsection
