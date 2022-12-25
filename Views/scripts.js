function myAjax() {
    $.ajax({
         type: "POST",
         url: '/ajax.php',
         data:{action:'call_deleteOrderLine'},
         success:function(html) {
           alert(html);
         }

    });
}