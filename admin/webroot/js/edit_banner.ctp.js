$(document).ready(function () {
    $("#submit_button").click(function () {
        if ($.trim($("#alt_text").val()) == "") {
            $("#alt_text-error").html("Please enter Banner Alt Text");
            $("#alt_text").parent('div').addClass('has-error');
            $("#alt_text").focus();
            return false;
        } else {
            $("#alt_text").parent('div').removeClass('has-error');
            $("#alt_text-error").html("");
        }
        if ($.trim($("#image_url").val()) == "") {
            $("#image_url-error").html("Please enter Banner Image URL");
            $("#image_url").parent('div').addClass('has-error');
            $("#image_url").focus();
            return false;
        } else {
            var url = document.getElementById("image_url").value;
            var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
            if (pattern.test(url)) {
                $("#image_url").parent('div').removeClass('has-error');
                $("#image_url-error").html("");
            } else {
                $("#image_url-error").html("Please enter Valid URL");
                $("#image_url").parent('div').addClass('has-error');
                $("#image_url").focus();
                return false;
            }
        }
    });

});
