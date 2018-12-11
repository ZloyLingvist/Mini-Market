<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");

#$name=$_POST['name'];
#$id=$_POST['id'];

#$query = "DELETE FROM ".$name." WHERE Id=".$id;
#$result=mysqli_query($link,$query);
#$dtArray=array();

#while ($array=mysqli_fetch_assoc($query)){
		#$dtArray[]=$array;
#}

#echo json_encode($dtArray);

?>
