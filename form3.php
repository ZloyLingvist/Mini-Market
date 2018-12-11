<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"></script>
<script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>    
<link href="style.css" rel="stylesheet">

<title>Форма 3</title>
<style>
#mydiv1{
position: fixed; /* or absolute */
top: 15%;
left: 10%;
width: 600px;
height:300px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;	
border: 4px double black;	
}
</style>

</head>
<body>

<?php
$p=$_GET['field'];
?>

<div id="mydiv1"></div>
<button onclick="location.href='form2.php'">К Форме 2</button>
<script>

function create_textbox(arr,k){
	var st='<br><div id="nametable">'+k+'</div><br>'
	for (l=0;l<arr.length;l++){
	   st=st+arr[l]+' '+'<input maxlength="50" size="40" id="textfield'+l.toString()+'"><br>'
	}
	
	st=st+'<br><button onclick="insert()">Добавить</button>'
	document.getElementById("mydiv1").innerHTML=st	
}

function create_text(){
var k = '<?php echo $p;?>';
var arr1=['Номер','Название','Отдел','Цена(сум)','Производитель','Поставщик','Срок хранения (суток)','Количество (штук)'] //greeds
var arr2=['Номер','Название','Заведующий']//otdel
var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
var arr4=['Номер','Название','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
var arr6=['Номер','Товар','Количество','Поставщик']

if (k=='greeds'){
	create_textbox(arr1,k)
}

if (k=='otdel'){
	create_textbox(arr2,k)
}

if (k=='personal'){
	create_textbox(arr3,k)
}

if (k=='postavshik'){
	create_textbox(arr4,k)
}

if (k=='salesman'){
	create_textbox(arr5,k)
}

if (k=='sklad'){
	create_textbox(arr6,k)
}
}

create_text();

function insert_for_query(name,arr){
	var tmp2=''
	for (l=0;l<arr.length;l++){
		 if (l==arr.length-1){
			 tmp2=tmp2+'\''+document.getElementById('textfield'+l.toString()).value.toString()+'\''
		 } else {
	     tmp2=tmp2+'\''+document.getElementById('textfield'+l.toString()).value.toString()+'\''+','
		 }
		}
	
		$.ajax({ 
		url : "add.php",
		type : "POST",
		data:{Table:name, str: tmp2},
		dataType : "json",	
	});	
}

function insert(){
	var tmp2=''
	var arr1=['Номер','Название','Отдел','Цена(сум)','Производитель','Поставщик','Срок хранения (суток)','Количество (штук)'] //greeds
	var arr2=['Номер','Название','Заведующий']//otdel
	var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
	var arr4=['Номер','Название','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
	var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
	var arr6=['Номер','Товар','Количество','Поставщик']
	
	if (document.getElementById("nametable").innerHTML=="greeds"){
		insert_for_query("greeds",arr1)
	}
	
	if (document.getElementById("nametable").innerHTML=="otdel"){
		insert_for_query("otdel",arr2)
	}
	
	if (document.getElementById("nametable").innerHTML=="personal"){
		insert_for_query("personal",arr3)
	}
	
	if (document.getElementById("nametable").innerHTML=="postavshik"){
		insert_for_query("postavshik",arr4)
	}
	
	if (document.getElementById("nametable").innerHTML=="salesman"){
		insert_for_query("salesman",arr5)
	}
	
	if (document.getElementById("nametable").innerHTML=="sklad"){
		insert_for_query("sklad",arr5)
	}	
}


	
</script>
</body>
</html>