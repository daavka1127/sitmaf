$(document).ready(function(){
  $("#btnEditAdmin").click(function(){

      if(dataRow == ""){
        alertify.alert("Та засах мөрөө сонгоно уу!!!")
        return;
      }
      // refreshExecEdit(dataRow["id"]);
      $('#modalEditAdmin').modal('show');
      $("#adminRowID").val(dataRow['id']);
      $("#name").val(dataRow['name']);
      $("#email").val(dataRow['email']);
      $("#access").val(dataRow['heseg_id']);

       // $('#cmbNewCompanyName').text(dataRow['companyName']+" " + dataRow['ajliinHeseg']);
       // $('#cmbNewCompanyID').val(dataRow['id']);


  });

  $("#btnEditPostAdmin").click(function(e){
      e.preventDefault();
      var isInsert = true;
      if($("#name").val()==""||$("#name").val()==null){
          alertify.error("Нэр оруулан уу!!!");
          isInsert = false;
      }

      if($("#email").val()==""||$("#email").val()==null){
          alertify.error("Цахим хаяг оруулан уу!!!");
          isInsert = false;
      }
      if($("#pass").val()==""||$("#pass").val()==null){
          alertify.error("Нууц үг оруулан уу!!!");
          isInsert = false;
      }

      if(isInsert == false){return;}
      $.ajax({
        type: 'POST',
        url: adminUpdateUrl,
        data: $("#frmEditAdmin").serialize(),
        success:function(response){
            alertify.alert(response);
            $('#modalEditAdmin').modal('hide');
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

function refresh(){
  $('#datatableAdmin').dataTable().fnDestroy();
    $('#datatableAdmin').DataTable( {
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
                 "url": getadminUrl,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: $('meta[name="csrf-token"]').attr('content')
                    }
               },
        "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      } },
            { data: "name", name: "name"},
            { data: "email", name: "email"},
            { data: "password", name: "passsword"},
            { data: "heseg_id", name: "heseg_id", visible:false },
            { data: "heseg_name", name: "heseg_name" }
          ]
    }).ajax.reload();
}

$(document).ready(function(){
  $("#btnDeleteAdmin").click(function(){
    if(dataRow == ""){
      alertify.error("Та устгах мөрөө сонгоно уу!!!")
      return;
    }
    $.ajax({
        type:"post",
        url:$("#btnDeleteAdmin").attr("delete-url"),
        data:{
          id:dataRow['id'],
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success:function(res){
          alertify.alert(res);
          refresh();
        }
    });
  });

});
