<?php
// initialize all variables
$name=null;
$address=null;
$phone=null;
$EmailAddress=null;
$Password=null;
$nation=null;
$nationID=null;



if(!empty($_GET['nationID']))
    $nationID=$_GET['nationID'];


// connect
$db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');


//set the query

$sql="select * from profile where nationID=:nationID";

$cmd=$db->prepare($sql);
$cmd->bindParam(':nationID', $nationID, PDO::PARAM_INT);
$cmd->execute();
$l=$cmd->fetch();

//define the variable
$name = $l['name'];
$nation=$l['nation'];
$type=$l['type'];
$image = $l['image'];

// disconnect

$db= null;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<a href="NewYorkLibrary-profile.php">View All Members</a>

<h1>Enter Your Favorute book</h1>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/custom.css">
<form method="post" action="Library-save.php">
    <fieldset>
        <label for="name" class="col-md-1">Name: </label>
        <input name="name" id="name" required value="<?php echo $name; ?>"/>
    </fieldset>
      <fieldset>
        <label for="nation" class="col-md-1">Nation: </label>
        <select name="nation"" id="nation" >
        <option><--Select--></option>
        <?php
        // connect
        $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');
        // set up query
        $sql = "SELECT * FROM nation ORDER BY nation ";
        $cmd = $db->prepare($sql);
        // fetch the results
        $cmd->execute();
        $types = $cmd->fetchAll();
        // loop through and create a new option tag for each type
        foreach ($types as $t) {
            if ($t['nation'] == $nationID) {
                echo "<option selected> {$t['nation']} </option>";
            }
            else {
                echo "<option> {$t['nation']} </option>";
            }
        }
        // disconnect
        $db = null;
        ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="type" class="col-md-1">Type: </label>
        <select name="type"" id="type" >
        <option><--Select--></option>
        <?php
        // connect
        $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');
        // set up query
        $sql = "SELECT * FROM type ORDER BY type ";
        $cmd = $db->prepare($sql);
        // fetch the results
        $cmd->execute();
        $types = $cmd->fetchAll();
        // loop through and create a new option tag for each type
        foreach ($types as $t) {
            if ($t['type'] == $nationID) {
                echo "<option selected> {$t['type']} </option>";
            }
            else {
                echo "<option> {$t['type']} </option>";
            }
        }
        // disconnect
        $db = null;
        ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="image" class="col-md-1">Image:</label>
        <input type="file" name="image" id="image" />
    </fieldset>
    <div class="col-md-offset-1">
        <?php
        if (isset($image)) {
            echo "<img src=\"image/$image\" alt=\"image\" />";
        }
        ?>
    </div>
    <button class="col-md-offset-1 btn btn-primary">Submit</button>
    <input type="hidden" name="nationID" id="nationID" value="<?php echo $nationID; ?>" />

</form>
</body>
</html>