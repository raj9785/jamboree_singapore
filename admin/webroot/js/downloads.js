$(document).ready(function () {
    $("#download_category_id").on("change", function () {
        if ($(this).val() == 1) {
            $(".file").hide();
            $(".yoytube").show();
        } else {
            $(".yoytube").hide();
            $(".file").show();
        }
    });


    $("#submit_button").click(function () {

        if ($.trim($("#deadline_category_id").val()) == "") {
            $("#deadline_category_id-error").html("Please select course");
            $("#deadline_category_id").parent('div').addClass('has-error');
            $("#deadline_category_id").focus();
            return false;
        } else {
            $("#deadline_category_id").parent('div').removeClass('has-error');
            $("#deadline_category_id-error").html("");
        }

        if ($.trim($("#download_category_id").val()) == "") {
            $("#download_category_id-error").html("Please select type");
            $("#download_category_id").parent('div').addClass('has-error');
            $("#download_category_id").focus();
            return false;
        } else {
            $("#download_category_id").parent('div').removeClass('has-error');
            $("#download_category_id-error").html("");
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


        if ($("#download_category_id").val() == 1) {

            if ($.trim($("#you_tube_url").val()) == "") {
                $("#you_tube_url-error").html("Please enter URL");
                $("#you_tube_url").parent('div').addClass('has-error');
                $("#you_tube_url").focus();
                return false;
            } else {
                var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
                var matches = $('#you_tube_url').val().match(p);
                if (matches) {
                    $("#you_tube_url").parent('div').removeClass('has-error');
                    $("#you_tube_url-error").html("");
                } else {
                    $("#you_tube_url-error").html("Please enter a valid youtube video url");
                    $("#you_tube_url").parent('div').addClass('has-error');
                    $("#you_tube_url").focus();
                    return false;
                }
            }
        } else {
            if ($.trim($("#image").val()) == "") {
                $("#image-error").html("Please select file");
                $("#image").parent('div').addClass('has-error');
                $("#image").focus();
                return false;
            } else {
                $("#image").parent('div').removeClass('has-error');
                $("#image-error").html("");
            }
        }

    });


    $("#submit_button_edit").click(function () {

        if ($.trim($("#deadline_category_id").val()) == "") {
            $("#deadline_category_id-error").html("Please select course");
            $("#deadline_category_id").parent('div').addClass('has-error');
            $("#deadline_category_id").focus();
            return false;
        } else {
            $("#deadline_category_id").parent('div').removeClass('has-error');
            $("#deadline_category_id-error").html("");
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


        if ($("#download_category_id").val() == 1) {

            if ($.trim($("#you_tube_url").val()) == "") {
                $("#you_tube_url-error").html("Please enter URL");
                $("#you_tube_url").parent('div').addClass('has-error');
                $("#you_tube_url").focus();
                return false;
            } else {
                var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
                var matches = $('#you_tube_url').val().match(p);
                if (matches) {
                    $("#you_tube_url").parent('div').removeClass('has-error');
                    $("#you_tube_url-error").html("");
                } else {
                    $("#you_tube_url-error").html("Please enter a valid youtube video url");
                    $("#you_tube_url").parent('div').addClass('has-error');
                    $("#you_tube_url").focus();
                    return false;
                }
            }
        }

    });



});
