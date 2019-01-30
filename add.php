<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");

$table=$_POST['table'];
$str=$_POST['str'];

$dtArray=array();

$query=mysqli_query($link,$str);
$query=mysqli_query($link,"SELECT * FROM ".$table."");

while ($array=mysqli_fetch_assoc($query)){
		$dtArray[]=$array;
}

echo json_encode($dtArray);

?>

