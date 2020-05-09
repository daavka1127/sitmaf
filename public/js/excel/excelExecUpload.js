$(document).ready(function(){
    $("#frmUploadExcel").submit(function(e){
        e.preventDefault();
        var proceed = true;
        if($("#date").val() == ""){
            proceed = false;
            alertify.error("Гүйцэтгэлийн огноог сонгоно уу!!!");
        }
        if(document.getElementById("hideFile").files.length == 0){
            proceed = false;
            alertify.error("Excel файлаа оруулна уу!!!");
        }
        if(proceed){
            $("#frmUploadExcel")[0].submit();
        }
    });
});
