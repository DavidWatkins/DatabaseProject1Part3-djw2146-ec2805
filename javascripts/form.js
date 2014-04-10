function regformhash(form, uid, school, email, password, conf) {

    // Check each field has a value
    if (uid.value == ''         ||
        email.value == ''     ||
        password.value == ''  ||
        school.value == ''    ||
        conf.value == '') {

        alert('You must provide all the requested details. Please try again');
        return false;
    }

    // Check the username

    re = /^\w+$/;
    if(!re.test(form.username.value)) {
        alert("Username must contain only letters, numbers and underscores. Please try again");
        form.username.focus();
        return false;
    }

    //Check the School

    if(school.value.toLowerCase != 'columbia' && school.value.toLowerCase != 'columbia university' &&
       school.value.toLowerCase != 'brown' && school.value.toLowerCase != 'brown university' &&
       school.value.toLowerCase != 'harvard' && school.value.toLowerCase != 'harvard university' &&
       school.value.toLowerCase != 'mit' && school.value.toLowerCase != 'massachusetts institute of technology' &&
       school.value.toLowerCase != 'yale' && school.value.toLowerCase != 'yale university') {
        alert('School must be Columbia, Harvard, Brown, Yale, or MIT.');
        form.school.focus();
        return false;
    }
    
    school.value = school.value.toLowerCase;

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        form.password.focus();
        return false;
    }

    if(password.value.length > 16) {
        alert('Passwords must be less than 16 characters long. Please try again');
        form.password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter
    // At least six characters

    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (!re.test(password.value)) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }

    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('Your password and confirmation do not match. Please try again');
        form.password.focus();
        return false;
    }

    conf.value = "";

    // Finally submit the form.
    form.submit();
    return true;
}
