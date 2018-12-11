<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");

$name=$_POST['name'];
$id=$_POST['id'];

$query = "DELETE FROM ".$name." WHERE `Номер`=".$id;
$result=mysqli_query($link,$query);

$query="SET @num := 0";
$result=mysqli_query($link,$query);

$query="UPDATE ".$name." SET `Номер` = @num := (@num+1)";
$result=mysqli_query($link,$query);

$query="ALTER TABLE ".$name." AUTO_INCREMENT = 1;";
$result=mysqli_query($link,$query);

$dtArray=array();
$query=mysqli_query($link,"SELECT * FROM ".$name);

while ($array=mysqli_fetch_assoc($query)){
		$dtArray[]=$array;
}

echo json_encode($dtArray);

?>

