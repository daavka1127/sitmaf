$(document).ready(function(){
    $("#btnNewCompany").click(function(e){
        e.preventDefault();
        var isInsert = true;
        if($("#txtCompanyName").val()==""||$("#txtCompanyName").val()==null){
            alertify.error("Аж ахуйн нэгжийн нэр оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#txtAjliinHeseg").val()==""||$("#txtAjliinHeseg").val()==null){
            alertify.error("Ажлын хэсэг оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#txtGereeOgnoo").val()==""||$("#txtGereeOgnoo").val()==null){
            alertify.error("Ажил эхэлсэн огноо оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#txtHunHuch").val()==""||$("#txtHunHuch").val()==null){
            alertify.error("Хүн хүч оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#txtMashinTehnik").val()==""||$("#txtMashinTehnik").val()==null){
            alertify.error("Ажлын машин техник оруулаагүй байна!!!");
            isInsert = false;
        }
        if(isInsert == false){return;}
        $.ajax({
          type: 'POST',
          url: newCompanyUrl,
          data: $("#frmNewCompany").serialize(),
          success:function(response){
              alertify.alert(response);
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
