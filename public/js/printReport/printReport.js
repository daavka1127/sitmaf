$(document).on('change', '[type=radio]', function(){
    var id = $(this).attr("workTypeId");
    $.each(workTypes, function(index, item){
      $("#worktypeid" + item.id).css("display","none");
      $("." + item.id).hide();
      $('input:checkbox').prop('checked', true);
    });
    $("." + id).show();
    if($(this).is(':checked')){
        $("#worktypeid" + id).css("display","block");
        // $("."+id).show();
    }
    else{
        $("#worktypeid" + id).css("display","none");
        // $("."+id).hide();
    }
});

$(document).ready(function(){
  $(".checkWork").click(function(){
    var workID = $(this).attr("workId");
    if($(this).is(':checked')){
        // alert("checked");
        $(".table1 #prev" + workID).show();
        $(".table1 #report" + workID).show();
        $(".table2 #prev" + workID).show();
        $(".table2 #report" + workID).show();
        $(".table3 #prev" + workID).show();
        $(".table3 #report" + workID).show();
        $(".allTable #prev" + workID).show();
        $(".allTable #report" + workID).show();
    }
    else{
        // alert("unchecked");
        $(".table1 #prev" + workID).hide();
        $(".table1 #report" + workID).hide();
        $(".table2 #prev" + workID).hide();
        $(".table2 #report" + workID).hide();
        $(".table3 #prev" + workID).hide();
        $(".table3 #report" + workID).hide();
        $(".allTable #prev" + workID).hide();
        $(".allTable #report" + workID).hide();
    }
  });
});

$(document).ready(function(){
    $(".table1").rowspanizer({
        vertical_align: 'middle',
        columns: [0,1]
    });
    $(".table2").rowspanizer({
        vertical_align: 'middle',
        columns: [0,1]
    });
    $(".table3").rowspanizer({
        vertical_align: 'middle',
        columns: [0,1]
    });
    $(".allTable").rowspanizer({
        vertical_align: 'middle',
        columns: [0,1]
    });
});

$(document).ready(function(){
    $("#btnUnmerge").click(function(){
        unmerge();
    });

    $("#btnMerge").click(function(){
      alert("A");
      $(".table1").rowspanizer({
          vertical_align: 'middle',
          columns: [0]
      });
    });
});

function unmerge(){
    // $(".table1 tbody tr td:first-child").each(function(index, item){
    //     alert($(this).children('td').first().text());
    // });
    $(".table1 tbody tr").each(function(index, item){
        var a = $('td:first', $(this)).text();
        if(a == "Ерөнхий мэдээлэл"){
            $('td:first', $(this)).removeAttr( "rowspan" );
        }
        else{
            $("<td>Ерөнхий мэдээлэл</td>").insertBefore($('td:first', $(this)));
        }
        if(a == "Мэдээний хугацаанд гүйцэтгэсэн"){
            $('td:first', $(this)).removeAttr( "rowspan" );
        }
        else{
            $("<td>Мэдээний хугацаанд гүйцэтгэсэн</td>").insertBefore($('td:first', $(this)));
        }
    });
}
