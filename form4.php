<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"></script>
<script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>    
<link href="style.css" rel="stylesheet">

<title>Форма 4</title>
<style>
#mydiv1{
position: fixed; /* or absolute */
top: 15%;
left: 10%;
width: 600px;
height:350px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;	
border: 4px double black;	
}

#mydiv3{
position: fixed; /* or absolute */
top: 15%;
left: 60%;
width: 600px;
height:350px;
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
<div id="mydiv3"></div>
<button onclick="location.href='form2.php'">К Форме 2</button>
<script>

var length=0;
var arr_t=0;
var table_name=0;

function create_textbox(arr,k){
	var st='<br><div id="nametable">'+k+'</div><br>'
	for (l=0;l<arr.length;l++){
	   if (arr[l].indexOf('(') + 1){
		   st=st+arr[l]+' '+'<input maxlength="5" size="5" id="textfield'+l.toString()+'"> '+'<input type="search" maxlength="10" size="1" list="character"id="r'+l.toString()+'"><datalist id="character"><option value="="></option><option value=">="></option>option value=">"></option>option value="=<"></option><option value="<"></option><option value="not ="></option></datalist>'+' <input maxlength="5" size="5" id="textfield_'+l.toString()+'"><br>'
	   } else {
	   st=st+arr[l]+' '+'<input maxlength="50" size="40" id="textfield'+l.toString()+'"><br>'
	   }
	}
	
	st=st+'<br><button onclick="search()">Ok</button>'
	document.getElementById("mydiv1").innerHTML=st	
}

function write(arr,tmp){
	var st1='<br><table border="1">'
	st1=st1+"<tr align='center'>"
			
	for (m=0;m<arr.length;m++){
		st1=st1+"<td style='width: 100px;'><strong>"+arr[m]+"</strong></td>"
	}
			
	st1=st1+'</tr>'
			
	for (m=0;m<tmp.length;m++){
			st1=st1+"<tr align='center'>"
				for (i=0;i<arr.length;i++){
					st1=st1+"<td style='width: 100px;'>"+tmp[m][arr[i]]+"</td>"
				}
		
			st1=st1+'</tr>'
	}
		
	document.getElementById('mydiv3').innerHTML=st1;	
}

function create_text(){
var k = '<?php echo $p;?>';
table_name=k;
var arr1=['Номер','Название','Отдел','Цена(сум)','Производитель','Поставщик','Срок хранения (суток)','Количество (штук)'] //greeds
var arr2=['Номер','Название','Заведующий']//otdel
var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
var arr4=['Номер','Название','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
var arr6=['Номер','Товар','Количество','Поставщик']

if (k=='greeds'){
	length=arr1.length;
	arr_t=arr1;
	create_textbox(arr1,k)
}

if (k=='otdel'){
	length=arr2.length;
	arr_t=arr2;
	create_textbox(arr2,k)
}

if (k=='personal'){
	length=arr3.length;
	arr_t=arr3;
	create_textbox(arr3,k)
}

if (k=='postavshik'){
	length=arr4.length;
	arr_t=arr4;
	create_textbox(arr4,k)
}

if (k=='salesman'){
	length=arr5.length;
	arr_t=arr5;
	create_textbox(arr5,k)
}

if (k=='sklad'){
	length=arr6.length;
	arr_t=arr6;
	create_textbox(arr6,k)
}
}

create_text();	

function search(){
var query='SELECT * FROM '+table_name+' WHERE '
for (l=0;l<arr_t.length;l++){
	   var a=document.getElementById('textfield'+l.toString()).value;
	   if (a==""){
		 continue;  
	   }
		
	   if (arr_t[l].indexOf('(') + 1){
		   var b=document.getElementById('r'+l.toString()).value;
		   var c=document.getElementById('textfield_'+l.toString()).value;
		   if (b=="="){
			    query=query+"`"+arr_t[l]+"` >= "+a+"  AND `"+arr_t[l]+"` <="+c+" "
		   }
		  
	   } else {
		if (a.length==1){
			query=query+"`"+arr_t[l]+"`"+" LIKE '"+a+"%' AND "
		}
	   }
	}
		
	$.ajax({ 
		url : "squery.php",
		type : "POST",
		data:{str: query},
		dataType : "json",	
		success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		write(arr_t,tmp)
		}
	});	
}

</script>
</body>
</html>