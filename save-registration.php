<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving your Registration</title>
</head>
<body>

<?php
// store form inputs in variables
$EmailAddress = $_POST['EmailAddress'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;
// validate inputs
if (empty($EmailAddress)) {
    echo 'Email is required<br />';
    $ok = false;
}
if (strlen($password) < 8) {
    echo 'Password is invalid<br />';
    $ok = false;
}
if ($password != $confirm) {
    echo 'Passwords do not match<br />';
    $ok = false;
}
if ($ok) {
    // hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // connect
    $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');

    // set up & execute the insert
    $sql = "INSERT INTO users (EmailAddress, password) VALUES (:EmailAddress, :password)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':EmailAddress', $EmailAddress, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 255);
    $cmd->execute();
    // disconnect
    $db = null;
    // redirect to login
    header('location:register.php');
}
?>

</body>
</html>