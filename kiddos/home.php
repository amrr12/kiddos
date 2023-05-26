<?php
require_once('conn.php');
session_start();
$email = $_SESSION['login_user'];

$sql = "SELECT id, child_name, child_last_name, birthDate, parent_name, parent_last_name, parent_email, parent_phone, mark, absences FROM child WHERE parent_email=:Login";
$req = $pdo->prepare($sql);
$req->execute([
  ':Login' => $email
]);
$rows = $req->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.html');
}


if (isset($_POST['update'])) {
    try {
        if (count($rows) > 0) {
            $row = $rows[0];
            $id = $row['id'];
            $sql = "UPDATE child SET child_name = :child_name, child_last_name = :child_last_name, parent_name = :parent_name, parent_last_name = :parent_last_name, parent_phone = :parent_phone, parent_email = :parent_email WHERE id = :id";
            $req = $pdo->prepare($sql);
            $updatedChildName = $_POST['child_name'];
            $updatedChildLastName = $_POST['child_last_name'];
            $updatedParentName = $_POST['parent_name'];
            $updatedParentLastName = $_POST['parent_last_name'];
            $updatedParentPhone = $_POST['parent_phone'];
            $updatedParentEmail = $_POST['parent_email'];
            $req->execute([
                ':id' => $id,
                ':child_name' => $updatedChildName,
                ':child_last_name' => $updatedChildLastName,
                ':parent_name' => $updatedParentName,
                ':parent_last_name' => $updatedParentLastName,
                ':parent_phone' => $updatedParentPhone,
                ':parent_email' => $updatedParentEmail
            ]);
            header('Location: home.php');
        }
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}

if (isset($_POST['delete'])) {
    try {
        if (count($rows) > 0) {
            $row = $rows[0];
            $id = $row['id'];
            $sql = "DELETE FROM child WHERE id = :id";
            $req = $pdo->prepare($sql);
            $req->execute([':id' => $id]);
            session_destroy();
            header('Location: index.html');
        }
    } catch (PDOException $e) {
        echo "Deletion failed: " . $e->getMessage();
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/sHome.css"/>
    <title>Home</title>
    <script>
        function unlock() {
            let inputs = document.querySelectorAll("input[type='text']");
            inputs.forEach(function(input) {
                input.disabled = false;
            });
            let update = document.getElementById("update");
            update.style.display = "inline-block";
            let unc = document.getElementById("unc");
            unc.style.display = "none";
        }
    </script>
</head>
<body>
    <center>
    <div class="container">
      <div class="img"></div>
      <br>
      <br>
      <form method="post">
        <table>
          <?php foreach ($rows as $row) : ?>
            <tr>
                <td>name:</td>
                <td class="td2"><input style="background:none; border:none" name="child_name" type="text" value="<?php echo $row['child_name']; ?>" <?php if (!isset($_POST['update'])) echo "disabled"; ?> /></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>last name:</td>
                <td class="td2"><input style="background:none; border:none" name="child_last_name" type="text" value="<?php echo $row['child_last_name']; ?>" <?php if (!isset($_POST['update'])) echo "disabled"; ?> /></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>birthdate:</td>
                <td><input style="background:none; border:none" type="date" value="<?php echo $row['birthDate']; ?>" disabled /></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>mark:</td>
                <td class="td2"><?php echo $row['mark']; ?></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>absences:</td>
                <td class="td2"><?php echo $row['absences']; ?></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>parent name:</td>
                <td class="td2"><input style="background:none; border:none" name="parent_name" type="text" value="<?php echo $row['parent_name']; ?>" <?php if (!isset($_POST['update'])) echo "disabled"; ?> /></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>parent last name:</td>
                <td class="td2"><input style="background:none; border:none" name="parent_last_name" type="text" value="<?php echo $row['parent_last_name']; ?>" <?php if (!isset($_POST['update'])) echo "disabled"; ?> /></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>parent email:</td>
                <td class="td2"><input style="background:none; border:none" name="parent_email" type="text" value="<?php echo $row['parent_email']; ?>" disabled /></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td>parent phone:</td>
                <td class="td2"><input style="background:none; border:none" name="parent_phone" type="text" value="<?php echo $row['parent_phone']; ?>" <?php if (!isset($_POST['update'])) echo "disabled"; ?> /></td>
            </tr>
            <tr><td><br></td></tr>
          <?php endforeach; ?>
        </table>
        <div class="btn-container">
        <button type="button" onclick="unlock()" id="unc" class="unc">Unlock</button>

        <a href="./kidsIQ/iqTest.html"><button type="button" onclick="" id="btn" class="btnIq">IQ Test</button></a>
        <input type="submit" value="update" name="update" style="display:none" id="update"/>
        <input type="submit" value="delete" name="delete" class="deletebtn"/> 
        <input type="submit" value="logout" name="logout" class="logoutbtn"/>
        </div>
      </form>
    </div>
    </center>    

   
</body>
</html>
