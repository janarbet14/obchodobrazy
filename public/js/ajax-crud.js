$(document).ready(function(){

    $("#btn-delete").click(function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });

        e.preventDefault();
        $.ajax({
            url: 'cart',
            type: 'POST',
            success: function(response) {
                alert(ahoj);
            }
        });
        //alert("ahoj");
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

});