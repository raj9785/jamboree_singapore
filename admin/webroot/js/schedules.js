$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#course_id").val()) == "") {
            $("#course_id-error").html("Please Select Course");
            $("#course_id").parent('div').addClass('has-error');
            $("#course_id").focus();
            return false;
        } else {
            $("#course_id").parent('div').removeClass('has-error');
            $("#course_id-error").html("");
        }

        if ($.trim($("#start_date").val()) == "") {
            $("#start_date-error").html("Please enter date");
            $("#start_date").parent('div').addClass('has-error');
            $("#start_date").focus();
            return false;
        } else {
            $("#start_date").parent('div').removeClass('has-error');
            $("#start_date-error").html("");
        }

        if ($.trim($("#duration").val()) == "") {
            $("#duration-error").html("Please enter duration");
            $("#duration").parent('div').addClass('has-error');
            $("#duration").focus();
            return false;
        } else {
            $("#duration").parent('div').removeClass('has-error');
            $("#duration-error").html("");
        }

        if ($.trim($("#timings").val()) == "") {
            $("#timings-error").html("Please enter timings");
            $("#timings").parent('div').addClass('has-error');
            $("#timings").focus();
            return false;
        } else {
            $("#timings").parent('div').removeClass('has-error');
            $("#timings-error").html("");
        }

        if ($.trim($("#days").val()) == "") {
            $("#days-error").html("Please enter days");
            $("#days").parent('div').addClass('has-error');
            $("#days").focus();
            return false;
        } else {
            $("#days").parent('div').removeClass('has-error');
            $("#days-error").html("");
        }
    });

});
