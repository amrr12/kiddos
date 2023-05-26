<?php 
 include 'conn.php';
 $error = '';
 
 $cname_value = '';
 $clast_name_value = '';
 $cbirthDate = '';
 $cpass_value = '';
 $name = '';
 $plast_name_value = '';
 $pemail = '';
 $pphone = '';

 
 

 
 function verify(&$cname_value,&$clast_name_value,&$cbirthDate,&$cpass_value,$name,&$plast_name_value,&$pphone,&$pemail,&$error)
 {
  $v = true;
  if (empty($_POST['cname'])) {
    $error = "Child name is empty";
    $v = false;
    return $v;
  }else {
      $cname_value = $_POST['cname'];
  }

  if (empty($_POST['clastName'])){
    $error = "Child last name is empty";
    $v = false;
    return $v;
  }else {
    $clast_name_value = $_POST['clastName'];
  }
  if (empty($_POST['date'])){
    $error = "date is empty";
    $v = false;
    return $v;
  }else {
    $cbirthDate = $_POST['date'];
  }
  if (empty($_POST['password'])){
    $error = "password is empty";
    $v = false;
    return $v;
  }else {
    $cpass_value = $_POST['password'];
  }
  if (empty($_POST['name'])){
    $error = "parent name field is empty";
    $v = false;
    return $v;
  }else {
    $pname = $_POST['name'];
  }

  if (empty($_POST['plastName'])){
    $error = "parent last name field is empty";
    $v = false;
    return $v;
  }else {
    $plast_name_value = $_POST['plastName'];
  }

  if (empty($_POST['pemail'])){
    $error = "email field is empty";
    $v = false;
    return $v;
  }else {
    $pemail = $_POST['pemail'];
  }

  if (empty($_POST['pphone'])){
    $error = "phone field is empty";
    $v = false;
    return $v;
  }else {
    $pphone = $_POST['pphone'];
  }
  
  return $v; 
  
 }
 
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $test = verify($cname_value, $clast_name_value, $cbirthDate, $cpass_value, $name, $plast_name_value, $pphone, $pemail, $error);
    if ($test){
        $sql = "INSERT INTO child (child_name, child_last_name, birthDate, password, parent_name, parent_last_name, parent_email, parent_phone, absences, mark) VALUES (:childname, :childlastname, :birthdate, :password, :parentName, :parentLastName, :parentEmail, :parentPhone, :absences, :mark)";
        $req = $pdo->prepare($sql);
        $req->execute([
            ':childname' => $cname_value,
            ':childlastname' => $clast_name_value,
            ':birthdate' => $cbirthDate,
            ':password' => $cpass_value,
            ':parentName' => $name,
            ':parentLastName' => $plast_name_value,
            ':parentEmail' => $pemail,
            ':parentPhone' => $pphone,
            ':absences' => 0,
            ':mark' => 0
        ]);
    
        $errorDb = $req->errorInfo();
        if ($errorDb[0] != '00000') {
            throw new Exception("Error inserting data: " . $errorDb[2]);
        }
    
        
        header('Location: login.php');
        exit(); 
    }
  }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/registerStyle.css"/>
    <title>Register</title>
</head>
<body>

<section>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 div1">
           
                
                <form method="POST">
                    <fieldset>
                        <legend>
                            <h1>REGISTER</h1>
                        </legend>
                        <table>
                            <legend>Child Informations: </legend>
                            <br>
                            <tr>
                                <td>Name</td>
                                <td class="spacing"><input type="text" name="cname" placeholder="enter your child name" value="<?php echo $cname_value; ?>"  /></td>                
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>Last name</td>
                                <td class="spacing"><input type="text" name="clastName" placeholder="enter your child last name" value="<?php echo $clast_name_value; ?>"/></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>birth date </td>
                                <td class="spacing">
                                    <input type="date" name="date" value="<?php echo $cbirthDate; ?>" />
                                </td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>Password</td>
                                <td class="spacing"><input type="password" name="password" placeholder="enter your password" value="<?php echo $cpass_value; ?>"/></td>
                            </tr>
                            <tr><td><br></td></tr>
                        </table>
                        <br>
                        <br>
                        <br>
                        <br>
                        <table>
                            <legend>Parents Informations: </legend>
                            <br>
                            <tr>
                                <td>Name</td>
                                <td class="spacing"><input type="text" name="name"  placeholder="enter father/mother name" value="<?php echo $name; ?>"/></td>                
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>Last name</td>
                                <td class="spacing"><input name="plastName" type="text" placeholder="fathe/mother last name" value="<?php echo $plast_name_value; ?>" /></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>email</td>
                                <td class="spacing">
                                    <input type="email" name="pemail" placeholder="father/mother email" value="<?php echo $pemail; ?>"/>
                                </td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                                <td>Phone </td>
                                <td class="spacing">
                                    <input type="text" name="pphone" placeholder="father/mother phone number" value="<?php echo $pphone; ?>" />
                                </td>
                            </tr>
                        </table>
                        
                        <?php 
                           echo"<p style='color:red'> $error</p>";
                        ?> 
                        <br>
                <table>
                    <tr>
                        <td>
                            <input class="btn1" type="submit" value="REGISTER"/>
                        </td>
                        <td><p> </p></td>
                        <td>
                            <input class="btn2" type="reset" value="RESET"/>
                        </td>
                    </tr>
                </table>
                    </fieldset>  
                </form>
                
                
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 div2">
            <center>
                <p>
                   WELCOME <span>TO</span> <br><a href="./index.html" target="_blank"><h1>KIDDOS</h1></a>
                </p>
            </center>
        </div>

    </div>

</section>
    
</body>
</html>