$(document).on('click', '[type=checkbox]', function(){
    var id = $(this).attr("workTypeId");
    if($(this).is(':checked')){
        $("#worktypeid" + id).show();
    }
    else{
        $("#worktypeid" + id).hide();
    }
});
