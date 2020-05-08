$(document).ready(function(){
    $("#btnEditGuitsetgel").click(function(){

        if(dataRow == ""){
          alertify.alert("Та засах мөрөө сонгоно уу!!!")
          return;
        }
        refreshExecEdit(dataRow["id"]);
        $('#modalEditGuitsetgel').modal('show');
        $('.printCompanyName').text(dataRow['companyName']);
        $('#hiddenCompanyName').text(dataRow['companyName']);

        $.ajax({
          type:"post",
          url:getBtoohemjee,
          data:{
            _token: $("meta[name='csrf-token']").attr("content"),
            comID: dataRow['id']
          },
          success:function(response){
            // alertify.alert(response);
            $("#batlagsanTooHenjee").text(response);
          }
        });
    });
});

function refreshExecEdit(comID){
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
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+parseFloat(pageTotal).toFixed(2) +' ( '+ parseFloat(total).toFixed(2) +' бүх хуудасны нийт)'
            );
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
          { data: "execution", name: "execution" },
          { data: "work_id", name: "work_id", visible:false}
        ]
  }).ajax.reload();


}

$(document).ready(function(){
    $("#btnEditPostGuitsetgel").click(function(e){
        e.preventDefault();
        var button = $(this);
        var plan = parseFloat($("#hidePlan").val());
        var otherExec = parseFloat($("#hideExecOther").val());
        var sumExec = otherExec + parseFloat($("#editExec").val());
        // alert(sumExec);
        $("#editExec").removeClass("redBorder");
        if(plan<sumExec){
          alertify.error("Гүйцэтгэлийн хэмжээ төлөвлөсөн ажлаас их байна!!!");
          $("#editExec").addClass("redBorder");
          return;
        }
        var isInsert = true;
        if($("#editExec").val()==""||$("#editExec").val()==null){
            alertify.error("Гүйцэтгэлийн утга оруулаагүй байна!!!");
            isInsert = false;
        }

        if(isInsert == false){return;}
        button.prop("disabled", true);
        $.ajax({
          type: 'POST',
          url: executionUpdateUrl,
          data: {
            _token: $('meta[name=csrf-token]').attr("content"),
            execRowID : execEditRow['id'],
            editExec: $("#editExec").val(),
            workName: execEditRow['workName'],
            comName: dataRow['companyName'],
            editDate: execEditRow['date']
          },
          success:function(response){
              alertify.alert(response);
              $('#modalEditGuitsetgel').modal('hide');
              execEditRow = "";
              refresh();
              button.prop("disabled", false);
          },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
            var errors = jqXhr.responseJSON;
            var errorsHtml = '';
            $.each(errors['errors'], function (index, value) {
                errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
            });
            alert(errorsHtml);
            button.prop("disabled", false);
          }
        });
    });
});

$(document).ready(function(){
    $("#btnDeletePostGuitsetgel").click(function(){
      var button = $(this);
        if(execEditRow == ""){
            alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            button.prop("disabled", true);
            $.ajax({
                type: 'POST',
                url: executionDeleteUrl,
                data: {
                  _token: csrf,
                  id : execEditRow['id'],
                  execution: execEditRow['execution'],
                  workName: execEditRow['workName'],
                  comName: dataRow['companyName'],
                  editDate: execEditRow['date']
                },
                success:function(response){
                    alertify.alert(response);
                    refreshExecEdit(dataRow['id']);
                    execEditRow="";
                    button.prop("disabled", false);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                    button.prop("disabled", false);
                }
            });
          } else {
              // alert(dataRow["companyName"]);
              alertify.error('Устгах үйлдэл цуцлагдлаа.');
          }
        });
    });
});
