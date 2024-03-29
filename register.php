<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php
include_once "config.php";
if (isset($_POST) && !empty($_POST)){
  $error = array();
  if (!isset($_POST["username"]) || empty($_POST["username"])){

      $error[] = "username không hợp lệ";
  }
    if (!isset($_POST["password"]) || empty($_POST["password"])){

        $error[] = "password không hợp lệ";
    }
    if (!isset($_POST["confirm_password"]) || empty($_POST["confirm_password"])){

        $error[] = "confirm_password không hợp lệ";
    }
    if($_POST["confirm_password"] != $_POST["password"]){
        $error[] = "confirm password khác password";

    }
    if(empty($error)){
        /*Nếu không có lỗi thì thực thi câu lệnh insert vào CSDL*/

        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $created_at = date("Y-m-d H:i:s");
        $sqlInsert = "INSERT INTO users (username,password,created_at) VALUE (?,?,?)";
        // Chuẩn bị cho phần SQL
        $stmt = $conection->prepare($sqlInsert);
        $stmt->bind_param("sss", $username, $password, $created_at);

        $stmt->execute();

        $stmt->close();
        echo "<div class='alert alert-success'>";
        echo "Đăng ký người dùng mới thành công rồi nhé ^^ . Còn chờ gì nữa <a href='login.php'>Đăng nhập</a> luôn đi nào ";
        echo "<div>";
    }else{
        $errors_tring =implode("<br>",$error);
        echo "<div class='alert alert-danger'>";
        echo $errors_tring;
        echo "<div>";
    }
}
?>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-12">
            <form name="login" action="" method="post">
                <div class="form-group">
                    <label >Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label >Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="form-check">
                    <p><a href="register.php"></a>Đăng Ký</p>
                </div>
                <button type="submit" class="btn btn-primary">Đăng Ký</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>