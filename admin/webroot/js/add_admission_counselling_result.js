$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#admission_counselling_course_id").val()) == "") {
            $("#admission_counselling_course_id-error").html("Please Select Course");
            $("#admission_counselling_course_id").parent('div').addClass('has-error');
            $("#admission_counselling_course_id").focus();
            return false;
        } else {
            $("#admission_counselling_course_id").parent('div').removeClass('has-error');
            $("#admission_counselling_course_id-error").html("");
        }

        if ($.trim($("#student_name").val()) == "") {
            $("#student_name-error").html("Please enter student name");
            $("#student_name").parent('div').addClass('has-error');
            $("#student_name").focus();
            return false;
        } else {
            $("#student_name").parent('div').removeClass('has-error');
            $("#student_name-error").html("");
        }

        if ($.trim($("#university_name").val()) == "") {
            $("#university_name-error").html("Please enter university name");
            $("#university_name").parent('div').addClass('has-error');
            $("#university_name").focus();
            return false;
        } else {
            $("#university_name").parent('div').removeClass('has-error');
            $("#university_name-error").html("");
        }

        if ($.trim($("#result_year").val()) == "") {
            $("#result_year-error").html("Please enter year");
            $("#result_year").parent('div').addClass('has-error');
            $("#result_year").focus();
            return false;
        } else {
            $("#result_year").parent('div').removeClass('has-error');
            $("#result_year-error").html("");
        }
    });

});
function checkValiValue(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
        return false;
    }
}
