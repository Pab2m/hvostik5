@include('admin.layouts.header')

<div class="container-fluid">
<div class="row main-body">
     <div class="col-sm-3 col-md-2 main">
       @include('admin.layouts.left')
     </div>

    <div class="col-sm-9  col-md-10  main">
    @yield('content')
    </div>

</div>
<div id='content' class="container">



</div>
@include('layouts.footer')
