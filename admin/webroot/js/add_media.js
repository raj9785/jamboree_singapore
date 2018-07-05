$(document).ready(function () {
    $("#media_type_id").on("change", function () {
        if ($(this).val() == 1) {
            $(".youtube_url").show();
            $(".image_url").hide();
        } else {
            $(".image_url").show();
            $(".youtube_url").hide();
        }
    });


    $("#submit_button").click(function () {
        if ($.trim($("#media_type_id").val()) == "") {
            $("#media_type_id-error").html("Please select media type");
            $("#media_type_id").parent('div').addClass('has-error');
            $("#media_type_id").focus();
            return false;
        } else {
            $("#media_type_id").parent('div').removeClass('has-error');
            $("#media_type_id-error").html("");
        }

        if ($.trim($("#title").val()) == "") {
            $("#title-error").html("Please enter title");
            $("#title").parent('div').addClass('has-error');
            $("#title").focus();
            return false;
        } else {
            $("#title").parent('div').removeClass('has-error');
            $("#title-error").html("");
        }

        if ($.trim($("#media_type_id").val()) == "2") {
            if ($.trim($("#media_url_image").val()) == "") {
                $("#media_url_image-error").html("Please select image");
                $("#media_url_image").parent('div').addClass('has-error');
                $("#media_url_image").focus();
                return false;
            } else {
                $("#media_url_image").parent('div').removeClass('has-error');
                $("#media_url_image-error").html("");
            }
        } else {
            if ($.trim($("#media_url").val()) == "") {
                $("#media_url-error").html("Please enter URL");
                $("#media_url").parent('div').addClass('has-error');
                $("#media_url").focus();
                return false;
            } else {
                var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
                var matches = $('#media_url').val().match(p);
                if (matches) {
                    $("#media_url").parent('div').removeClass('has-error');
                    $("#media_url-error").html("");
                } else {
                    $("#media_url-error").html("Please enter a valid youtube video url");
                    $("#media_url").parent('div').addClass('has-error');
                    $("#media_url").focus();
                    return false;
                }
            }
        }

    });

    $("#submit_button_edit").click(function () {
        if ($.trim($("#title").val()) == "") {
            $("#title-error").html("Please enter title");
            $("#title").parent('div').addClass('has-error');
            $("#title").focus();
            return false;
        } else {
            $("#title").parent('div').removeClass('has-error');
            $("#title-error").html("");
        }

        if ($.trim($("#media_type").val()) == "2") {
            $("#media_url_image").parent('div').removeClass('has-error');
            $("#media_url_image-error").html("");
        } else {
            if ($.trim($("#media_url").val()) == "") {
                $("#media_url-error").html("Please enter URL");
                $("#media_url").parent('div').addClass('has-error');
                $("#media_url").focus();
                return false;
            } else {
                var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
                var matches = $('#media_url').val().match(p);
                if (matches) {
                    $("#media_url").parent('div').removeClass('has-error');
                    $("#media_url-error").html("");
                } else {
                    $("#media_url-error").html("Please enter a valid youtube video url");
                    $("#media_url").parent('div').addClass('has-error');
                    $("#media_url").focus();
                    return false;
                }
            }
        }

    });

});

