@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
		{!!Session::get('message')!!}
	@endif
    </div>
</div>
@endsection
