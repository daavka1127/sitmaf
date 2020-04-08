$(document).ready(function(){
    $("#btnEditGuitsetgel").click(function(){

        if(dataRow == ""){
          alertify.alert("Та засах мөрөө сонгоно уу!!!")
          return;
        }
        refreshExecEdit(dataRow["id"]);
        $('#modalEditGuitsetgel').modal('show');
        $('.printCompanyName').text(dataRow['companyName']);

    });
});

function refreshExecEdit(comID){
  // alert(dataRow["id"]); //comID
  // $('#execRowID').text("");
  // $('#workType').text("");
  // $('#work').text("");
  // $('#editDate').text("");
  // $('#editExec').text("");

  $('#editExecTable').dataTable().fnDestroy();
  $('#editExecTable').DataTable( {
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
      "select":true,
      "ajax":{
               "url": getExecByCompany,
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
          { data: "workTypeName", name: "workTypeName"},
          { data: "workName", name: "workName"},
          { data: "date", name: "date"},
          { data: "execution", name: "execution" }
        ]
  }).ajax.reload();


}

$(document).ready(function(){
    $("#btnEditPostGuitsetgel").click(function(e){
        e.preventDefault();
        var isInsert = true;
        if($("#editExec").val()==""||$("#editExec").val()==null){
            alertify.error("Гүйцэтгэлийн утга оруулаагүй байна!!!");
            isInsert = false;
        }

        if(isInsert == false){return;}
        $.ajax({
          type: 'POST',
          url: executionUpdateUrl,
          data: $("#frmEditExec").serialize(),
          success:function(response){
              alertify.alert(response);
              $('#modalEditGuitsetgel').modal('hide');
              execEditRow = "";
              // refresh();
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
    $("#btnDeletePostGuitsetgel").click(function(){
        if(execEditRow == ""){
            alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            $.ajax({
                type: 'POST',
                url: executionDeleteUrl,
                data: {_token: csrf, id : execEditRow['id']},
                success:function(response){
                    alertify.alert(response);
                    refreshExecEdit(dataRow['id']);
                    execEditRow="";
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
