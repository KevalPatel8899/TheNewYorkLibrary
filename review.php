<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Review</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>

<a href="reviews.php">View Reviews</a>

<h1>Create a Review</h1>

<form method="post" action="save-review.php">
    <fieldset>
        <label for="EmailAddress" class="col-md-1">EmailAddress: </label>
        <input name="EmailAddress" id="EmailAddress" required />
    </fieldset>
    <fieldset>
        <label for="rating" class="col-md-1">Rating: </label>
        <input name="rating" id="rating" required type="number" min="0" max="5" />
    </fieldset>
    <fieldset>
        <label for="comments" class="col-md-1">Comments: </label>
        <textarea name="comments" id="comments" required></textarea>
    </fieldset>
    <fieldset>
        <label for="Book" class="col-md-1">Books: </label>
        <select name="Book" id="Book">
            <option>-Select-</option>
            <?php
            // connect
            $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc900393482', 'gc900393482', 'OfSxHqw4iM');
            // set up query
            $sql = "SELECT * FROM profile ORDER BY name";
            $cmd = $db->prepare($sql);
            // fetch the results
            $cmd->execute();
            $NewYorkLibrary = $cmd->fetchAll();
            // loop through and create a new option tag for each type
            foreach ($NewYorkLibrary as $l) {
                echo "<option> {$l['name']} </option>";
            }
            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <button class="col-md-offset-1 btn btn-primary">Save</button>
</form>
</body>
</html>