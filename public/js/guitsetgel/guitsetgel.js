function refresh(){

    var csrf = $('meta[name="csrf-token"]').attr("content");
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
          "ajax":{
                   "url": getCompaniesUrl,
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
                     { data: "heseg_id", name: "heseg_id", visible:false},
                     { data: "name", name: "name"},
                     { data: "companyName", name: "companyName"},
                     { data: "ajliinHeseg", name: "ajliinHeseg"},
                     { data: "hunHuch", name: "hunHuch", visible:false},
                     { data: "mashinTehnik", name: "mashinTehnik", visible:false},
                     { data: "gereeOgnoo", name: "gereeOgnoo", visible:false },
                     { data: "plan", name: "plan"},
                     { data: "allExec", name: "allExec"},
                     { data: "per", name: "per", render:function(data, type, row, meta){
                       if(data == null){return "";}
                       else {return data + "%";}
                     }}
                   ]
      }).ajax.reload();
}
//
// $(document).ready(function(){
//     $("#btnPostNewGuitsetgel").click(function(e){
//         e.preventDefault();
//         var isInsert = true;
//         if($("#cmbNewCompanyID").val()=="-1"||$("#cmbNewCompanyID").val()==null){
//             alertify.error("Аж ахуйн нэгжийг сонгоно уу.");
//             isInsert = false;
//         }
//         if($("#txtOgnoo").val()==""||$("#txtOgnoo").val()==null){
//             alertify.error("Oгноо оруулаагүй байна!");
//             isInsert = false;
//         }
//
//         if(isInsert == false) { return; }
//
//         $.ajax({
//           type: 'POST',
//           url: newCompanyUrl,
//           data: $("#frmNewGuitsetgel").serialize(),
//           success:function(response){
//               alertify.alert(response);
//               emptyNewModal();
//               refresh();
//           },
//           error: function(jqXhr, json, errorThrown){// this are default for ajax errors
//             var errors = jqXhr.responseJSON;
//             var errorsHtml = '';
//             $.each(errors['errors'], function (index, value) {
//                 errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
//             });
//             alert(errorsHtml);
//           }
//         });
//     });
// });
//
//
// function emptyNewModal(){
//   $("#txtCompanyName").val("");
//   $("#txtOgnoo").val("");
//   $("#txtHursHuulalt").val("");
//   $("#txtDalan").val("");
//   $("#txtUhmal").val("");
//   $("#txtSuuriinUy").val("");
//   $("#txtShuuduu").val("");
//   $("#txtUhmaliinHamgaalalt").val("");
//   $("#txtUuliinShuuduu").val("");
//   $("#cmbNewCompanyID").val('-1');
// }

// $(document).ready(function(){
//     $("#cmbNewCompanyID").change(function(){
//       $("#txtHursHuulalt").prop("disabled", false);
//       $("#txtDalan").prop("disabled", false);
//       $("#txtUhmal").prop("disabled", false);
//       $("#txtSuuriinUy").prop("disabled", false);
//       $("#txtShuuduu").prop("disabled", false);
//       $("#txtUhmaliinHamgaalalt").prop("disabled", false);
//       $("#txtUuliinShuuduu").prop("disabled", false);
//
//
//         var csrf = $('meta[name=csrf-token]').attr("content");
//         $.ajax({
//           type: 'POST',
//           url: getCompanyByID,
//           data: {
//               _token: csrf,
//               id : $("#cmbNewCompanyID").val()
//           },
//           success:function(response){
//               if(response[0].uuliinShuuduu == null)
//                 $("#txtUuliinShuuduu").prop("disabled", true);
//               if(response[0].uhmaliinHamgaalalt == null)
//                 $("#txtUhmaliinHamgaalalt").prop("disabled", true);
//               if(response[0].dalan == null)
//                 $("#txtDalan").prop("disabled", true);
//               if(response[0].uhmal == null)
//                 $("#txtUhmal").prop("disabled", true);
//               if(response[0].hursHuulalt == null)
//                 $("#txtHursHuulalt").prop("disabled", true);
//               if(response[0].suuriinUy == null)
//                 $("#txtSuuriinUy").prop("disabled", true);
//               if(response[0].shuuduu == null)
//                 $("#txtShuuduu").prop("disabled", true);
//
//               $("#lbl_hursHuulalt").text(response[0].hursHuulalt);
//               $("#lbl_dalan").text(response[0].dalan);
//               $("#lbl_uhmal").text(response[0].uhmal);
//               $("#lbl_suuriinUy").text(response[0].suuriinUy);
//               $("#lbl_shuuduu").text(response[0].shuuduu);
//               $("#lbl_uhmalHamgaalalt").text(response[0].uhmaliinHamgaalalt);
//               $("#lbl_uuliinShuuduu").text(response[0].uuliinShuuduu);
//           },
//           error: function(jqXhr, json, errorThrown){// this are default for ajax errors
//             var errors = jqXhr.responseJSON;
//             var errorsHtml = '';
//             $.each(errors['errors'], function (index, value) {
//                 errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
//             });
//             alert(errorsHtml);
//           }
//         });
//     });
// });



