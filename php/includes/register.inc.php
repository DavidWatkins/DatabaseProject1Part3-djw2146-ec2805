<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['name'], $_POST['email'], $_POST['school'], $_POST['password'])) {
    // Sanitize and validate the data passed in
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
    $school = filter_input(INPUT_POST, 'school', FILTER_SANITIZE_STRING);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (strlen($password) > 16 || strlen($password) < 6) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

    $stmt = oci_parse($mysqli, "select email from USERS where email = '" . $email . "'");
    $r = oci_execute($stmt);

    if ($r) {
        $count = 0;
        while($user = oci_fetch_row($stmt)) {
            $count++;
        }

        if ($count > 0) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
    } else {
        $e = oci_error($stmt);  // For oci_execute errors pass the statement handle
        $error_msg .= '<p class="error">Database error : ' . htmlentities($e['message']) . '</p>';
    }

    // TODO:
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {
        // Insert the new user into the database
        $stid = oci_parse($mysqli, 'INSERT INTO USERS (name, email, password, school) VALUES(:name, :email, :password, :school)');

        oci_bind_by_name($stid, ':name', $name);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':password', $password);
        oci_bind_by_name($stid, ':school', $school);

        $r = oci_execute($stid);  // executes and commits

        if ($r) {
            header('Location: ./register_success.php');
        }
        else {
            oci_bind_by_name($stid, ':password', $password);
        }
    }
}
