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
                url:$("#btnUpload").attr('data-url'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                        if(item.success == "success"){
                            $("#prog" + i).addClass("progress-bar-success").html("Хадгаллаа!!!");
                        }
                        else if(item.success == "bError"){
                            alertify.error(item.msg);
                            $("#prog" + i).addClass("progress-bar-danger").html("Алдаа");
                        }
                        else{

                        }
                    });
                },
                error:function(response){

                }
            });
        });
    });
});

    // $(document).on('submit', 'form', function(e){
    //     e.preventDefault();
    //     $form = $(this);
    //
    //     uploadImageSda($form);
    // });

    // function uploadImageSda($form){
    //   var formData = new FormData($form[0]);
    //   var request = new XMLHttpRequest();
    //   request.upload.addEventListener("progress", function(e){
    //       var percent = Math.round(e.loaded/e.total * 100);
    //       console.log(percent);
    //       $form.find(".progress-bar").width(percent+"%").html(percent+"%");
    //   });
    //   request.addEventListener("load", function(e){
    //       $form.find(".progress-bar").addClass("progress-bar-success").html("");
    //   });
    //   request.open("post", "{{action("ImageController@resizeImagePost")}}");
    //   request.send(formData);
    // }
