$(document).on('click', '[type=checkbox]', function(){
    var id = $(this).attr("workTypeId");
    if($(this).is(':checked')){
        $("#worktypeid" + id).show();
    }
    else{
        $("#worktypeid" + id).hide();
    }
});

$(document).ready(function () {
    $('button[class^="btnWorkTypeID"]').click(function () {
        var id = $(this).attr("btnworkid");
        var inputs = $(".txtclass"+id);

        alert(inputs);

        $.ajax({
          type: 'GET',
          url: newWorksUrl,
          data: {
            workTypeID:id,
            inputs: inputs
          },
          success:function(response){
              alertify.alert(response);
              refresh();
          },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors['errors'], function (index, value) {
                errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
            });
            alert(errorsHtml);
          }
        });
    });
});




// $(document).ready(function(){
//     $("#btnWork").click(function(e){
//         e.preventDefault();
//         var id = $(this).attr("btnworkid");
//
//         alert("aa"+id);

        // var isInsert = true;
        // if($("#txtEditCompanyName").val()==""||$("#txtEditCompanyName").val()==null){
        //     alertify.error("Аж ахуйн нэгжийн нэр оруулаагүй байна!!!");
        //     isInsert = false;
        // }
        // if($("#cmbEditHeseg").val()=="0"){
        //     alertify.error("Хэсэг ээ сонгоно уу!!!");
        //     isInsert = false;
        // }
        // if($("#txtEditAjliinHeseg").val()==""||$("#txtEditAjliinHeseg").val()==null){
        //     alertify.error("Ажлын хэсэг оруулаагүй байна!!!");
        //     isInsert = false;
        // }
        // if($("#txtEditGereeOgnoo").val()==""||$("#txtEditGereeOgnoo").val()==null){
        //     alertify.error("Ажил эхэлсэн огноо оруулаагүй байна!!!");
        //     isInsert = false;
        // }
        // if($("#txtEditHunHuch").val()==""||$("#txtEditHunHuch").val()==null){
        //     alertify.error("Хүн хүч оруулаагүй байна!!!");
        //     isInsert = false;
        // }
        // if($("#txtEditMashinTehnik").val()==""||$("#txtEditMashinTehnik").val()==null){
        //     alertify.error("Ажлын машин техник оруулаагүй байна!!!");
        //     isInsert = false;
        // }
        // if(isInsert == false){return;}



        // $.ajax({
        //   type: 'POST',
        //   url: newWorksUrl,
        //   data: $("#saveWorks"+id).serialize(),
        //   success:function(response){
        //       alertify.alert(response);
        //       refresh();
        //   },
        //   error: function(jqXhr, json, errorThrown){// this are default for ajax errors
        //     var errors = jqXhr.responseJSON;
        //     var errorsHtml = '';
        //     $.each(errors['errors'], function (index, value) {
        //         errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
        //     });
        //     alert(errorsHtml);
        //   }
        // });
//     });
// });
