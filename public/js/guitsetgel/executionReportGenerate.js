var hide = true;
$(document).ready(function(){
    $("#btnGenerateReport").click(function(){
        hide = true;
        $("#generateReportAlert").html("<strong>Уншиж байна...</strong>");
        // setTimeout(showGenerateReportAlert, 500);
        $.ajax({
            type:'get',
            url:generateReportUrl,
            success:function(res){
                $("#divGenerateReport").hide();
                clearTimeout();
                $("#generateReportAlert").html("<strong>Тайлан бодож дууслаа.</strong>");
            }
        });
    });
});
