<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The NewYork Library</title>
</head>
<body>

<?php
$title = "The NewYork Library";
require('header.php');
if (isset($_SESSION['userId'])) {
    echo '<a href="NewYorkLibrary.php">Add a New Restaurant</a> ';
}
?>
<h1>Membership Information</h1>

<form method="get">
    <fieldset class="col-md-12 text-right">
        <label for="searchName">Search: </label>
        <input name="searchName" id="searchName" placeholder="Search By Name" />
        <select name="searchType" id="searchType">
            <option>-All-</option>
            <?php
            // connect
            $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');
            $sql = "SELECT * FROM nation ORDER BY nation";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $types = $cmd->fetchAll();
            foreach ($types as $t) {
                echo "<option>{$t['nation']}</option>";
            }
            ?>
        </select>
        <button class="btn btn-primary">Go</button>

    </fieldset>
</form>


<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/custom.css">
<a href="NewYorkLibrary.php">Include your books</a>
<?php
try {
    $sql = "SELECT * FROM profile";
    // search by name if the user is searching
    $searchName = null;
    $searchType = null;
    if (isset($_GET['searchName'])) {
        $searchName = $_GET['searchName'];
        $sql .= " WHERE name LIKE ?";
        // now check the type
        if ($_GET['searchType'] != "-All-") {
            $searchType = $_GET['searchType'];
            $sql .= " AND nation= ?";
        }
    }
    // execute & store the result
    $cmd = $db->prepare($sql);
    if (isset($searchName)) {
        $words[0] = "%$searchName%";
        if (isset($searchType)) {
            $words[1] = $searchType;
        }
        $cmd->execute($words);
        if ($searchName == "") {
            $searchName = "All";
        }
        if ($searchType == "") {
            $searchType = "All";
        }
        echo "<h3>You searched: $searchName / $searchType</h3>";
    }
    else {
        $cmd->execute();
    }
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
         <td> {$l['type']}</td>";}




     if (isset($_SESSION['userId'])) {
            echo "<td><a href=\"NewYorkLibrary.php?nationID={$l['nationID']}\">Edit</a> | 
                <a href=\"delete.php?nationID={$l['nationID']}\" 
                class=\"text-danger confirmation\">Delete</a></td>";
        }
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
