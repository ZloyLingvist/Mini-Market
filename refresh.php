<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");
//$name=$_POST['name'];
$dtArray=array();
//if ($name=="greeds"){
$str="SELECT 
g.`Номер`,g.`Товар`,o.`Отдел`,g.`Цена(сум)`,g.`Производитель`,p.`Поставщик`,g.`Срок хранения (суток)`,g.`Количество(штук)` 
FROM (greeds g LEFT JOIN otdel o ON g.`Код Отдела`=o.`Номер`) LEFT JOIN postavshik p ON g.`Поставщик`=p.`Номер` ";
$query=mysqli_query($link,$str);
//} else {
	//$query=mysqli_query($link,"SELECT * FROM ".$name."");
//}


//SELECT g.`Название`, o.`Название`,p.`Название` FROM (greeds g
       //INNER JOIN otdel o ON g.`Код Отдела`=o.`Номер`) INNER JOIN postavshik p ON g.`Номер поставщика`=p.`Номер`
 
while ($array=mysqli_fetch_assoc($query)){
		$dtArray[]=$array;
}

echo json_encode($dtArray);

?>