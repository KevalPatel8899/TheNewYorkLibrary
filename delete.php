<!Doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<BODY>
<?php
// Get the id from the database of the information
$nationID=$_GET['nationID'];

if(empty($nationID)) {
    header('location:NewYorkLibrary-profile.php');
}
// connect
$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');


//set the query to execute the sql command to delete the information
$sql = "DELETE FROM profile Where nationID =:nationID";
$cmd = $db->prepare($sql);
$cmd->bindPARAM('nationID',$nationID,PDO::PARAM_INT);
$cmd->execute();


//disconnect
$conn=null;

// rediract the update restaurats for the page
header('location:NewYorkLibrary-profile.php');


?>
</BODY>
</html>