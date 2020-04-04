$(document).on('click', '[type=checkbox]', function(){
    var id = $(this).attr("workTypeId");
    if($(this).is(':checked')){
        $("#worktypeid" + id).show();
    }
    else{
        $("#worktypeid" + id).hide();
    }
});

$(document).ready(function(){
  $("#newCompany").on('hide.bs.modal', function(){
    alert('The modal is about to be hidden.');
  });
});

$(document).ready(function () {
    $('button[class^="btnWorkTypeID"]').click(function () {
        var id = $(this).attr("btnworkid");

        jsonObj = [];
        $.each($(".txtclass"+id), function( key, value ) {
          var workID = $(this).attr("workID");
          var value = $(this).val();
          item = {}
          item ["workTypeID"] = id;
          item ["workID"] = workID;
          item ["value"] = value;
          jsonObj.push(item);

        });

        var data =
        // console.log($("#frmNewCompany").serializeObject());


        $.ajax({
          type: 'GET',
          url: newWorksUrl,
          data: {
            json:jsonObj,
            companyID: $("#companyID").val(),
            companyName: $("#txtCompanyName").val(),
            heseg_id: $("#cmbHeseg").val(),
            ajliinHeseg: $("#txtAjliinHeseg").val(),
            gereeOgnoo: $("#txtGereeOgnoo").val(),
            hunHuch: $("#txtHunHuch").val(),
            mashinTehnik: $("#txtMashinTehnik").val()
          },
          success:function(response){
              $("#companyID").val(response);
              alertify.alert("Амжилттай.."+response);
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
