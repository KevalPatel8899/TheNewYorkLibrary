<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
// Connect to the database to save all details to make profile
$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');
$name = $_POST['name'];
$type=$_POST['type'];
$nation=$_POST['nation'];
$nationID=$_POST['nationID'];


$ok = true;
// Validation For each input
if (empty($name)) {
    echo "Name is Required.<br />";
    $ok = false;
}
if ($ok) {
// Set the exicution commande


    if (empty($nationId)) {
        $sql = "INSERT INTO profile (name ,nation,type ) 
    VALUES (:name, :nation, :type)";
    }
    else {
        $sql = "UPDATE profile SET name = :name,nation=:nation,type=:type WHERE nationID = :nationId";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 60);
    $cmd->bindParam(':nation',$nation,PDO::PARAM_STR, 50);
    $cmd->bindParam(':type',$type,PDO::PARAM_STR, 50);

    $cmd->execute();


    if(!empty($nationID)){
        $cmd->bindParam('nationID',$nationID,PDO::PARAM_INT);
    }
    $cmd->execute();


    // disconnect
    $db = null;


header('location:NewYorkLibrary-profile.php');

}
?>

</body>
</html>