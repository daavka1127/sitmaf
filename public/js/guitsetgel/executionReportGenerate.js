var hide = true;
$(document).ready(function(){
    $("#btnGenerateReport").click(function(){
        var dt = new Date();
        if($("#date").val() == ""){
          alertify.error("Тайлангийн хугацааг оруулна уу!!!");
          $("#date").css('border-color', 'red');
          return;
        }
        hide = true;
        $("#generateReportAlert").html("<strong>Уншиж байна...</strong>");
        $.ajax({
            type:'POST',
            url:$("#btnGenerateReport").attr('data-post-url'),
            data:{
              lastDate: $("#date").val() + ":" + dt.getSeconds(),
              _token:$('meta[name="csrf-token"]').attr('content')
            },
            success:function(res){
                window.location.replace($("#btnGenerateReport").attr('data-url'));
            }
        });
    });
});
