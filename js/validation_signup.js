const validation_signup = new JustValidate("#signup");

validation_signup
    .addField("#name", [
        {
            rule: 'required',
            errorMessage: 'Name is required !!',
        },
        {
            rule: 'customRegexp',
            value: /^[a-zA-Z ]*$/,
            errorMessage: 'Name is only alphabets !!'
        }
    ])
    .addField('#designation', [
        {
            rule: 'required',
            errorMessage: 'Designation is required !!'
        },
        {
            rule: 'customRegexp',
            value: /^[a-zA-Z ]*$/,
            errorMessage: 'Designation is only alphabets !!'
        }
    ])
    .addField('#isafcstaff', [
        {
            rule: 'required',
            errorMessage: 'Specify Yes or No above !!'
        }
    ])
    .addField("#ma", [
        {
            rule: 'customRegexp',
            value: /^[a-zA-Z ]*$/,
            errorMessage: 'MA is only alphabets !!'
        },
        {
            validator: (value, fields) => {
                return (fields["#isafcstaff"].elem.value == 'n' && value.length > 0) || fields["#isafcstaff"].elem.value == 'y'
            }, errorMessage: 'MA is required'
        }
    ])
    .addField("#email", [
        {
            rule: 'required',
            errorMessage: 'Email is required !!'
        },
        {
            rule: 'email',
            errorMessage: 'Please Enter a valid email !!'
        },
        {
            validator: (value) => () => {
                return fetch("validateemail.php?email=" +
                    encodeURIComponent(value))
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return json.available;
                    });
            }, errorMessage: 'Email already registered !!'
        },
        {
            validator: (value, fields) => {
                return ((fields['#isafcstaff'].elem.value == "y") && value.endsWith('the-afc.com'))
                    || fields['#isafcstaff'].elem.value == "n";
            }, errorMessage: 'Enter AFC Email Only !!!'
        }
    ])
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
            }, errorMessage: "Passwords should match !!"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });
