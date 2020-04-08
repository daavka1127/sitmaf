@extends('layouts.layout_main')

@section('content')
<h1>Зураг оруулах</h1>
<div class="clearfix"></div>
<input type="file" id="myFiles" name="images" multiple="multiple" />
<button class="btn btn-sm btn-info upload" id="btnUpload" data-url="{{route("resizeImagePost")}}" type="submit">Upload</button>
<div id="showImages"></div>
<ul id="image-list"></ul>
<br>
<br>
<br>
<br>

<style>

    #post-image {
        /* object-fit: contain; */
        object-fit: cover;
        border: 5px solid;
    }
</style>
<script type="text/javascript">
</script>

<script src="{{url("/public/js/imageUpload/uploadImage.js")}}"></script>

<!-- NProgress -->
    <script src="{{url("/public/vendors/nprogress/nprogress.js")}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{url("/public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
@endsection
