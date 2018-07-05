$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#name").val()) == "") {
            $("#name-error").html("Please enter name");
            $("#name").parent('div').addClass('has-error');
            $("#name").focus();
            return false;
        } else {
            $("#name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }
    });

});

