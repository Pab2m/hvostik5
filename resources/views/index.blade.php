@extends('layouts.main')

@section('content')

<div id="title">
    <h1>{{$title_content}}</h1>
</div>
 <div id='content-left' class='col-md-12'>
 <div id="announcement" class="container-fluid">
   @foreach($ad_all as $ad)
          @include('ad.ad-short')
   @endforeach

</div>
 </div>
@endsection
