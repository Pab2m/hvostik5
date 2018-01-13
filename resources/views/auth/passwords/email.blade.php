@extends('layouts.main')

<!-- Main Content -->
@section('content')

<div id="content">
  @if(Auth::check())
   <div id='enter_html' class="col-md-6">
    Вы уже авторизованны, как {{Auth::user()->email}}<br>
    <a href="/private_office">Личный кабинет</a><br>
    <a href="/logout">Выйти</a>
   </div>
    @else

 <div id='enter_html' class="col-md-6">
     @if (session('status'))
       <div id="message-error col-md-6"> {{ session('status') }}</div>
     @endif
    <h3>Сбросить пароль</h3>

    <form id='vhod_form' class='form-horizontal' role='form' method="post" action=" url('/password/email') ">     
  {{ csrf_field() }}
  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
       <input id='email' name="email" class="form-control" value="{{old('email')}}"  placeholder="Email" type="email" required/>
        @if ($errors->has('email'))
            <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" id="vhod_botton" name="vhod_botton">Сброс пароля</button>
    </div>
  </div>
 </form>
</div>

     @endif
</div>


@endsection
