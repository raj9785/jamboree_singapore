$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#career_category_id").val()) == "") {
            $("#career_category_id-error").html("Please select career area");
            $("#career_category_id").parent('div').addClass('has-error');
            $("#career_category_id").focus();
            return false;
        } else {
            $("#career_category_id").parent('div').removeClass('has-error');
            $("#career_category_id-error").html("");
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

        if ($.trim($("#location").val()) == "") {
            $("#location-error").html("Please enter location");
            $("#location").parent('div').addClass('has-error');
            $("#location").focus();
            return false;
        } else {
            $("#location").parent('div').removeClass('has-error');
            $("#location-error").html("");
        }

        
    });

});

