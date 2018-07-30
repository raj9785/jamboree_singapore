$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#image").val()) == "") {
            $("#image-error").html("Please select icon");
            $("#image").parent('div').addClass('has-error');
            $("#image").focus();
            return false;
        } else {
            $("#image").parent('div').removeClass('has-error');
            $("#image-error").html("");
        }

        if ($.trim($("#alt_text").val()) == "") {
            $("#alt_text-error").html("Please enter icon Alt Text");
            $("#alt_text").parent('div').addClass('has-error');
            $("#alt_text").focus();
            return false;
        } else {
            $("#alt_text").parent('div').removeClass('has-error');
            $("#alt_text-error").html("");
        }

       


    });

    $("#cancel_button_edit").click(function () {


        if ($.trim($("#alt_text").val()) == "") {
            $("#alt_text-error").html("Please enter icon Alt Text");
            $("#alt_text").parent('div').addClass('has-error');
            $("#alt_text").focus();
            return false;
        } else {
            $("#alt_text").parent('div').removeClass('has-error');
            $("#alt_text-error").html("");
        }

        


    });

});
