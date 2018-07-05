$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#phone_numbers").val()) == "") {
            $("#phone_numbers-error").html("Please enter phone numbers");
            $("#phone_numbers").parent('div').addClass('has-error');
            $("#phone_numbers").focus();
            return false;
        } else {
            $("#phone_numbers").parent('div').removeClass('has-error');
            $("#phone_numbers-error").html("");
        }
        if ($.trim($("#emails").val()) == "") {
            $("#emails-error").html("Please enter emails");
            $("#emails").parent('div').addClass('has-error');
            $("#emails").focus();
            return false;
        } else {
            $("#emails").parent('div').removeClass('has-error');
            $("#emails-error").html("");
        }
        if ($.trim($("#availability").val()) == "") {
            $("#availability-error").html("Please enter availability");
            $("#availability").parent('div').addClass('has-error');
            $("#availability").focus();
            return false;
        } else {
            $("#availability").parent('div').removeClass('has-error');
            $("#availability-error").html("");
        }

        if ($.trim($("#adress").val()) == "") {
            $("#adress-error").html("Please enter address");
            $("#adress").parent('div').addClass('has-error');
            $("#adress").focus();
            return false;
        } else {
            $("#adress").parent('div').removeClass('has-error');
            $("#adress-error").html("");
        }

        if ($.trim($("#map_iframe_src").val()) == "") {
            $("#map_iframe_src-error").html("Please enter map iframe src");
            $("#map_iframe_src").parent('div').addClass('has-error');
            $("#map_iframe_src").focus();
            return false;
        } else {
            $("#map_iframe_src").parent('div').removeClass('has-error');
            $("#map_iframe_src-error").html("");
        }

    });
});
