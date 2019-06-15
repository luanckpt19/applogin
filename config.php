<?php

/*Khai báo các hằng số kết nối đến CSDL*/
define("DB_SERVER","localhost");
define("DB_SERVER_USERNAME","root");
define("DB_SERVER_PASSWORD","");
define("DB_SERVER_NAME","demoapplogin");

/*kết nối đến CSDL*/
$conection = mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_SERVER_NAME);

/* Kiểm tra xem kết nối đến CSDL có thành công không*/
if($conection==false){
    die("ERROR không thể kết nối đến CSDL" .mysqli_connect_error());
}
?>