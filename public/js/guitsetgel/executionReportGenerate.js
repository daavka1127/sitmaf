var hide = true;
$(document).ready(function(){
    $("#btnGenerateReport").click(function(){
        hide = true;
        $("#generateReportAlert").html("<strong>Уншиж байна...</strong>");
        // setTimeout(showGenerateReportAlert, 500);
        $.ajax({
            type:'get',
            url:$("#btnGenerateReport").attr('data-post-url'),
            data:{
              lastDate: $("#dateTime").val()
            },
            success:function(res){
                // $("#divGenerateReport").hide();
                // clearTimeout();
                // $("#generateReportAlert").html("<strong>Тайлан бодож дууслаа.</strong>");
                window.location.replace($("#btnGenerateReport").attr('data-url'));
            }
        });
    });
});
