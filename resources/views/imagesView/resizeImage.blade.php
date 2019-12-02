@extends('layouts.layout_main')

@section('content')

<link href="{{url('public/dadaaFancy/jquery.fancybox.min.css')}}" rel="stylesheet" />
<script src="{{url('public/dadaaFancy/jquery.fancybox.min.js')}}"></script>
<div class="col-md-12 text-center">
  <h3><strong>Зургийн цомог</strong></h3>
</div>
<div class="container">

@foreach ($images as $image)
  <a href="{{url('/public/images')}}/{{$image->url}}" data-fancybox="images" data-caption="{{$image->title}}">
  	<img src="{{url('/public/thumbnail')}}/{{$image->url}}" alt="" />
  </a>
@endforeach
<script>
$('[data-fancybox="images"]').fancybox({
  afterLoad : function(instance, current) {
    var pixelRatio = window.devicePixelRatio || 1;

    if ( pixelRatio > 1.5 ) {
      current.width  = current.width  / pixelRatio;
      current.height = current.height / pixelRatio;
    }
  }
});
</script>
</div>
@endsection
