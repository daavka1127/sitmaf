$(document).on('click', '[type=checkbox]', function(){
    var id = $(this).attr("workTypeId");
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

// $(document).ready(function(){
//   $("#davaa").rowspanizer({
//     vertical_align: 'middle',
//     columns: [0,1]
//   });
// unmergeRow();
// });


function unmergeRow(){
  $("#davaa > tbody > tr").each(function(index, tr){
      console.log(index);
      console.log(tr);
      $.each(tr, function(index, td){
        console.log($(this).children('td:first').attr('rowspan'));
      });
  });
}
