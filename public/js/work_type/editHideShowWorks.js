$(document).ready(function(){
    $("#btnEditCompany").click(function(){

        $("#txtEditID").val(dataRow["id"]);

        //console.log(dataRow["companyName"].split('&quot;'));
        $("#txtEditCompanyName").val(dataRow["companyName"]);
        $("#cmbHeseg").val(dataRow["heseg_id"]);
        $("#txtEditAjliinHeseg").val(dataRow["ajliinHeseg"]);
        $("#txtEditGereeOgnoo").val(dataRow["gereeOgnoo"]);
        $("#txtEditHunHuch").val(dataRow["hunHuch"]);
        $("#txtEditMashinTehnik").val(dataRow["mashinTehnik"]);
        if(dataRow == ""){alertify.alert("Та засах мөрөө сонгоно уу!!!")}
        else{$('#modalEditCompany').modal('show');}

        $.ajax({
          type: 'post',
          url: getPlansByCompanyIDurl,
          data: {
            companyID:dataRow["id"],
            _token:$('meta[name="csrf-token"]').attr('content')
          },
          success:function(response){
              $.each(response, function(index, item){
                  $("#editTxtWork" + item.work_id).val(item.quantity);
              });
          }
        });
    });
});

$(document).ready(function(){
  $("#modalEditCompany").on('hide.bs.modal', function(){
    $(".modal-body").each(function(){
      $(this).find(':checked').prop('checked', false);
        $(this).find(':input').val("");
    });
    $(".vision").css("display","none");
    dataRow = "";
  });
});

$(document).on('click', '[type=checkbox]', function(){
    var id = $(this).attr("workTypeId");
    if($(this).is(':checked')){
        $("#editWorktypeid" + id).css("display","block");
        sumPlansEdit($(this).attr("worktypeid"));
    }
    else{
        $("#editWorktypeid" + id).css("display","none");
    }
});

$(document).ready(function () {
    $('button[class^="editBtnWorkTypeID"]').click(function () {
        var id = $(this).attr("btnworkid");
        jsonObj = [];
        $.each($(".editTxtclass"+id), function( key, value ) {
          var workID = $(this).attr("workID");
          var workName = $("#editWorkName"+workID).text();
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


        var isInsert = true;
        if($("#txtEditCompanyName").val()==""||$("#txtEditCompanyName").val()==null){
            alertify.error("Аж ахуйн нэгжийн нэр оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#cmbEditHeseg").val()=="0"){
            alertify.error("Хэсэг ээ сонгоно уу!!!");
            isInsert = false;
        }
        if($("#txtEditAjliinHeseg").val()==""||$("#txtEditAjliinHeseg").val()==null){
            alertify.error("Ажлын хэсэг оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#txtEditGereeOgnoo").val()==""||$("#txtEditGereeOgnoo").val()==null){
            alertify.error("Ажил эхэлсэн огноо оруулаагүй байна!!!");
            isInsert = false;
        }
        if(isInsert == false){return;}

        if(jsonObj.length == 0){
          alertify.error("Хамгийн багадаа нэг төлөвлөсөн ажил оруулна уу!!!");
          return;
        }
        $(this).prop( "disabled", true );
        var button = $(this);
        $.ajax({
          type: 'post',
          url: editWorksUrl,
          data: {
            json:jsonObj,
            workTypeID: id,
            companyID: dataRow["id"],
            companyName: $("#txtEditCompanyName").val(),
            heseg_id: $("#cmbHeseg").val(),
            ajliinHeseg: $("#txtEditAjliinHeseg").val(),
            gereeOgnoo: $("#txtEditGereeOgnoo").val(),
            hunHuch: $("#txtEditHunHuch").val(),
            mashinTehnik: $("#txtEditMashinTehnik").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success:function(response){
              alertify.alert(response);
              refresh();
              button.prop( "disabled", false );
          },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors['errors'], function (index, value) {
                errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
            });
            alert(errorsHtml);
            button.prop("disabled", false);
          }
    });


  });
});

$(document).ready(function(){
    $(".numbersPlanEdit").keyup(function(){
        // alert($(this).attr("worktypeid"));
        sumPlansEdit($(this).attr("worktypeid"));
    });
});

function sumPlansEdit(workTypeID){
    var sumPlan = 0;
    $(".editTxtclass" + workTypeID).each(function(){
        if($(this).val() != "")
            sumPlan += parseFloat($(this).val());
    });
    console.log(sumPlan.toFixed(2));
    $("#sumPlanEdit" + workTypeID).text("Нийт батлагдсан тоо хэмжээ: " + sumPlan.toFixed(2));
}
