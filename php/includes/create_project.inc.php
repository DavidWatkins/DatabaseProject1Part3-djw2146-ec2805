<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
$error_msg = "";

if (isset($_POST['ProjectName'], $_POST['email'], $_POST['ProjectDescription'], $_POST['link_count'], $_POST['user_email'])) {

    // Sanitize and validate the data passed in
    $name = $_POST['ProjectName'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid' . $email. '</p>';
    }

    $user_email = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid: ' . $user_email. '</p>';
    }

    $description = filter_input(INPUT_POST, 'ProjectDescription', FILTER_SANITIZE_STRING);
    $support_count = filter_input(INPUT_POST, 'support_count', FILTER_SANITIZE_STRING);
    $link_count = filter_input(INPUT_POST, 'link_count', FILTER_SANITIZE_STRING);

    $stmt = oci_parse($mysqli, "select projname from projects where projname = '" . $name . "' ");
    $r = oci_execute($stmt);

    if ($r) {
        $count = 0;
        while($proj = oci_fetch_row($stmt)) {
            $count++;
        }

        if ($count > 0) {
            $error_msg .= '<p class="error">A project with this name already exists.</p>';
        }
    } else {
        $e = oci_error($stmt);  // For oci_execute errors pass the statement handle
        $error_msg .= '<p class="error">Database error : ' . htmlentities($e['message']) . '</p>';
    }


    if (empty($error_msg)) {

        $stid = oci_parse($mysqli, "INSERT INTO Projects (projname, email, description, date_created, user_email) VALUES(:name, :email, :description, TO_DATE('". (string)date("mdY") . "', 'MMDDYYYY'), :user_email)");

        oci_bind_by_name($stid, ':name', $name);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':description', $description);
        oci_bind_by_name($stid, ':user_email', $user_email);

        $r = oci_execute($stid);  // executes and commits

        if (!$r) {
            $error_msg .= '<p class="error">Error inserting into database.</p>';
        }
    }

    if(empty($error_msg)) {

        if(isset($_POST['FSRItem'], $_POST['FSRDescription'], $_POST['FSRQuantity'])) {
            $FSRItem = $_POST['FSRItem'];
            $FSRDescription = filter_input(INPUT_POST, 'FSRDescription', FILTER_SANITIZE_STRING);;
            $FSRQuantity = $_POST['FSRQuantity'];
            
            if($FSRItem != "" && $FSRDescription != "" && $FSRQuantity != "") {
                
                $stid = oci_parse($mysqli, "INSERT INTO Support_requests (description, category, percent_fulfilled, projname) VALUES( :FSRDescription, 'food', 0.0, :name )");
                oci_bind_by_name($stid, ':FSRDescription', $FSRDescription);
                oci_bind_by_name($stid, ':name', $name);

                $r = oci_execute($stid);  // executes and commits
                if (!$r) {
                    $error_msg .= '<p class="error">Error inserting Food into database.</p>';
                }else {
                    $stid = oci_parse($mysqli, "INSERT INTO Food_requests (item, quantity, projname, category) VALUES(:FSRItem, :FSRQuantity , :name, 'food')");
                    oci_bind_by_name($stid, ':FSRItem', $FSRItem);
                    oci_bind_by_name($stid, ':FSRQuantity', $FSRQuantity);
                    oci_bind_by_name($stid, ':name', $name);

                    $r = oci_execute($stid);  // executes and commits
                    if (!$r) {
                        $error_msg .= '<p class="error">Error inserting Food into Food table.</p>';
                    }
                }
            }
        }

        if(isset($_POST['HSRDescription'], $_POST['HSRRole'])) {
            $HSRRole = $_POST['HSRRole'];
            $HSRDescription = $_POST['HSRDescription'];

            if($HSRRole != "" && $HSRDescription != "") {
                $stid = oci_parse($mysqli, "INSERT INTO Support_requests (description, category, percent_fulfilled, projname) VALUES(:HSRDescription, 'help', 0.0, :name)");
                oci_bind_by_name($stid, ':HSRDescription', $HSRDescription);
                oci_bind_by_name($stid, ':name', $name);

                $r = oci_execute($stid);  // executes and commits
                if (!$r) {
                    $error_msg .= '<p class="error">Error inserting Help into database.</p>';
                }else {
                    $stid = oci_parse($mysqli, "INSERT INTO Help_requests (role, projname, category) VALUES(:HSRRole, :name , 'help')");
                    oci_bind_by_name($stid, ':HSRRole', $HSRRole);
                    oci_bind_by_name($stid, ':name', $name);

                    $r = oci_execute($stid);  // executes and commits
                    if (!$r) {
                        $error_msg .= '<p class="error">Error inserting Help into Help table.</p>';
                    }
                }
            }
        }

        if(isset($_POST['MSRDescription'], $_POST['MSRAmount'], $_POST['all_or_nothing'])) {
            $MSRDescription = $_POST['MSRDescription'];
            $MSRAmount = $_POST['MSRAmount'];
            $all_or_nothing = $_POST['all_or_nothing'];

            $all_or_nothing_val = "0";
            if($all_or_nothing == "yes") $all_or_nothing_val = "1"; 

            if($MSRDescription != "" && $MSRAmount != "" && $all_or_nothing != "") {
                $stid = oci_parse($mysqli, "INSERT INTO Support_requests (description, category, percent_fulfilled, projname) VALUES(:MSRDescription, 'money', 0.0, :name)");
                oci_bind_by_name($stid, ':MSRDescription', $MSRDescription);
                oci_bind_by_name($stid, ':name', $name);

                $r = oci_execute($stid);  // executes and commits
                if (!$r) {
                    $error_msg .= '<p class="error">Error inserting Money into database.</p>';
                }else {
                    $stid = oci_parse($mysqli, "INSERT INTO Money_requests (amount, is_all_or_nothing, projname, category) VALUES(:MSRAmount , :all_or_nothing_val , :name , 'money')");
                    oci_bind_by_name($stid, ':MSRAmount', $MSRAmount);
                    oci_bind_by_name($stid, ':all_or_nothing_val', $all_or_nothing_val);
                    oci_bind_by_name($stid, ':name', $name);

                    $r = oci_execute($stid);  // executes and commits
                    if (!$r) {
                        $error_msg .= '<p class="error">Error inserting Money into Money table.</p>';
                    }
                }
            }
        }

        if(isset($_POST['OSRDescription'])) {
            $OSRDescription = $_POST['OSRDescription'];
            if($OSRDescription != "") {
                $stid = oci_parse($mysqli, "INSERT INTO Support_requests (description, category, percent_fulfilled, projname) VALUES(:OSRDescription, 'other', 0.0, :name)");
                oci_bind_by_name($stid, ':OSRDescription', $OSRDescription);
                oci_bind_by_name($stid, ':name', $name);

                $r = oci_execute($stid);  // executes and commits
                if (!$r) {
                    $error_msg .= '<p class="error">Error inserting Other into database.</p>';
                }
            }
        }

        $error_msg .= 'Link count: ' . $link_count;
        for($i = 0; $i <= $link_count; $i++) {
            $PLName = $_POST['PLName' . (string)$i];
            $PLURL = $_POST['PLURL' . (string)$i];

            $stid = oci_parse($mysqli, 'INSERT INTO Publicity_links (url, website_name, projname) VALUES(:PLURL, :PLName , :name  )');
            oci_bind_by_name($stid, ':PLURL', $PLURL);
            oci_bind_by_name($stid, ':PLName', $PLName);
            oci_bind_by_name($stid, ':name', $name);


            $r = oci_execute($stid);  // executes and commits
            if (!$r) {
                $error_msg .= '<p class="error">Error inserting Other into database.</p>';
            }
        }
    }
}
