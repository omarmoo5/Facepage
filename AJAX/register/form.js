$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        let formData = {
            name: $("#name").val(),
            email: $("#email").val().toLowerCase(),
            password: $("#password").val(),
        };
        console.log(formData);
        let VALID = true;

        if (formData['email'].trim() === '') {
            VALID = false;
            $("#email-group").addClass("has-error");
            $("#email-group").append('<div class="help-block">' + "Email is required." + "</div>");
        }

        if (formData['password'] === '') {
            VALID = false;
            $("#password-group").addClass("has-error");
            $("#password-group").append('<div class="help-block">' + 'Password is required.' + "</div>");
        }

        if (formData['name'].trim() === '') {
            VALID = false;
            $("#name-group").addClass("has-error");
            $("#name-group").append('<div class="help-block">' + 'Username is required.' + "</div>");
        }

        if(VALID){
        $.ajax({
            type: "POST",
            url: "process.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
            .done(function (data) {
            console.log(data);
            if (!data.success) { // Error
                if (data.errors.name) {
                    $("#name-group").addClass("has-error");
                    $("#name-group").append('<div class="help-block">' + data.errors.name + "</div>");
                }

                if (data.errors.email) {
                    $("#email-group").addClass("has-error");
                    $("#email-group").append('<div class="help-block">' + data.errors.email + "</div>");
                }

                if (data.errors.password) {
                    $("#password-group").addClass("has-error");
                    $("#password-group").append('<div class="help-block">' + data.errors.password + "</div>");
                }
            } else { // Success
                $("form").html('<script></script>'+'<div class="alert alert-success">' + data.message + "</div>");
                window.location.href = '/loginWindow/AJAX/member.php';
            }
            })
            .fail(function (data) {
                $("#message-group").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
            });
        }
        event.preventDefault();
    });
});