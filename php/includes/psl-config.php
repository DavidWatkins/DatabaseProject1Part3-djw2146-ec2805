<?php
/**
 * These are the database login details
 */
define("HOST", "w4111b.cs.columbia.edu:1521/adb");     // The host you want to connect to.
define("USER", "djw2146");    // The database username.
define("PASSWORD", "4Fa98xkHVd2XmnfK");    // The database password.
define("DATABASE", "secure_login");    // The database name.

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

<?php
echo "hello";
ini_set('display_errors', 'On');
$db = "w4111b.cs.columbia.edu:1521/adb";
$conn = oci_connect("scott", "tiger", $db);

$stmt = oci_parse($conn, "select user from dual");
oci_execute($stmt, OCI_DEFAULT);
while ($res = oci_fetch_row($stmt))
{
    echo "User Name: ". $res[0] ;
}
oci_close($conn);
?>
