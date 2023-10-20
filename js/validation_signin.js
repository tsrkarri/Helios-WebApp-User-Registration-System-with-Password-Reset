const validation_signin = new JustValidate("#signin");

validation_signin
    .addField('#email', [
        {
            rule: 'required',
            errorMessage: 'Email is required'
        },
        {
            rule: 'email',
            errorMessage: 'Please Enter a valid email'
        }
    ])
    .addField('#password', [
        {
            rule: 'required',
            errorMessage: 'Password is Required'
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signin").submit();
    });