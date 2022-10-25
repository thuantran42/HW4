<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Character's Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Character's Quest</h1>
<?php
$servername = "localhost";
$username = "traeoucr_homework3User";
$password = "mysqltt1024332";
$dbname = "traeoucr_homework4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from RPGCharacterQuest where cqAcceptance_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="characterquest-edit-save.php">
  <div class="mb-3">
    <label for="offerAmount" class="form-label">Offer Amount</label>
    <input type="text" class="form-control" id="offerAmount" aria-describedby="nameHelp" name="oAmount" value="<?=$row['cqOffer']?>">
    <div id="nameHelp" class="form-text">Enter the offer amount.</div>
  </div>
  <div class="mb-3">
  <label for="characterList" class="form-label">Instructor</label>
<select class="form-select" aria-label="Select RPGCharacter" id="characterList" name="iid">
<?php
    $instructorSql = "select * from RPGCharacter 
                      order by rpgName";
    $instructorResult = $conn->query($instructorSql);
    while($instructorRow = $instructorResult->fetch_assoc()) {
      if ($instructorRow['rpg_id'] == $row['rpg_id']) {
        $selText = " selected";
      } else {
        $selText = "";
      }
?>
  <option value="<?=$instructorRow['rpg_id']?>"<?=$selText?>><?=$instructorRow['rpgName']?></option>
<?php
    }
?>
</select>
  </div>
  <input type="hidden" name="id" value="<?=$row['cqAcceptance_id']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<a class="btn btn-primary" href="index.php" role="button">Home</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
