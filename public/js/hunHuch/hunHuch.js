function hunhuchRefresh(){
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
        "order": [[ 6, "desc" ], [ 3, "asc" ]],
        "ajax":{
                 "url": getHunHuchUrl,
                 "dataType": "json",
                 "type": "get",
                 "data":{
                      _token: "{{ csrf_token() }}"
                    }
               },
        "columns": [
            { data: "id", name: "id" },
            { data: "companyName", name: "companyName"},
            { data: "companyID", name: "companyID"},
            { data: "ajliinHeseg", name: "ajliinHeseg"},
            { data: "hunHuch", name: "hunHuch" },
            { data: "mashinTehnik", name: "mashinTehnik" },
            { data: "ognoo", name: "ognoo" }
          ]
    }).ajax.reload();
      // }).ajax.reload();
}

$(document).ready(function(){
  $("#btnAddHunhuch").click(function(){
    // alert(dataRow['companyID']);
      if(dataRow == ""){
        alertify.alert("Та засах мөрөө сонгоно уу!!!")
        return;
      }
      $('#newHunHuchModal').modal('show');
       $('#cmbNewCompanyName').text(dataRow['companyName']+" " + dataRow['ajliinHeseg']);
       $('#cmbCompanyID').val(dataRow['companyID']);

  });

    $("#btnNewPostHunHuch").click(function(e){
        e.preventDefault();
        var isInsert = true;

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
              hunhuchRefresh();
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
              hunhuchRefresh();
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
                    hunhuchRefresh();
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
