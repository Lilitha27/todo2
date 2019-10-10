function cleanUp() {
    $("li")
        .wrapperInner("<p>")
        .prepend("<div class=/<a class=></a> </div>")

    // check if ListItemDone and render strike-through when needed 
    $.ajax({
        type :"POST",
        url :"inc/renderStrike.php",
        async :true,
        dataType : "json",
        success :function(msg) {
            strikeArrLength =msg.length ;
            for(i=0;i<strikeArrLength;i++) {
                console.log(msg[i]);
                if (msg[i]>0) {
                    $(" li:eq ("+ i + ")").find ("p"). css("text-decoration-line","line-through");

                }else{
                    $(" li:eq ("+ i + ")").find ("p"). css("text-decoration-line","none");

                }
            }
        }
    })
};
// Check status of ListItemDone and render strike-through if needed
$("li"). on("click","check",function() {
    // get li index value from DOM 
    var checkNum =$(this).parent().index();

    $.ajax({
        type :"POST",
        url : "inc/done.php",
        data : "val=" +checkNum,
        async :true,
        dataType : "text",
        success :function(data) {
            if (data>0) {
                $(" li:eq (" +checkNum+ ")" ).find("p").css("text-decoration-line", "line-through");
            }else{
                $(" li:eq (" +checkNum+ ")" ).find("p").css("text-decoration-line", "none");
            }
        }
    });
});

$("li").on("click","del",function () {
    $(this).parent().fadeOut("fast");
    var checkNum=$(this).parent().index();

$.post('inc/delete.php','val='+checkNum);
});
