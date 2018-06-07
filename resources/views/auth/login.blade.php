@extends('layouts.main')

@section('content')
<div id="content">
  @if(Auth::check())
     <div id='enter_html' class="col-md-6">
    Вы уже авторизованны, как {{Auth::user()->email}}<br>
    <a href="/private_office">Личный кабинет</a><br>
    <a href="/logout">Выйти</a>88
     </div>
    @else

 <div id='enter_html' class="col-md-6">
     @if(Session::has('message'))
       <div id="message-error col-md-6"> {{Session::get('message')}}</div>
     @endif
    <h3>Вход на сайт</h3>

    <form id='vhod_form' class='form-horizontal' role='form' method="post" action="/login">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
       <input id='email' name="email" class="form-control" value="{{old('email')}}"  placeholder="Email" type="email" />
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
    <div class="col-sm-10">
        <input id="password" name="password" class="form-control" type="password" placeholder="Password"/>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="remember-me"> Запомнить меня
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" id="vhod_botton" name="vhod_botton">Войти</button>
    </div>
  </div>
 </form>
 <div class="row">
 <div class="col-md-6">
    <a href="/registration">Регистрация</a>
 </div>
 <div class="col-md-6 div_right">
    <a href="/password/reset">Забыли пароль?</a>
</div>
</div>
<!-- <div id="a_vk" class="row">
     <a href='#'>ВКонтакте</a></li>
 </div>-->
</div>

     @endif
</div>
@endsection
