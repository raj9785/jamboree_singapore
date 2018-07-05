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

        if ($.trim($("#name").val()) == "") {
            $("#name-error").html("Please enter student name");
            $("#name").parent('div').addClass('has-error');
            $("#name").focus();
            return false;
        } else {
            $("#name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }

        if ($.trim($("#marks").val()) == "") {
            $("#marks-error").html("Please enter marks");
            $("#marks").parent('div').addClass('has-error');
            $("#marks").focus();
            return false;
        } else {
            $("#marks").parent('div').removeClass('has-error');
            $("#marks-error").html("");
        }

        if ($.trim($("#pass_year").val()) == "") {
            $("#pass_year-error").html("Please enter pass_year");
            $("#pass_year").parent('div').addClass('has-error');
            $("#pass_year").focus();
            return false;
        } else {
            $("#pass_year").parent('div').removeClass('has-error');
            $("#pass_year-error").html("");
        }
    });

});
function checkValiValue(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
        return false;
    }
}
