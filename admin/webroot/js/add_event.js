$(document).ready(function () {
    $("#submit_button").click(function () {
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

        if ($.trim($("#event_date").val()) == "") {
            $("#event_date-error").html("Please enter date");
            $("#event_date").parent('div').addClass('has-error');
            $("#event_date").focus();
            return false;
        } else {
            $("#event_date").parent('div').removeClass('has-error');
            $("#event_date-error").html("");
        }

        if ($.trim($("#event_start_time").val()) == "") {
            $("#event_start_time-error").html("Please enter start time");
            $("#event_start_time").parent('div').addClass('has-error');
            $("#event_start_time").focus();
            return false;
        } else {
            $("#event_start_time").parent('div').removeClass('has-error');
            $("#event_start_time-error").html("");
        }

        if ($.trim($("#event_end_time").val()) == "") {
            $("#event_end_time-error").html("Please enter end time");
            $("#event_end_time").parent('div').addClass('has-error');
            $("#event_end_time").focus();
            return false;
        } else {
            $("#event_end_time").parent('div').removeClass('has-error');
            $("#event_end_time-error").html("");
        }

        if ($.trim($("#event_url").val())) {
            var url = document.getElementById("event_url").value;
            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (pattern.test(url)) {
                $("#event_url").parent('div').removeClass('has-error');
                $("#event_url-error").html("");
            } else {
                $("#event_url-error").html("Please enter Valid URL");
                $("#event_url").parent('div').addClass('has-error');
                $("#event_url").focus();
                return false;
            }
        } else {
            $("#event_url").parent('div').removeClass('has-error');
            $("#event_url-error").html("");
        }

        if ($.trim($("#description").val()) == "") {
            $("#description-error").html("Please enter description");
            $("#description").parent('div').addClass('has-error');
            $("#description").focus();
            return false;
        } else {
            $("#description").parent('div').removeClass('has-error');
            $("#description-error").html("");
        }

    });

});

