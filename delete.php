<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");

$name=$_POST['q1'];
$table=$_POST['table'];
$mode=$_POST['mode'];

if ($mode=="delete"){
	$query=mysqli_query($link,$name);
	$row = mysqli_fetch_row($query);
	$id=$row[0];
	$query=mysqli_query($link,"DELETE FROM ".$table." WHERE `Номер`=".$id);
} else {
	$query=mysqli_query($link,$mode);
	$row = mysqli_fetch_row($query);
	$id=$row[0];
	$str=$name.$id;
	$query=mysqli_query($link,$str);	
}

$dtArray=array();
$query=mysqli_query($link,"SELECT * FROM ".$table);

while ($array=mysqli_fetch_assoc($query)){
		$dtArray[]=$array;
}

echo json_encode($dtArray);

?>

