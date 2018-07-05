$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#menu_slug").val()) == "") {
            $("#menu_slug-error").html("Please Select Page");
            $("#menu_slug").parent('div').addClass('has-error');
            $("#menu_slug").focus();
            return false;
        } else {
            $("#menu_slug").parent('div').removeClass('has-error');
            $("#menu_slug-error").html("");
        }

        if ($.trim($("#question").val()) == "") {
            $("#question-error").html("Please enter question");
            $("#question").parent('div').addClass('has-error');
            $("#question").focus();
            return false;
        } else {
            $("#question").parent('div').removeClass('has-error');
            $("#question-error").html("");
        }

        if ($.trim($("#answer").val()) == "") {
            $("#answer-error").html("Please enter answer");
            $("#answer").parent('div').addClass('has-error');
            $("#answer").focus();
            return false;
        } else {
            $("#answer").parent('div').removeClass('has-error');
            $("#answer-error").html("");
        }
    });

});
