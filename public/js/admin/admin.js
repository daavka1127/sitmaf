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
      $("#pass").val(dataRow['password']);
      $("#access").val(dataRow['heseg_id']);

       // $('#cmbNewCompanyName').text(dataRow['companyName']+" " + dataRow['ajliinHeseg']);
       // $('#cmbNewCompanyID').val(dataRow['id']);


  });

});
