<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPG Characters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>RPG Characters</h1>
<div class="card-group">
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

$sql = "SELECT rpg_id, rpgName from RPGCharacter";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
   <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?=$row["rpgName"]?></h5>
      <p class="card-text"><ul>
<?php
    $section_sql = "select questDesc 
    from RPGCharacter c 
    JOIN RPGCharacterQuest cq 
    ON c.rpg_id = cq.rpg_id 
    JOIN RPGQuest q 
    ON q.quest_id = cq.quest_id 
    WHERE c.rpg_id =" . $row["rpg_id"];
    $section_result = $conn->query($section_sql);
    
    while($section_row = $section_result->fetch_assoc()) {
      echo "<li>" . $section_row["questDesc"] . "</li>";
    }
?>
      </ul></p>
  </div>
    </div>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </card-group>
<a class="btn btn-primary" href="index.php" role="button">Back to Home Page</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
