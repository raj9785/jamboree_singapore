$(document).ready(function () {
    $("#course_id").on("change", function () {
        if ($(this).val() == 6) {
            $(".university_name").show();
            $(".marks").hide();
        } else {
            $(".marks").show();
            $(".university_name").hide();
        }
    });


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

        if ($.trim($("#student_name").val()) == "") {
            $("#student_name-error").html("Please enter student name");
            $("#student_name").parent('div').addClass('has-error');
            $("#student_name").focus();
            return false;
        } else {
            $("#student_name").parent('div').removeClass('has-error');
            $("#student_name-error").html("");
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
        if ($.trim($("#course_id").val()) == '6') {
            if ($.trim($("#university_name").val()) == "") {
                $("#university_name-error").html("Please enter university name");
                $("#university_name").parent('div').addClass('has-error');
                $("#university_name").focus();
                return false;
            } else {
                $("#university_name").parent('div').removeClass('has-error');
                $("#university_name-error").html("");
            }
        } else {
            if ($.trim($("#marks").val()) == "") {
                $("#marks-error").html("Please enter score");
                $("#marks").parent('div').addClass('has-error');
                $("#marks").focus();
                return false;
            } else {
                $("#marks").parent('div').removeClass('has-error');
                $("#marks-error").html("");
            }
        }

        if ($.trim($("#reviews").val()) == "") {
            $("#reviews-error").html("Please enter reviews");
            $("#reviews").parent('div').addClass('has-error');
            $("#reviews").focus();
            return false;
        } else {
            $("#reviews").parent('div').removeClass('has-error');
            $("#reviews-error").html("");
        }


    });

    $("#submit_button_edit").click(function () {
        if ($.trim($("#student_name").val()) == "") {
            $("#student_name-error").html("Please enter student name");
            $("#student_name").parent('div').addClass('has-error');
            $("#student_name").focus();
            return false;
        } else {
            $("#student_name").parent('div').removeClass('has-error');
            $("#student_name-error").html("");
        }


        if ($.trim($("#course_id_sel").val()) == '6') {
            if ($.trim($("#university_name").val()) == "") {
                $("#university_name-error").html("Please enter university name");
                $("#university_name").parent('div').addClass('has-error');
                $("#university_name").focus();
                return false;
            } else {
                $("#university_name").parent('div').removeClass('has-error');
                $("#university_name-error").html("");
            }
        } else {
            if ($.trim($("#marks").val()) == "") {
                $("#marks-error").html("Please enter score");
                $("#marks").parent('div').addClass('has-error');
                $("#marks").focus();
                return false;
            } else {
                $("#marks").parent('div').removeClass('has-error');
                $("#marks-error").html("");
            }
        }

        if ($.trim($("#reviews").val()) == "") {
            $("#reviews-error").html("Please enter reviews");
            $("#reviews").parent('div').addClass('has-error');
            $("#reviews").focus();
            return false;
        } else {
            $("#reviews").parent('div').removeClass('has-error');
            $("#reviews-error").html("");
        }

    });

});

