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
                   "url": getHunHuchUrl,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
              { data: "id", name: "id" },
              { data: "companyName", name: "companyName"},
              { data: "companyID", name: "companyID", visible:false},
              { data: "hunHuch", name: "hunHuch" },
              { data: "mashinTehnik", name: "mashinTehnik" },
              { data: "ognoo", name: "ognoo" }
            ]
      }).ajax.reload();
}

$(document).ready(function(){
    $("#btnNewPostHunHuch").click(function(e){
        e.preventDefault();
        var isInsert = true;
        if($("#cmbCompanyID").val()=="0"){
            alertify.error("Аж ахуйн нэгж сонгоогүй байна!!!");
            isInsert = false;
        }
        if($("#txtHunHuch").val()==""||$("#txtHunHuch").val()==null){
            alertify.error("Хүн хүчийн тоогоо оруулна уу!!!");
            isInsert = false;
        }
        if($("#txtMashinTehnik").val()==""||$("#txtMashinTehnik").val()==null){
            alertify.error("Машин техникийн тоогоо оруулна уу!!!");
            isInsert = false;
        }
        if($("#txtOgnoo").val()==""||$("#txtOgnoo").val()==null){
            alertify.error("Огноогоо оруулна уу!!!");
            isInsert = false;
        }
        if(isInsert == false){return;}
        $.ajax({
          type: 'POST',
          url: newHunHuchUrl,
          data: $("#frmNewHunHuch").serialize(),
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
  $("#cmbCompanyID").val("0");
  $("#txtHunHuch").val("");
  $("#txtMashinTehnik").val("");
  $("#txtOgnoo").val("");
}


$(document).ready(function(){
    $("#btnEditHunHuch").click(function(){
        $("#editHunHuchID").val(dataRow["id"]);
        $("#cmbEditCompanyID").val(dataRow["companyID"]);
        $("#txtEditHunHuch").val(dataRow["hunHuch"]);
        $("#txtEditMashinTehnik").val(dataRow["mashinTehnik"]);
        $("#txtEditOgnoo").val(dataRow["ognoo"]);
        if(dataRow == ""){alertify.alert("Та засах мөрөө сонгоно уу!!!")}
        else{$('#editHunHuchModal').modal('show');}

    });
});


$(document).ready(function(){
    $("#btnEditPostHunHuch").click(function(e){
        e.preventDefault();
        var isInsert = true;
        if($("#cmbEditCompanyID").val()=="0"){
            alertify.error("Аж ахуйн нэгж сонгоогүй байна!!!");
            isInsert = false;
        }
        if($("#txtEditHunHuch").val()==""||$("#txtHunHuch").val()==null){
            alertify.error("Хүн хүчийн тоогоо оруулна уу!!!");
            isInsert = false;
        }
        if($("#txtEditMashinTehnik").val()==""||$("#txtMashinTehnik").val()==null){
            alertify.error("Машин техникийн тоогоо оруулна уу!!!");
            isInsert = false;
        }
        if($("#txtEditOgnoo").val()==""||$("#txtOgnoo").val()==null){
            alertify.error("Огноогоо оруулна уу!!!");
            isInsert = false;
        }
        if(isInsert == false){return;}
        $.ajax({
          type: 'POST',
          url: editHunHuchUrl,
          data: $("#frmEditHunHuch").serialize(),
          success:function(response){
              alertify.alert(response);
              refresh();
              dataRow = "";
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
    $("#btnDeleteHunHuch").click(function(){
        if(dataRow == ""){
            alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'POST',
                url: deleteHunHuchUrl,
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
