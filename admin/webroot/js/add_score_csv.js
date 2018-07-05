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

        if ($.trim($("#csv_file").val()) == "") {
            $("#csv_file-error").html("Please select CSV file");
            $("#csv_file").parent('div').addClass('has-error');
            $("#csv_file").focus();
            return false;
        } else {
            $("#csv_file").parent('div').removeClass('has-error');
            $("#csv_file-error").html("");
        }

    });

});

