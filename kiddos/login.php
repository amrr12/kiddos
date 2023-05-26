<?php 
session_start();
require_once('conn.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email_value = $_POST['pemail'];
  $password_value = $_POST['password'];
  if (($email_value == "teacher@gmail.com") && ($password_value == "teacher11")) {
    header('Location: teacherHom.php');
  }

  $sql = "SELECT * FROM child WHERE parent_email=:Login AND password=:Password";
  $req = $pdo->prepare($sql);
  $req->execute([
    ':Login' => $email_value,
    ':Password' => $password_value
]);
  $count = $req->rowCount();
  if($count > 0) {
    $_SESSION['login_user'] = $email_value;
    header('Location: home.php');
  } else {
    $error = "Login or password incorrect!";
  }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css"/>
    <title>Login</title>
</head>
<body>
      <div class="login-container">
        <div class="half-circle">
            <center>
                <span class="kiddos">KIDDOS</span>
            </center>
        </div>
        <center>
        <br>    
        <form class="login-form" method="POST">
          <p class="login">LOGIN</p>
          <br>
          <div class="input-group">
            <input type="email" id="email" name="pemail" placeholder="Please enter your email" class="inputs" value="<?php echo $email_value; ?>">
          </div>
          <br>
          <br>
          <div class="input-group">
          <input type="password" id="password" name="password" placeholder="Please enter your password" class="inputs" value="<?php echo $password_value; ?>">
          </div>
          <?php echo "<p style='color:red'>$error</p>"?>
          <br>
          <br>
          <input type="submit" class="btn1" value="Login"/>
          <input type="reset" value="reset" class="btn2"/> 
        </form>
    </center>
      </div>
    </body>
    </html>
    
</body>
</html>