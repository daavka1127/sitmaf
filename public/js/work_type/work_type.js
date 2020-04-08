var dataRow="";
function refresh(){

    var csrf = $('meta[name=csrf-token]').attr("content");
    $('#datatable_workType').dataTable().fnDestroy();
    $('#datatable_workType').DataTable( {
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
                 "url": getWorkTypeUr,
                 "dataType": "json",
                 "type": "POST",
                 "data":{
                      _token: csrf
                    }
               },
        "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      } },
            { data: "name", name: "name"}
          ]
    }).ajax.reload();
}
function emptyNewModal(){
  $("#work_type_id").val("");
  }

$(document).ready(function(){


  $('#datatable_workType').DataTable( {
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
               "url": getWorkTypeUr,
               "dataType": "json",
               "type": "POST",
               "data":{
                    _token: csrf
                  }
             },
      "columns": [
          { data: "id", name: "id",  render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    } },
          { data: "name", name: "name"}
        ]
  });

  $('#datatable_workType tbody').on( 'click', 'tr', function () {
      var currow = $(this).closest('tr');
      $('#datatable_workType tbody tr').css("background-color", "white");
      $(this).closest('tr').css("background-color", "yellow");
      dataRow = $('#datatable_workType').DataTable().row(currow).data();
      
    });



});

$(document).ready(function(){
  $("#btnWorkTypeAdd").click(function(e){
      e.preventDefault();
      // alert("adfadf");
      var isInsert = true;
      if($("#work_type_id").val()==""){
          alertify.error("Ажлын төрөл оруулан уу?");
          isInsert = false;
      }


      if(isInsert == false) { return; }

      $.ajax({
        type: 'POST',
        url: newWorkTypeUrl,
        data: $("#frmAddWorkTypeName").serialize(),
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

  $("#btnEditWorkType").click(function(){
    $("#txtEditWorkTypeID").val(dataRow["id"]);
    $("#ework_type_id").val(dataRow["name"]);
      if(dataRow == ""){alertify.alert("Та засах мөрөө сонгоно уу!!!")}
      else{$('#ModelEditWorkType').modal('show');}

  });

  $("#btnWorkTypeEdit").click(function(e){
      e.preventDefault();
      // alert("adfadf");
      var isInsert = true;
      if($("#ework_type_id").val()==""){
          alertify.error("Ажлын төрөл оруулан уу?");
          isInsert = false;
      }
      if(isInsert == false) { return; }
      $.ajax({
        type: 'POST',
        url: updateWorkTypeUrl,
        data: $("#frmUpdateWorkType").serialize(),
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

  $("#btnDeleteWorkType").click(function(){
      if(dataRow == ""){
          alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
          return;
      }

      alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
        if (e) {
          var csrf = $('meta[name=csrf-token]').attr("content");
          $.ajax({
              type: 'POST',
              url: deleteWorkTypeUrl,
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
