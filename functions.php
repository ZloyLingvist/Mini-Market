<?php
$query=$_POST['param'];
$mode=$_POST['mode'];

$link = mysqli_connect("localhost", "root", "");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");
$result=mysqli_query($link,$query) or die("Error ".mysqli_error($link));

echo json_encode($result)

#function a($p){
 #echo('1');	
#}


?>