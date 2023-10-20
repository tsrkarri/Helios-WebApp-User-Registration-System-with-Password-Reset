const validation_changepassword = new JustValidate("#change_password");

validation_changepassword
    .addField('#password', [
        {
            rule: 'required'
        },
        {
            rule: 'strongPassword'
        }
    ])
    .addField('#re_password', [
        {
            rule: 'required'
        },
        {
            rule: 'strongPassword'
        },
        {
            validator: (value, fields) => {
                return value == fields["#password"].elem.value;
            }, errorMessage: "Passwords should match !"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("change_password").submit();
    });