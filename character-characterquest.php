<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Character Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Character Quest</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Acceptance ID</th>
      <th>Offer</th>
      <th>Quest Name</th>
      <th>Class</th>
      <th>Character Name</th>
      <th>RPG ID</th>
    </tr>
  </thead>
  <tbody>
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
$iid = $_GET['id'];
//echo $iid;
$sql = "select cqAcceptance_id, cqOffer, questName, rpgClass, rpgName , rpg_id
from RPGCharacterQuest cq
join RPGCharacter ch 
on ch.rpg_id = cq.rpg_id 
join RPGQuest que
on que.quest_id = cq.quest_id 
where que.quest_id=?";
//echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["cqAcceptance_id"]?></td>
    <td><?=$row["cqOffer"]?></td>
    <td><?=$row["questName"]?></td>
    <td><?=$row["rpgClass"]?></td>
    <td><?=$row["rpgName"]?></td>
    <td><?=$row["rpg_id"]?></td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
  </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
