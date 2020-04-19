
$(document).ready(function(){
    $("#btnEditHunHuch").click(function(){
      $('.hunhuchEditCompanyName').text(dataRow['companyName']);
        if(dataRow == ""){alertify.alert("Та засах мөрөө сонгоно уу!!!")}
        else{
          refreshExecEdit(dataRow["companyID"]);
          $('#editHunHuchModal').modal('show');}
    });
});

$(document).ready(function(){
$('#editHunhuchTable tbody').on( 'click', 'tr', function () {
    var currow2 = $(this).closest('tr');
    $('#editHunhuchTable tbody tr').css("background-color", "white");
    $(this).closest('tr').css("background-color", "yellow");
    hunhuchEditRow = $('#editHunhuchTable').DataTable().row(currow2).data();

    $("#hunhuchRowID").val(hunhuchEditRow['id']);
    $("#hunhuchEditRow").val(hunhuchEditRow['hunHuch']);
    $("#texnikEditRow").val(hunhuchEditRow['mashinTehnik']);
    $("#ognooEditRow").val(hunhuchEditRow['ognoo']);
  });
});



function refreshExecEdit(comID){
  $('#editHunhuchTable').dataTable().fnDestroy();
  $('#editHunhuchTable').DataTable( {
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
      "order": [[ 3, "DESC" ]],
      "select":true,
      "ajax":{
               "url": getOneCompanyHunHuchUrl,
               "dataType": "json",
               "type": "post",
               "data":{
                     comID: comID,
                     _token: csrf
                  }
             },
      "columns": [
          { data: "id", name: "id",  render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    } },
          { data: "hunHuch", name: "hunHuch"},
          { data: "mashinTehnik", name: "mashinTehnik"},
          { data: "ognoo", name: "ognoo"},
        ]
  }).ajax.reload();
}

$(document).ready(function(){
    $("#btnEditPostOneHunhuch").click(function(e){
        if(hunhuchEditRow == ""){
            alertify.error('Та засах мөрөө дарж сонгоно уу!!!');
            return;
        }

        var isInsert = true;
        if($("#hunhuchEditRow").val()==""||$("#hunhuchEditRow").val()==null){
            alertify.error("Хүн хүчний тоо оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#texnikEditRow").val()==""||$("#texnikEditRow").val()==null){
            alertify.error("Машин техникийн тоо оруулаагүй байна!!!");
            isInsert = false;
        }
        if($("#ognooEditRow").val()==""||$("#ognooEditRow").val()==null){
            alertify.error("Огноо оруулаагүй байна!!!");
            isInsert = false;
        }

        if(isInsert == false){return;}
        $.ajax({
          type: 'POST',
          url: editOneCompanyHunHuchUrl,
          data: {
            _token: $('meta[name=csrf-token]').attr("content"),
            hunhuchRowID : $("#hunhuchRowID").val(),
            hunhuchEditRow: $("#hunhuchEditRow").val(),
            texnikEditRow: $("#texnikEditRow").val(),
            ognooEditRow: $("#ognooEditRow").val()
          },
          success:function(response){
              alertify.alert(response);
               refreshExecEdit(dataRow["companyID"]);
               emptyVal();
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
    $("#btnDeleteOneHunhuch").click(function(e){
        if(hunhuchEditRow == ""){
            alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'POST',
                url: deleteHunHuchUrl,
                data: {_token: csrf, id : hunhuchEditRow['id']},
                success:function(response){
                    alertify.alert(response);
                    refreshExecEdit(dataRow["companyID"]);
                    emptyVal();
                    hunhuchRefresh();
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
      function emptyVal(){
        $("#hunhuchRowID").val("");
        $("#hunhuchEditRow").val("");
        $("#texnikEditRow").val("");
        $("#ognooEditRow").val("");
      }

});
