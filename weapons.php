<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RPG Weapons</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>


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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($_POST['saveType']) {
    case 'Add':
    $sqlAdd = "insert into RPGWeapon (weapon_name) value (?)";
    $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("s", $_POST['iName']);
    $stmtAdd->execute();
    echo '<div class="alert alert-success" role="alert">New weapon added.</div>';
    break;
    case 'Edit':
    $sqlEdit = "update RPGWeapon set weapon_name=? where weapon_id=?";
    $stmtEdit = $conn->prepare($sqlEdit);
    $stmtEdit->bind_param("si", $_POST['iName'], $_POST['iid']);
    $stmtEdit->execute();
    echo '<div class="alert alert-success" role="alert">Weapon edited.</div>';
    break;
    case 'Delete':
    $sqlDelete = "delete from RPGWeapon where weapon_id=?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("i", $_POST['iid']);
    $stmtDelete->execute();
    echo '<div class="alert alert-success" role="alert">Weapon deleted.</div>';
    break;
    }
    }
    ?>

    <h1> RPG Clothes</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT weapon_id, weapon_name from RPGWeapon";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            ?>

            <tr>
                <td><?=$row["weapon_id"]?></td>
                <td><?=$row["weapon_name"]?></td>
                <td>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editClothes<?=$row["weapon_id"]?>
                        ">
                        Edit
                    </button>
                    <div class="modal fade" id="editClothes<?=$row[" weapon_id"]?>
                        " data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editClothes<?=$row["weapon_id"]?>Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editClothes<?=$row["weapon_id"]?>Label">Edit Weapon</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                            <label for="editClothes<?=$row["weapon_id"]?>Name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="editClothes<?=$row[" weapon_id"]?>Name" aria-describedby="editClothes<?=$row["weapon_id"]?>Help" name="iName" value="<?=$row['weapon_name']?>">
                                            <div id="editClothes<?=$row[" weapon_id"]?>Help" class="form-text">Enter the weapon's name.</div>
                                        </div>
                                        <input type="hidden" name="iid" value="<?=$row['weapon_id']?>">
                                        <input type="hidden" name="saveType" value="Edit">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="iid" value="<?=$row["weapon_id"]?>" />
                        <input type="hidden" name="saveType" value="Delete">
                        <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
                    </form>
                </td>
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
    <br />
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClothes">
        Add New
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addClothes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addClothesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addClothesLabel">Add Weapon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="ClothesName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="ClothesName" aria-describedby="nameHelp" name="iName">
                            <div id="nameHelp" class="form-text">Enter the Weapon's name.</div>
                        </div>
                        <input type="hidden" name="saveType" value="Add">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <a class="btn btn-primary" href="index.php" role="button">Home</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
