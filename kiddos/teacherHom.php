<?php
session_start();
require_once('conn.php');

$sql = "SELECT * FROM child";
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['absent'])) {
        $childId = $_POST['child_id'];
    
        $updateSql = "UPDATE child SET absences = absences + 1 WHERE id = :childId";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute(['childId' => $childId]);
    
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update'])) {
    $childId = $_POST['child_id'];
    $mark = $_POST['mark'];

    $updateSql = "UPDATE child SET mark = :mark WHERE id = :childId";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute(['mark' => $mark, 'childId' => $childId]);

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Child Information</title>
  <link rel="stylesheet" type="text/css" href="css/tHome.css"/>
  <script>
        window.addEventListener('DOMContentLoaded', function() {
            var currentDate = new Date();
            var dayOfWeek = currentDate.getDay();
            var weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var currentDay = weekdays[dayOfWeek];
            var date = currentDate.getDate();
            var month = currentDate.getMonth() + 1; 
            var year = currentDate.getFullYear();          
            var formattedDate = currentDay + ', ' + month + '/' + date + '/' + year;
            var h1Element = document.getElementById('date');
            h1Element.innerHTML = formattedDate;
        });
    </script>
</head>
<body>
    <center>
    <h1 id="date"></h1>
  <table>
    <tr>
      <th>Child Name</th>
      <th>Last Name</th>
      <th>Mark</th>
      <th>Number of Absences</th>
      <th>Today presence</th>
    </tr>

    <?php foreach ($rows as $row): ?>
      <tr>
        <td><?php echo $row['child_name']; ?></td>
        <td><?php echo $row['child_last_name']; ?></td>
        <td>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="child_id" value="<?php echo $row['id']; ?>">
            <input type="text" name="mark" value="<?php echo $row['mark']; ?>">
            <input type="submit" name="update" value="Update">
          </form>
        </td>
        <td><?php echo $row['absences']; ?></td>
        <td>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="child_id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="absent" value="Absent">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>
  </center>
</body>
</html>
