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
          "order": [[ 1, "asc" ]],
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "ajax":{
                   "url": getCompaniesUrl,
                   "dataType": "json",
                   "type": "POST",
                   "data":{
                        _token: csrf
                      }
                 },
                 "columns": [
                   { data: "daraalal", name: "daraalal"},
                   { data: "id", name: "id", visible:false},
                   { data: "heseg_id", name: "heseg_id", visible:false},
                   { data: "name", name: "name"},
                   { data: "companyName", name: "companyName"},
                   { data: "ajliinHeseg", name: "ajliinHeseg"},
                   { data: "plan", name: "plan"},
                   { data: "allExec", name: "allExec"},
                   { data: "per", name: "per", render:function(data, type, row, meta){
                     if(data == null){return "";}
                     else {return data + "%";}
                   }},
                   { data: "ognoo1", name: "ognoo1" }
                   ]
      }).ajax.reload();
}

$(document).ready(function(){
    $("#btnDeleteCompany").click(function(){
        var button = $(this);
        if(dataRow == ""){
            alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
            return;
        }

        alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
          if (e) {
            var csrf = $('meta[name=csrf-token]').attr("content");
            button.prop( "disabled", true );
            $.ajax({
                type: 'POST',
                url: deleteCompanyUrl,
                data: {
                  _token: csrf,
                  id : dataRow['id'],
                  comName: dataRow['companyName']
                },
                success:function(response){
                    alertify.alert(response);
                    refresh();
                    dataRow="";
                    button.prop( "disabled", false );
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
                    button.prop("disabled", false);
                }
            })
          } else {
              alertify.error('Устгах үйлдэл цуцлагдлаа.');
          }
        });
    });
});
