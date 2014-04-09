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

    $stmt = oci_parse($mysqli, "select email from USERS where email = " . $email . "LIMIT 1");

    if ($stmt) {
        oci_execute($stmt, OCI_DEFAULT);
        $count = 0;
        while(oci_fetch($stmt)) {
            $count++;
        }

        if ($count == 1) {
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
        $insert_statement = "INSERT INTO USERS (username, email, password, school) VALUES (" . $name . ", " . $email . ", " . $password . ", " . $school . ")";
        $stmt = oci_parse($mysqli, $insert_statement);
        if ($stmt) {
            $r = oci_execute($stmt, OCI_DEFAULT);
            if (!$r) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
            header('Location: ./register_success.php');

        }
        else {
            $error_msg ="Error creating statement";
        }
    }
}