// function disableEditInputs(){
//   var csrf = $('meta[name=csrf-token]').attr("content");
//   $.ajax({
//     type: 'POST',
//     url: getCompanyByID,
//     data: {
//         _token: csrf,
//         id : $("#cmbEditGCompany").val()
//     },
//     success:function(response){
//         if(response[0].uuliinShuuduu == null)
//           $("#txtEditGUuliinShuuduu").prop("disabled", true);
//         if(response[0].uhmaliinHamgaalalt == null)
//           $("#txtEditGUhmaliinHamgaalalt").prop("disabled", true);
//         if(response[0].dalan == null)
//           $("#txtEditGDalan").prop("disabled", true);
//         if(response[0].uhmal == null)
//           $("#txtEditGUhmal").prop("disabled", true);
//         if(response[0].hursHuulalt == null)
//           $("#txtEditGHursHuulalt").prop("disabled", true);
//         if(response[0].suuriinUy == null)
//           $("#txtEditGSuuriinUy").prop("disabled", true);
//         if(response[0].shuuduu == null)
//           $("#txtEditGShuuduu").prop("disabled", true);
//
//           $("#lbl_ehursHuulalt").text(response[0].hursHuulalt);
//           $("#lbl_edalan").text(response[0].dalan);
//           $("#lbl_euhmal").text(response[0].uhmal);
//           $("#lbl_esuuriinUy").text(response[0].suuriinUy);
//           $("#lbl_eshuuduu").text(response[0].shuuduu);
//           $("#lbl_euhmalHamgaalalt").text(response[0].uhmaliinHamgaalalt);
//           $("#lbl_euuliinShuuduu").text(response[0].uuliinShuuduu);
//     },
//     error: function(jqXhr, json, errorThrown){// this are default for ajax errors
//       var errors = jqXhr.responseJSON;
//       var errorsHtml = '';
//       $.each(errors['errors'], function (index, value) {
//           errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
//       });
//       alert(errorsHtml);
//     }
//   });
// }

// $(document).ready(function(){
//     $("#btnEditPostGuitsetgel").click(function(e){
//         e.preventDefault();
//         var isInsert = true;
//         if($("#cmbEditGCompany").val()==""||$("#cmbEditGCompany").val()==null){
//             alertify.error("Аж ахуйн нэгжийн нэр оруулаагүй байна!!!");
//             isInsert = false;
//         }
//         if($("#txtEditOgnoo").val()==""||$("#txtEditOgnoo").val()==null){
//             alertify.error("Oгноо оруулаагүй байна!!!");
//             isInsert = false;
//         }
//         if(isInsert == false){return;}
//         $.ajax({
//           type: 'POST',
//           url: editCompanyUrl,
//           data: $("#frmEditGuitsetgel").serialize(),
//           success:function(response){
//               alertify.alert(response);
//               $('#modalEditGuitsetgel').modal('hide');
//               dataRow = "";
//               refresh();
//           },
//           error: function(jqXhr, json, errorThrown){// this are default for ajax errors
//             var errors = jqXhr.responseJSON;
//             var errorsHtml = '';
//             $.each(errors['errors'], function (index, value) {
//                 errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
//             });
//             alert(errorsHtml);
//           }
//         });
//     });
// });
//
// $(document).ready(function(){
//     $("#btnDeleteGuitsetgel").click(function(){
//         if(dataRow == ""){
//             alertify.error('Та Устгах мөрөө дарж сонгоно уу!!!');
//             return;
//         }
//
//         alertify.confirm( "Та устгахдаа итгэлтэй байна уу?", function (e) {
//           if (e) {
//             var csrf = $('meta[name=csrf-token]').attr("content");
//             $.ajax({
//                 type: 'POST',
//                 url: deleteCompanyUrl,
//                 data: {_token: csrf, id : dataRow['id']},
//                 success:function(response){
//                     alertify.alert(response);
//                     refresh();
//                     dataRow="";
//                 },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) {
//                     alertify.error("Status: " + textStatus); alertify.error("Error: " + errorThrown);
//                 }
//             })
//           } else {
//               alertify.error('Устгах үйлдэл цуцлагдлаа.');
//           }
//         });
//     });
// });
