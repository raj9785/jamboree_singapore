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
        if ($.trim($("#social_url").val()) == "") {
            $("#social_url-error").html("Please enter social URL");
            $("#social_url").parent('div').addClass('has-error');
            $("#social_url").focus();
            return false;
        } else {
            var url = document.getElementById("social_url").value;
            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (pattern.test(url)) {
                $("#social_url").parent('div').removeClass('has-error');
                $("#social_url-error").html("");
            } else {
                $("#social_url-error").html("Please enter Valid URL");
                $("#social_url").parent('div').addClass('has-error');
                $("#social_url").focus();
                return false;
            }

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

    $("#submit_button_edit").click(function () {
        if ($.trim($("#alt_tag").val()) == "") {
            $("#alt_tag-error").html("Please enter image alt tag");
            $("#alt_tag").parent('div').addClass('has-error');
            $("#alt_tag").focus();
            return false;
        } else {
            $("#alt_tag").parent('div').removeClass('has-error');
            $("#alt_tag-error").html("");
        }
        if ($.trim($("#social_url").val()) == "") {
            $("#social_url-error").html("Please enter social URL");
            $("#social_url").parent('div').addClass('has-error');
            $("#social_url").focus();
            return false;
        } else {
            var url = document.getElementById("social_url").value;
            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (pattern.test(url)) {
                $("#social_url").parent('div').removeClass('has-error');
                $("#social_url-error").html("");
            } else {
                $("#social_url-error").html("Please enter Valid URL");
                $("#social_url").parent('div').addClass('has-error');
                $("#social_url").focus();
                return false;
            }

        }


    });
});

