$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#course_id").val()) == "") {
            $("#course_id-error").html("Please select course");
            $("#course_id").parent('div').addClass('has-error');
            $("#course_id").focus();
            return false;
        } else {
            $("#course_id").parent('div').removeClass('has-error');
            $("#course_id-error").html("");
        }


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

    });



});

