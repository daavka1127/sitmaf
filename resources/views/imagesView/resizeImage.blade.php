@extends('layouts.layout_main')

@section('content')

<link href="{{url('public/js/photoviewer/photoviewer.min.css')}}" rel="stylesheet" />
<script src="{{url('public/js/photoviewer/photoviewer.min.js')}}"></script>
<div class="col-md-12 text-center">
  <h3><strong>Зургийн цомог</strong></h3>
</div>
<div class="container">

  <a id="single_image" href="image_big.jpg"><img src="image_small.jpg" alt=""/></a>
  <a id="inline" href="#data">This shows content of element who has id="data"</a>
  <div style="display:none"><div id="data">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div></div>
{{--
<style>
.example {
  margin-right: 20px;
  min-height:120px;
  height:120px;
  min-width: 120px;
  width: 120px;
  border: 1px solid #ddd;
}
</style>
<div class="col-md-12">
  <br>
  @foreach ($images as $image)
    <a data-gallery="example" class="example" href="{{url('public/images')}}/{{$image->url}}">
      <img width="120" height="120" src="{{url('public/thumbnail')}}/{{$image->url}}"></a>
  @endforeach


<script>
  $('[data-gallery=example]').click(function (e) {
    e.preventDefault();

    var photos = [
      @foreach ($images as $image)
        {
          src: '{{url('public/images')}}/{{$image->url}}',
          title: '{{$image->title}}'
        },
      @endforeach
    ];

    var options = {
      // Enable modal to drag
      draggable: true,

      // Enable modal to resize
      resizable: true,

      // Enable image to move
      movable: true,

      // Enable keyboard navigation
      keyboard: true,

      // Shows the title
      title: true,

      index: $(this).index(),
    };

    new PhotoViewer(photos, options);
  });
</script>

</div> --}}

</div>
@endsection
