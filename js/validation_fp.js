const validation_forgotpassword = new JustValidate("#forgot_password");
validation_forgotpassword
    .addField("#email", [
        {
            validator: (value) => () => {
                return fetch("validateemail.php?email=" +
                    encodeURIComponent(value))
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return !(json.available);
                    });
            }, errorMessage: 'Enter your registered Email Only'
        },
    ])
    .onSuccess((event) => {
        document.getElementById("forgot_password").submit();
    });