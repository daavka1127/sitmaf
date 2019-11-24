function refresh(){
    var csrf = $('meta[name=csrf-token]').attr("content");
    $('#datatable').dataTable().fnDestroy();
      $('#datatable').DataTable( {
          "language": {
              "lengthMenu": "_MENU_ мөрөөр харах",
              "zeroRecords": "Хайлт илэрцгүй байна",
              "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
              "infoEmpty": "Хайлт илэрцгүй",
              "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
              "sSearch": "Хайх: ",
              "paginate": {
                "previous": "Өмнөх",
                "next": "Дараахи"
              }
          },
          "processing": true,
          "serverSide": true,
          "ajax":{
                   "url": getCompaniesUrl,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
              { data: "id", name: "id" },
              { data: "companyName", name: "companyName"},
              { data: "heseg_id", name: "heseg_id"},
              { data: "ajliinHeseg", name: "ajliinHeseg"},
              { data: "gereeOgnoo", name: "gereeOgnoo" },
              { data: "hunHuch", name: "hunHuch" },
              { data: "mashinTehnik", name: "mashinTehnik" },
              { data: "mashinTehnik", name: "mashinTehnik", visible:false },
              { data: "hursHuulalt", name: "hursHuulalt" },
              { data: "dalan", name: "dalan" },
              { data: "uhmal", name: "uhmal" },
              { data: "suuriinUy", name: "suuriinUy" },
              { data: "shuuduu", name: "shuuduu" },
              { data: "uhmaliinHamgaalalt", name: "uhmaliinHamgaalalt" },
              { data: "uuliinShuuduu", name: "uuliinShuuduu" }
            ]
      }).ajax.reload();
}

$(document).ready(function(){
    $("#btnNewCompany").click(function(e){
        e.preventDefault();
        var isInsert = true;
        if($("#txtCompanyName").val()==""||$("#txtCompanyName").val()==null){
            alertify.error("Аж ахуйн нэгжийн нэр оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#cmbHeseg").val()=="0"){
            alertify.error("Хэсэг ээ сонгоно уу!!!");
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
              emptyNewModal();
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


function emptyNewModal(){
  $("#txtCompanyName").val("");
  $("#cmbHeseg").val("0");
  $("#txtAjliinHeseg").val("");
  $("#txtGereeOgnoo").val("");
  $("#txtHunHuch").val("");
  $("#txtMashinTehnik").val("");
  $("#txtHursHuulalt").val("");
  $("#txtDalan").val("");
  $("#txtUhmal").val("");
  $("#txtSuuriinUy").val("");
  $("#txtShuuduu").val("");
  $("#txtUhmaliinHamgaalalt").val("");
  $("#txtUuliinShuuduu").val("");
}


$(document).ready(function(){
    $("#btnEditCompany").click(function(){
        $("#txtEditID").val(dataRow["id"]);
        $("#txtEditCompanyName").val(dataRow["companyName"]);
        $("#cmbEditHeseg").val(dataRow["heseg_id"]);
        $("#txtEditAjliinHeseg").val(dataRow["ajliinHeseg"]);
        $("#txtEditGereeOgnoo").val(dataRow["gereeOgnoo"]);
        $("#txtEditHunHuch").val(dataRow["hunHuch"]);
        $("#txtEditMashinTehnik").val(dataRow["mashinTehnik"]);
        $("#txtEditHursHuulalt").val(dataRow["hursHuulalt"]);
        $("#txtEditDalan").val(dataRow["dalan"]);
        $("#txtEditUhmal").val(dataRow["uhmal"]);
        $("#txtEditSuuriinUy").val(dataRow["suuriinUy"]);
        $("#txtEditShuuduu").val(dataRow["shuuduu"]);
        $("#txtEditUhmaliinHamgaalalt").val(dataRow["uhmaliinHamgaalalt"]);
        $("#txtEditUuliinShuuduu").val(dataRow["uuliinShuuduu"]);
        if(dataRow == ""){alertify.alert("Та засах мөрөө сонгоно уу!!!")}
        else{$('#modalEditCompany').modal('show');}

    });
});


$(document).ready(function(){
    $("#btnEditPostCompany").click(function(e){
        e.preventDefault();
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
        if($("#txtEditHunHuch").val()==""||$("#txtEditHunHuch").val()==null){
            alertify.error("Хүн хүч оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#txtEditMashinTehnik").val()==""||$("#txtEditMashinTehnik").val()==null){
            alertify.error("Ажлын машин техник оруулаагүй байна!!!");
            isInsert = false;
        }
        if(isInsert == false){return;}
        $.ajax({
          type: 'POST',
          url: editCompanyUrl,
          data: $("#frmEditCompany").serialize(),
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

$(document).ready(function(){
    $("#btnDeleteCompany").click(function(){
        if(dataRow == ""){
            alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'POST',
                url: deleteCompanyUrl,
                data: {_token: csrf, id : dataRow['id']},
                success:function(response){
                    alertify.alert(response);
                    refresh();
                    dataRow="";
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                }
            })
          } else {
              alertify.error('Устгах үйлдэл цуцлагдлаа.');
          }
        });
    });
});
