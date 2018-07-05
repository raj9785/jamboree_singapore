$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#heading").val()) == "") {
            $("#heading-error").html("Please enter heading");
            $("#heading").parent('div').addClass('has-error');
            $("#heading").focus();
            return false;
        } else {
            $("#heading").parent('div').removeClass('has-error');
            $("#heading-error").html("");
        }


        

    });

});

