$(document).ready(function(){
    $("#btnAddGuitsetgel").click(function(){

        if(dataRow == ""){
          alertify.alert("Та засах мөрөө сонгоно уу!!!")
          return;
        }
        // refreshExecEdit(dataRow["id"]);
        $('#newGuitsetgelModal').modal('show');
         $('#cmbNewCompanyName').text(dataRow['companyName']+" " + dataRow['ajliinHeseg']);
         $('#cmbNewCompanyID').val(dataRow['id']);

         $('#CheckBoxes').text("");
         $.ajax({
           type:'get',
           url:getPlanWorkTypeUrl,
           data: {
             companyID:$('#cmbNewCompanyID').val()
           },
           success:function(response){
             $.each(response, function(key, value){
               //alert("key="+ key +" value=" + value.name);
               $('#CheckBoxes').append('<div class="col-md-12">' +
                   '<label class="checkbox-inline">' +
                   '<input type="checkbox" workTypeId="'+value.work_type_id+'" id="checkBoxes'+value.work_type_id+'">  '+value.name+'' +
                   '</label></div>' +
                   '<div class="col-md-12 vision"  style="display:none; border: 1px solid grey; margin-top: 5px; border-radius: 5px; border-color: #d1cfcf;" id="worktypeid'+value.work_type_id+'">'+
                   '</div>'
                   );
             getWorks(value.work_type_id);
             });

           }
         });


    });
});

// $(document).ready(function(){
//   $('#cmbNewCompanyID').change(function(){
//
//
//   });
// });

function getWorks(workTypeID){
  $.ajax({
    type: "get",
    url:getPlanWorkUrl,
    data:{
      companyID: $('#cmbNewCompanyID').val(),
      work_type_id: workTypeID
    },
    success: function(response){

      $.each(response, function(key, val){
        $("#worktypeid"+workTypeID).append('<div class="form-group col-md-2 text-left" style="padding-top: 5px;">'+
          '<label style="font-size: 11px;" id="workName'+val.work_id+'">'+val.name+' /'+val.hemjih_negj+'/ </br> Төлөвлөсөн:('+val.quantity+')</label>'+
          '<input type="number" min="0" step="1" workID="'+val.work_id+'" class="txtclass'+workTypeID+' form-control input-sm" />'+
          '</div>'
      );
      });
      $("#worktypeid"+workTypeID).append('<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">'+
        '<button type="button" btnworkid="'+workTypeID+'" class="btnWorkTypeID btn btn-success">Хадгалах</button>'+
        '</div>'
    );
    }
  });
}

$(document).on("click", 'button[class^="btnWorkTypeID"]', function(){
  var id = $(this).attr("btnworkid");
  jsonObj = [];
  $.each($(".txtclass"+id), function( key, value ) {

    var workID = $(this).attr("workID");
    var workName = $("#workName"+workID).text();
    var value = $(this).val();

    if(value != ""){
      item = {}
      item ["workTypeID"] = id;
      item ["workID"] = workID;
      item ["workName"] = workName;
      item ["value"] = value;
      jsonObj.push(item);
    }
  });

  // console.log(jsonObj);
  if($("#cmbNewCompanyID").val() == ""){
    alertify.error("ААН-ийн нэр оруулна уу.");
    return;
  }
  if($("#txtOgnoo").val() == ""){
    alertify.error("Огноо сонгоно уу.");
    return;
  }
  if(jsonObj.length == 0){
    alertify.alert("Хамгийн багадаа нэг өгөгдөл оруулна уу.");
    return;
  }
  $.ajax({
    type: 'post',
    url: executionStoreUrl,
    data: {
      json:jsonObj,
      companyID: $("#cmbNewCompanyID").val(),
      createDate: $("#txtOgnoo").val(),
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
        alertify.alert(response);
        if(response != "Тухайн өдрийн ажлын гүйцэтгэл бүртгэгдсэн байна.")
        {
          $("#worktypeid"+id).css("display","none");
          $("#checkBoxes"+id).prop("disabled", true);
          $("#divGenerateReport").show();
          $("#generateReportAlert").html("");
          $('#newGuitsetgelModal').modal('hide');
        }
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


$(document).on('click', '[type=checkbox]', function(){
    var id = $(this).attr("workTypeId");
    if($(this).is(':checked')){
        $("#worktypeid" + id).css("display","block");
    }
    else{
        $("#worktypeid" + id).css("display","none");
    }
});

$(document).ready(function(){
  $("#newGuitsetgelModal").on('hide.bs.modal', function(){
    $(".modal-body").each(function(){
      $(this).find(':input').val("");
    });

    $(".modal-body").each(function(){
      $(this).find(':checked').prop('disabled', false);
      $(this).find(':checked').prop('checked', false);
    });

    $(".vision").css("display","none");
    $(".vision").text("");
    $("#cmbNewCompanyID").val("-1");
    $("#CheckBoxes").text("");
  });
});
