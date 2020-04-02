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
            { data: "id", name: "id" },
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
          { data: "id", name: "id" },
          { data: "name", name: "name"}
        ]
  });

  $('#datatable_workType tbody').on( 'click', 'tr', function () {
      var currow = $(this).closest('tr');
      $('#datatable_workType tbody tr').css("background-color", "white");
      $(this).closest('tr').css("background-color", "yellow");
      dataRow = $('#datatable_workType').DataTable().row(currow).data();
      // alert(dataRow["companyName"]);
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
          $("#txtEditGHursHuulalt").prop("disabled", false);
          $("#txtEditGDalan").prop("disabled", false);
          $("#txtEditGUhmal").prop("disabled", false);
          $("#txtEditGSuuriinUy").prop("disabled", false);
          $("#txtEditGShuuduu").prop("disabled", false);
          $("#txtEditGUhmaliinHamgaalalt").prop("disabled", false);
          $("#txtEditGUuliinShuuduu").prop("disabled", false);

            $("#txtEditGID").val(dataRow["id"]);
            $("#cmbEditGCompany").val(dataRow["companyID"]);
            $("#txtEditOgnoo").val(dataRow["ognoo"]);
            $("#txtEditGHursHuulalt").val(dataRow["gHursHuulalt"]);
            $("#txtEditGDalan").val(dataRow["gDalan"]);
            $("#txtEditGUhmal").val(dataRow["gUhmal"]);
            $("#txtEditGSuuriinUy").val(dataRow["gSuuriinUy"]);
            $("#txtEditGShuuduu").val(dataRow["gShuuduu"]);
            $("#txtEditGUhmaliinHamgaalalt").val(dataRow["gUhmaliinHamgaalalt"]);
            $("#txtEditGUuliinShuuduu").val(dataRow["gUuliinShuuduu"]);
            if(dataRow == ""){alertify.alert("Та засах мөрөө сонгоно уу!!!")}
            else{$('#modalEditGuitsetgel').modal('show');}

            // disableEditInputs();

        });
    });

});
