<?php
session_start();

if(isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"]==true)){
    header("Location: index.php");
    exit;

}
/*
 * Nạp file  kết nối CSDL*/
include_once "config.php";

//Biến lưu trữ lỗi trong quá trình đăng nhập
$error = array();
/*xử lý đăng nhập*/

if (isset($_POST) && !empty($_POST)){

    if (!isset($_POST["username"]) ||empty($_POST["username"])){
       $error[] = " Chưa nhập username";
   }
      if (!isset($_POST["password"])||empty($_POST["password"])){
          $error[] = " Chưa nhập password";
}
      /*Nếu mảng error bị rỗng túc là không có lỗi đăng nhập*/
      if (is_array($error) && empty($error)){
           $username = $_POST["username"];

           $password = md5($_POST["password"]);

           $sqlLogin = "SELECT * FROM users WHERE username = ? AND password = ?";

           //Chuẩn bị cho phần SQL

          $stmt = $conection->prepare($sqlLogin);

          //Bind 3 biến vào trong câu SQL
          $stmt->bind_param("ss",$username,$password);
           $stmt->execute();
           $res = $stmt->get_result();

          $row = $res->fetch_array( MYSQLI_ASSOC);

          if (isset($row['id']) && ($row['id']>0)){
              $_SESSION["loggedin"] == true;
              $_SESSION["username"] = $row['username'];
              header("Location: index.php");
              exit;
          }else{
              $error[] = " Dữ liệu đăng nhập không đúng";
          }


      }
}
if (is_array($error)&&!empty($error)){
    $errors_string =implode("<br>",$error);
    echo "<div class='alert alert-danger'>";
    echo $errors_string;
    echo "<div>";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-12">
            <h1> Đăng ký người dùng</h1>
            <form name="register" action="" method="post">
                <div class="form-group">
                    <label >Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-check">
                   <p><a href="register.php">Đăng ký</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>