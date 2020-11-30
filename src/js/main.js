function fieldValidate(form) {
    var inputData = {
        fName: form.fName.value,
        lName: form.lName.value,
        emailAddress: form.emailAddress.value
    }

    checkEmptyFields(inputData);
    checkEmailAddress(inputData['emailAddress']);
    if (!(allFieldsValid())) {
        return false;
    }
    return true;


    function checkEmptyFields(blank) {
        for (var i in blank) {
            if (blank[i] == '' || blank[i] == 0 || blank[i].length < 2) {
                document.getElementById(i).classList.remove('valid');
                document.getElementById(i).classList.add('invalid');
            } else {
                document.getElementById(i).classList.remove('invalid');
                document.getElementById(i).classList.add('valid')
            }
        }
    }

    function checkEmailAddress(email) {
        if (email != '') {
            var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/;
            if (!(emailRegex.test(email))) {
                document.getElementById('emailAddress').classList.remove('valid');
                document.getElementById('emailAddress').classList.add('invalid');
            } else if (email != '') {
                document.getElementById('emailAddress').classList.remove('invalid');
                document.getElementById('emailAddress').classList.add('valid');
            }
        }
    }

    function allFieldsValid() {
        var allFieldsValid = document.getElementsByClassName('notempty');

        if (allFieldsValid.length != 4) {
            return false;
        } else {
            return true;
        }
    }
}