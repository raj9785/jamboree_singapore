$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#alt_tag").val()) == "") {
            $("#alt_tag-error").html("Please enter image alt tag");
            $("#alt_tag").parent('div').addClass('has-error');
            $("#alt_tag").focus();
            return false;
        } else {
            $("#alt_tag").parent('div').removeClass('has-error');
            $("#alt_tag-error").html("");
        }
        if ($.trim($("#image").val()) == "") {
            $("#image-error").html("Please select image");
            $("#image").parent('div').addClass('has-error');
            $("#image").focus();
            return false;
        } else {
            $("#image").parent('div').removeClass('has-error');
            $("#image-error").html("");
        }

    });
});

