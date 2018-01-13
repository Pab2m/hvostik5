@extends('layouts.main')
@section('content')
@if(Auth::check())
<h4>Личный кабинет,{{'  '.$email}}</h4>
<div class="row">
@if(Auth::user()->pravo===88)
<div class="col-md-2">
    <a class="a-add" href="/fyurer/"><span>Админка</span></a>
</div>    
@endif
<div class="col-md-2">
    <a class="a-add" href="/logout"><span>Выйти</span></a>
</div>   
</div>
@else
Вы не авторизированы!!!
@endif
@endsection
