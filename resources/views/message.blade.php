@extends('layouts.main')

@section('content')
<div class="">
    <div class="row">
  @if(Session::has('message'))
  <div id='enter_html' class="col-md-6">
		{!!Session::get('message')!!}
  </div>
	@endif
  <div id='enter_html' class="col-md-6">
  88888
  </div>
    </div>
</div>
@endsection
