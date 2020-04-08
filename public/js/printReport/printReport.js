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
        $("#prev" + workID).show();
        $("#report" + workID).show();
    }
    else{
        // alert("unchecked");
        $("#prev" + workID).hide();
        $("#report" + workID).hide();
    }
  });
});

$(document).ready(function(){
  $("#davaa").rowspanizer({
    vertical_align: 'middle',
    columns: [0,1]
  });
unmergeRow();
});


function unmergeRow(){
  $("#davaa > tbody > tr").each(function(index, tr){
      console.log(index);
      console.log(tr);
      $.each(tr, function(index, td){
        console.log($(this).children('td:first').attr('rowspan'));
      });
  });
}
