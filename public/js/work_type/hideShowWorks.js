
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
  $("#newCompany").on('hide.bs.modal', function(){
    $(".modal-body").each(function(){
      $(this).find(':input').val("");
    });

    $(".modal-body").each(function(){
      $(this).find(':checked').prop('disabled', false);
      $(this).find(':checked').prop('checked', false);
    });

    $(".vision").css("display","none");

    $("#companyID").val("0");
    $("#cmbHeseg").val("0");

    dataRow = "";
  });
});

$(document).ready(function () {
    $('button[class^="btnWorkTypeID"]').click(function () {
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

        if($("#txtCompanyName").val() == ""){
          alertify.error("ААН-ийн нэр оруулна уу.");
          return;
        }
        if($("#cmbHeseg").val() == "0"){
          alertify.error("Хэсгийг сонгоно уу.");
          return;
        }
        if($("#txtAjliinHeseg").val() == ""){
          alertify.error("Ажлын хэсгийг оруулна уу.");
          return;
        }
        if($("#txtGereeOgnoo").val() == ""){
          alertify.error("Огноог оруулна уу.");
          return;
        }
        if(jsonObj.length == 0){
          alertify.error("Хамгийн багадаа нэг төлөвлөсөн ажил оруулна уу!!!");
          return;
        }
        $(this).prop( "disabled", true );
        var button = $(this);
        $.ajax({
          type: 'post',
          url: newWorksUrl,
          data: {
            json:jsonObj,
            companyID: $("#companyID").val(),
            companyName: $("#txtCompanyName").val(),
            heseg_id: $("#cmbHeseg").val(),
            ajliinHeseg: $("#txtAjliinHeseg").val(),
            gereeOgnoo: $("#txtGereeOgnoo").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success:function(response){
              $("#companyID").val(response);
              alertify.alert("Амжилттай хадгаллаа.");
              $("#worktypeid"+id).css("display","none");
              $("#checkBoxes"+id).prop("disabled", true);
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
    $(".numbersPlanNew").keyup(function(){
        // alert($(this).attr("worktypeid"));
        sumPlansNew($(this).attr("worktypeid"));
    });
});

function sumPlansNew(workTypeID){
    var sumPlan = 0;
    $(".txtclass" + workTypeID).each(function(){
        if($(this).val() != "")
            sumPlan += parseFloat($(this).val());
    });
    console.log(sumPlan.toFixed(2));
    $("#sumPlanNew" + workTypeID).text("Нийт батлагдсан тоо хэмжээ: " + sumPlan.toFixed(2));
}
