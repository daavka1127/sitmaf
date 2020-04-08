@extends('layouts.layout_main')

@section('content')
<h1>Зураг оруулах</h1>
<hr>

{{-- <form method="post" enctype="multipart/form-data" action="{{action("adminImageUploadToolController@upload")}}"> --}}
{{-- <form action="#">
  @csrf
  <input type="file"  name="image" />
  <button class="btn btn-sm btn-info upload" type="submit">Upload</button>
  <button class="btn btn-sm btn-danger cancel" type="button">Cancel</button>

  <div class="progress">
    <div class="progress-bar progress-bar-success" data-transitiongoal="0"></div>
  </div>
</form>
<div class="clearfix"></div>
<form action="#">
  @csrf
  <input type="file" name="image" />
  <button class="btn btn-sm btn-info upload" type="submit">Upload</button>
  <button class="btn btn-sm btn-danger cancel" type="button">Cancel</button>

  <div class="progress">
    <div class="progress-bar progress-bar-success" data-transitiongoal="0"></div>
  </div>
</form>
<div class="clearfix"></div>
<form action="#">
  @csrf
  <input type="file" name="image" />
  <button class="btn btn-sm btn-info upload" type="submit">Upload</button>
  <button class="btn btn-sm btn-danger cancel" type="button">Cancel</button>

  <div class="progress">
    <div class="progress-bar progress-bar-success" data-transitiongoal="0"></div>
  </div>
</form>
<div class="clearfix"></div>

<form action="#">
  @csrf
  <input type="file" name="image" />
  <button class="btn btn-sm btn-info upload" type="submit">Upload</button>
  <button class="btn btn-sm btn-danger cancel" type="button">Cancel</button>

  <div class="progress">
    <div class="progress-bar progress-bar-success" data-transitiongoal="0"></div>
  </div>
</form> --}}
<div class="clearfix"></div>
<input type="file" id="myFiles" name="images" multiple="multiple" />
<button class="btn btn-sm btn-info upload" id="btnUpload" type="submit">Upload</button>
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

<script>

$(document).ready(function(){
    var count = 0;

    function showUploadedItem(source,index,i) {
        var div = $("#showImages");
        var divCol = "<div class='col-md-2'>";
        var divCol = divCol + "<img id='post-image' width='100%' height='80' class='" + count + "' src=''>";
        var divCol = divCol + '<div class="progress">';
        var divCol = divCol + '<div id="prog' + i + '" class="progress-bar progress-bar-error" data-transitiongoal="0"></div>';
        var divCol = divCol + "</div></div>";

        div.append(divCol);
        // div.append("</div></div>");
        $("." + count + "").attr("src",source);
        count++;
    }

    $('#myFiles').change(function() {
        var file = this.files;

        $.each(file, function(i, filename) {
            // alert(filename["type"]);
            const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
            if(validImageTypes.includes(filename["type"])){
                reader = new FileReader();
                reader.onloadend = function (e) {
                    showUploadedItem(e.target.result, filename.name, i);
                };

                reader.readAsDataURL(filename);
            }
        });
    });

    $("#btnUpload").click(function(){
        var files = $("#myFiles")[0].files;

        $.each(files, function(i, file) {
            $("#myFile1").files = file;
            // console.log($("#myFile1").files);
            var formdata = new FormData();
            formdata.append('image', file);

            console.log(formdata);

            $.ajax({
                url :"{{action("ImageController@resizeImagePost")}}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token()}}'
                },
                data:formdata,
                type:"POST",
                contentType: false,
                // contentType:"multipart/form-data",
                // contentType: "multipart/form-data; boundary=dadaa",
                processData: false,
                xhr: function(){
                    // get the native XmlHttpRequest object
                    var xhr = $.ajaxSettings.xhr() ;
                    // set the onprogress event handler
                    xhr.upload.onprogress = function(evt){
                      console.log('progress', evt.loaded/evt.total*100) ;
                      var percent = Math.round(evt.loaded/evt.total * 100);
                      $("#prog" + i).width(percent+"%").html(percent+"%");
                    } ;
                    // set the onload event handler
                    xhr.upload.onload = function(){ console.log('DONE!') } ;
                    // return the customized object
                    return xhr ;
                },
                success:function(response){
                    $.each(response, function(index, item){
                        if(item.status == "success"){
                            $("#prog" + i).addClass("progress-bar-success").html(item.msg);
                        }
                        else if(item.status == "bError"){
                            alertify.error(item.msg);
                            $("#prog" + i).addClass("progress-bar-danger").html("");
                        }
                        else{
                            $.each(item.image, function(index, item){
                                // alertify.alert(item);
                                $("#prog" + i).addClass("progress-bar-danger").html("Зурган файл биш эсвэл зурагны хэмжээ 2MB-с их хэмжээтэй байна.");
                            });
                            // $("#prog" + i).addClass("progress-bar-error").html("SDA upload hiigeed duuslaa");
                        }
                    });
                }
            });
        });
    });
});

    $(document).on('submit', 'form', function(e){
        e.preventDefault();
        $form = $(this);

        uploadImageSda($form);
    });

    function uploadImageSda($form){
      var formData = new FormData($form[0]);
      var request = new XMLHttpRequest();
      request.upload.addEventListener("progress", function(e){
          var percent = Math.round(e.loaded/e.total * 100);
          console.log(percent);
          $form.find(".progress-bar").width(percent+"%").html(percent+"%");
      });
      request.addEventListener("load", function(e){
          // $form.find(".progress-bar").addClass("progress-bar-success").html("");
      });
      request.open("post", "{{action("ImageController@resizeImagePost")}}");
      request.send(formData);
    }
</script>


<!-- NProgress -->
    <script src="{{url("/public/vendors/nprogress/nprogress.js")}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{url("/public/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js")}}"></script>
@endsection
