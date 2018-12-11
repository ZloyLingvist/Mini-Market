<?php
$link = mysqli_connect("localhost", "root", "");
mysqli_set_charset($link,"utf8");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_select_db($link,"mini-market");


$table=$_POST['Table'];
//$table="postavshik";
$str=$_POST['str'];
//$str='\'3\',\'dsd\',\'dsad\',\'sadasd\'';

if ($table=="greeds"){
	$query = "INSERT INTO greeds (`Номер`,`Название`, `Код Отдела`, `Цена(сум)`, `Производитель`, `Номер Поставщика`,`Срок хранения (суток)`,`Количество(штук)`) VALUES (".$str.")";
	$result=mysqli_query($link,$query);
}

if ($table=="otdel"){
	$query = "INSERT INTO otdel (`Номер`,`Название`) VALUES (".$str.")";
	$result=mysqli_query($link,$query);
}

if ($table=="personal"){
	$query = "INSERT INTO personal (`Номер`,`ФИО`, `Трудовой стаж (лет)`, `Должность`, `Зарплата (сум)`, `Возраст`) VALUES (".$str.")";
	$result=mysqli_query($link,$query);
}

if ($table=="postavshik"){
	$query = "INSERT INTO postavshik (`Номер`,`Название`, `Дата последней поставки (дней назад)`, `Дата следующей поставки (дней вперед)`) VALUES (".$str.")";
	echo($query);
	$result=mysqli_query($link,$query);
}

if ($table=="salesman"){
	$query = "INSERT INTO salesman (`Номер`,`Номер сотрудника`, `Код Отдела`, `Количество проданного товара за месяц (штук)`, `Прибыль за месяц`, `План по прибыли (сум)`) VALUES (".$str.")";
	$result=mysqli_query($link,$query);
}

if ($table=="sklad"){
	$query = "INSERT INTO sklad (`Номер`,`Код товара`, `Количество`, `Номер поставщика`) VALUES (".$str.")";
	$result=mysqli_query($link,$query);
}

$dtArray=array();
$query=mysqli_query($link,"SELECT * FROM ".$table."");

while ($array=mysqli_fetch_assoc($query)){
		$dtArray[]=$array;
}

echo json_encode($dtArray);

?>

