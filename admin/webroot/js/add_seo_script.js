$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#position_type").val()) == "") {
            $("#position_type-error").html("Please Select Position");
            $("#position_type").parent('div').addClass('has-error');
            $("#position_type").focus();
            return false;
        } else {
            $("#position_type").parent('div').removeClass('has-error');
            $("#position_type-error").html("");
        }

        if ($.trim($("#script_title").val()) == "") {
            $("#script_title-error").html("Please enter script name");
            $("#script_title").parent('div').addClass('has-error');
            $("#script_title").focus();
            return false;
        } else {
            $("#script_title").parent('div').removeClass('has-error');
            $("#script_title-error").html("");
        }

        if ($.trim($("#script_body").val()) == "") {
            $("#script_body-error").html("Please enter script");
            $("#script_body").parent('div').addClass('has-error');
            $("#script_body").focus();
            return false;
        } else {
            $("#script_body").parent('div').removeClass('has-error');
            $("#script_body-error").html("");
        }


    });

});
