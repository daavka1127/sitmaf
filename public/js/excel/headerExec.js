$(document).ready(function(){
    $("#cmbWtype").change(function(){
        window.location.href = $("#cmbHeseg").attr("red-url") + $("#cmbHeseg").val() + "/" + $("#cmbWtype").val();
    });
});
$(document).ready(function(){
    $("#cmbHeseg").change(function(){
        window.location.href = $("#cmbHeseg").attr("red-url") + $("#cmbHeseg").val() + "/" + $("#cmbWtype").val();
    });
});
