<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The NewYork Library</title>
</head>
<body>
<h1>Information for the books</h1>

<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/custom.css">
<a href="NewYorkLibrary.php">Include your books</a>
<?php
try {
    require('header.php');

// connect to the database
    $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');

// sett the query
    $sql = "SELECT * FROM profile";

//exicution and run the command

    $cmd = $db->prepare($sql);
    $cmd->execute();
    $NewYorkLibrary = $cmd->fetchAll();

//set the table for the Profile table
    echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>nation</th><th>Type</th><th>Action</th></thead>';

    if(isset($_SESSION['userID'])){
        echo '<th>Action</th>';
    }


//loop through the data  and show that data on Profile table on each new row
    foreach ($NewYorkLibrary as $l) {
        echo "<tr><td>{$l['name']}</td>           
        <td> {$l['nation']} </td>
         <td> {$l['type']}</td>";




     if (isset($_SESSION['userId'])) {
            echo "<td><a href=\"NewYorkLibrary.php?nationID={$l['nationID']}\">Edit</a> | 
                <a href=\"delete.php?nationID={$l['nationID']}\" 
                class=\"text-danger confirmation\">Delete</a></td>";
        }}
// close the table
    echo '</table>';

// disconnect
    $db = null;

}
catch (Exception $e) {
    // send
    mail('200393482@student.georgianc.on.ca', 'The NewYork Library', $e);
    // show generic error page
    header('location:error.php');
}
?>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>
