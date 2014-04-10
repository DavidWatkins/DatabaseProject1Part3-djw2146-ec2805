<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['ProjectName'], $_POST['email'], $_POST['ProjectDescription'], $_POST['support_count'], $_POST['link_count'])) {
    
    // Sanitize and validate the data passed in
    $name = filter_input(INPUT_POST, 'ProjectName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

    $description = filter_input(INPUT_POST, 'ProjectDescription', FILTER_SANITIZE_STRING);
    $support_count = filter_input(INPUT_POST, 'support_count', FILTER_SANITIZE_STRING);
    $link_count = filter_input(INPUT_POST, 'link_count', FILTER_SANITIZE_STRING);

    $stmt = oci_parse($mysqli, "select projname from projects where projname = '" . $name . "'");
    $r = oci_execute($stmt);

    if ($r) {
        $count = 0;
        while($user = oci_fetch_row($stmt)) {
            $count++;
        }

        if ($count > 0) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A project with this name already exists.</p>';
        }
    } else {
        $e = oci_error($stmt);  // For oci_execute errors pass the statement handle
        $error_msg .= '<p class="error">Database error : ' . htmlentities($e['message']) . '</p>';
    }

    for(int i = 0; i < $support_count; i++) {
    
    }
    
    for(int i = 0; i < $link_count; i++) {
        
    }

    if (empty($error_msg)) {
        // Insert the new user into the database
        $stid = oci_parse($mysqli, 'INSERT INTO Projects (projname, email, description, ) VALUES(' . $name. ', ' . $email . ', ' . $description . ', TO_DATE(' . date("mdY") .', MMDDYYYY))');

        $r = oci_execute($stid);  // executes and commits

        if ($r) {
            header('Location: ./register_success.php');
        }
        else {
            oci_bind_by_name($stid, ':password', $password);
        }
    }
}
