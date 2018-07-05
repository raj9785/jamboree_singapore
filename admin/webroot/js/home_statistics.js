$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#upper_value").val()) == "") {
            $("#upper_value-error").html("Please enter upper value");
            $("#upper_value").parent('div').addClass('has-error');
            $("#upper_value").focus();
            return false;
        } else {
            $("#upper_value").parent('div').removeClass('has-error');
            $("#upper_value-error").html("");
        }

        if ($.trim($("#lower_value").val()) == "") {
            $("#lower_value-error").html("Please enter lower value");
            $("#lower_value").parent('div').addClass('has-error');
            $("#lower_value").focus();
            return false;
        } else {
            $("#lower_value").parent('div').removeClass('has-error');
            $("#lower_value-error").html("");
        }

    });

});

