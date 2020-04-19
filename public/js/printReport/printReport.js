$(document).on('change', '[type=radio]', function(){
    var id = $(this).attr("workTypeId");
    window.location.replace($("#btnPrint").attr("redurl") + id);
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
    merge();
    // $("table .workType").hide(); Work type-aar n arilgaad bgam shig bn bas
    $.each(workTypes, function(index, item){
      if(item.id == workType){
        $("#checkWorkType" + item.id).prop("checked", true);
        $("#worktypeid" + item.id).css("display","block");
      }
    });

    sumLastTable();
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

function merge(){
  $(".table1").rowspanizer({
      vertical_align: 'middle',
      columns: [0]
  });
  $(".table2").rowspanizer({
      vertical_align: 'middle',
      columns: [0]
  });
  $(".table3").rowspanizer({
      vertical_align: 'middle',
      columns: [0]
  });
  $(".allTable").rowspanizer({
      vertical_align: 'middle',
      columns: [0]
  });
}

function sumLastTable(){
    // alert($('.allTable #lastTablePlanRow .sum').length);
    var sumPlan=0;
    var sumExec2020=0;
    var avgExec2019=0;
    $('.allTable #lastTablePlanRow .sum').each(function(){
        sumPlan += parseFloat($(this).text());
        $('#lastTableSumPlan').html(sumPlan);
    });
    $('.allTable #lastTableExec2020Row .sum').each(function(){
        sumExec2020 += parseFloat($(this).text());
        $('#lastTableSumExec2020').html(sumExec2020);
    });
    avgExec2019 = parseFloat((sumPlan-sumExec2020)*100/sumPlan).toFixed(1);
    $("#lastTableSumExecPercent2019").html(avgExec2019 + "%");
}

$(document).ready(function(){
    $("#btnPrint").click(function(){
        window.print();
    });
    if(/chrom(e|ium)/.test(navigator.userAgent.toLowerCase())){
       // alert('I am chrome');
      }
});


// function thinkTable(tableIndex, workTypeID){
//     $.each(companies, function(index, item){
//         var sumReportExec=0;
//         var sumPlan = "";
//         console.log($(".table" + tableIndex + " tr th").find('.allPlan').length);
//         // $('.table' + tableIndex + ' tr').each(function(){
//         //     var sumPlan = $(this).find(".colComID" + item.id + ", .allPlan").html();
//         //     console.log(sumPlan);
//         // });
//         // $('.colComID' + item.id + ', .sumReportExec' + workTypeID).html("sumPlan");
//     });
// }
