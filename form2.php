<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"></script>
<script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>    
<link href="style2.css" rel="stylesheet">
<style>
#mydiv1{
position: fixed; /* or absolute */
top: 15%;
left: 10%;
width: 200px;
height: 350px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;	
border: 4px double black;	
}

#mydiv2{
position: fixed; /* or absolute */
top: 30%;
left: 12%;
width: 150px;
height:150px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;	
}


#mydiv5{
position: fixed; /* or absolute */
top: 15%;
left: 30%;
width: 300px;
height:500px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 18px;	
border: 4px double black;			
}

#mydiv3{
position: fixed; /* or absolute */
top: 15%;
left: 55%;
background:white;	
width: 680px;
height:480px;
}

#mydiv4{
position: fixed; /* or absolute */
top: 85%;
left: 55%;
background:white;	
width: 400px;
height:50px;
}

</style>
<title>Форма 2</title>
</head>
<body>

<div id="mydiv1"><br>Работа с таблицей <br><div id="mydiv2" height="30px">

<?php
include("db.php");
$query="SHOW TABLES";
$result=mysqli_query($link,$query) or die("Error ".mysqli_error($link));

$k=0;
while($table=mysqli_fetch_array($result)){
	if ($k==0){
	echo ('<div style="color: blue" id="'.$k.'" onclick="newtable('.$k.')">'.$table[0].'</div><br>');
	} else {
		echo ('<div id="'.$k.'" onclick="newtable('.$k.')">'.$table[0].'</div><br>');
	}
	
	$k=$k+1;
}

mysqli_close($link);

?>

</div></div>
<div id="mydiv3">Текущая таблица <br></div>
<div id="mydiv4"><br>
<button name="Ввод" onclick="transfer()" id="vvod">Ввод</button>
<button value="Добавить" onclick="transfer()" id="dob">Добавить</button>
<button name="Удалить" onclick="delet()" id="del">Удалить</button>
<button value="Изменить" onclick="change()" id="ch">Изменить</button>
<button value="Сохранить" onclick="save()" id="sv">Сохранить</button>
<button value="Поиск" onclick="tosearch()" id="s">Поиск</button></div>
<div id="mydiv5">Текущая таблица <br></div>
<script>

function transfer(){ //при наличии уже существующих строк
//// При нажатие имени таблицы, оно подсвечивается синим. 
//// Если нажата кнопка "Добавить", то текущее "синее" название отправляется на добавление

var m=['0','1','2','3','4','5'];

for (l=0;l<m.length;l++){
	var color=document.getElementById(m[l]).style.color;
	if (color=="blue"){
		var table_name=document.getElementById(m[l]).innerHTML;
		break
	}	
}

 location.href='form3.php?field='+table_name
}


function showtable(arr,tmp){
/// arr-массив с названиями полей текущей таблицы
/// tmp-выводимые данные
var i;
var st1='<br><table border="1" style="border-collapse: collapse">'
st1=st1+"<tr align='center'>"

///// Названия полей ////
for (m=0;m<arr.length;m++){
	st1=st1+"<td style='width: 100px;'><strong>"+arr[m]+"</strong></td>"
}
			
st1=st1+'</tr>'

if (tmp.length==0){
	document.getElementById('sv').style.visibility="hidden"
	document.getElementById('ch').style.visibility="hidden"
	document.getElementById('del').style.visibility="hidden"
	document.getElementById('dob').style.visibility="hidden"
	document.getElementById('vvod').style.visibility="visible"
} else{
	document.getElementById('vvod').style.visibility="hidden"
	document.getElementById('dob').style.visibility="visible"
	document.getElementById('sv').style.visibility="visible"
	document.getElementById('ch').style.visibility="visible"
	document.getElementById('del').style.visibility="visible"
	document.getElementById('dob').style.visibility="visible"
}
		
/// При клике на строку вызываем функцию ukaz		
for (m=0;m<tmp.length;m++){
		st1=st1+"<tr align='center' id='"+'t'+m.toString()+"' onclick='ukaz("+m.toString()+','+tmp.length.toString()+")'>"
		for (i=0;i<arr.length;i++){
			st1=st1+"<td id='tabled_"+m.toString()+i.toString()+"' style='width: 100px;'>"+tmp[m][arr[i]]+"</td>"
		}
		
		st1=st1+'</tr>'
}

document.getElementById('mydiv3').innerHTML=st1;

////////////////////////////////////////////////////////
}

function showqueries(arr,k){
	var st=''
	st='<br>Запросы<br><br>'
	for (l=0;l<arr.length;l++){
	   st=st+arr[l]+' '+'<input maxlength="20" size="20" id="textfield_'+l.toString()+'"><br><br>'
	}
	
	st=st+'<br><button onclick="ok('+k.toString()+')">Ok</button> <button onclick="newtable('+k.toString()+')">Назад</button>'
	document.getElementById("mydiv5").innerHTML=st
}


function newtable(k){
 var arr1=['Номер','Товар','Отдел','Цена(сум)','Производитель','Поставщик','Срок хранения (суток)','Количество (штук)'] //greeds
 var arr2=['Номер','Отдел','Заведующий']//otdel
 var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
 var arr4=['Номер','Поставщик','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
 var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
 var arr6=['Номер','Товар','Количество','Поставщик']//sklad
 var m=['0','1','2','3','4','5'];
 
 for (l=0;l<m.length;l++){
	document.getElementById(m[l]).style.color="black"
 }

 document.getElementById(k).style.color="blue"
 
 if (k=='0'){
   	 str='greeds';
 }
 
 if (k=='1'){
   	 str='otdel';
 }
 
 if (k=='2'){
   str='personal'	 
 }
 
 if (k=='3'){
   str='postavshik'	 
 }
 
 if (k=='4'){
   str='salesman'	 
 }
 
 if (k=='5'){
   str='sklad'	 
 }
 
 $.ajax ({
	type:"POST",
	url : "refresh.php",
	data : { name: str},
	dataType : "json",	
	
	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		
		console.log(data)
		
		if (k==0){
			showqueries(arr1,k)
			showtable(arr1,tmp)
		}
		
		if (k==1){
			showqueries(arr2,k)
			showtable(arr2,tmp)
		}
		
		if (k==2){
			showqueries(arr3,k)
			showtable(arr3,tmp)
		}
		
		if (k==3){
			showqueries(arr4,k)
			showtable(arr4,tmp)
		}
		
		if (k==4){
			showqueries(arr5,k)
			showtable(arr5,tmp)
		}
		
		if (k==5){
			showqueries(arr6,k)
			showtable(arr6,tmp)
		}
	}
	});
}

function ukaz(id,dlina){
	/// текущая строка черная, остальные белые
	for (m=0;m<dlina;m++){
		if (id==m.toString()){
			st='t'+id.toString()
			document.getElementById(st).style.border="solid"
			
	
		} else {
			st='t'+m.toString()
			document.getElementById(st).style.border=""
		}	
	}
}

function give_tablename_and_id(m){
	var arr1=['Номер','Название товара','Код Отдела','Цена(сум)','Производитель','Номер Поставщика','Срок хранения (суток)','Количество(штук)'] //greeds
	var arr2=['Номер','Название отдела','Заведующий']//otdel
	var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
	var arr4=['Номер','Название поставщика','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
	var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
	var arr6=['Номер','Код Товара','Количество','Номер Поставщика']//sklad
	var m=['0','1','2','3','4','5'];
	var ans=[]
	var arr=[]
	
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			var st=document.getElementById(m[l]).innerHTML;
		
			if (st=='greeds'){
				arr=arr1
			}
			
			if (st=='otdel'){
				arr=arr2
			}
			
			if (st=='personal'){
				arr=arr3
			}
			
			if (st=='postavshik'){
				arr=arr4
			}
			
			if (st=='salesman'){
				arr=arr5
			}
			
			if (st=='sklad'){
				arr=arr6
			}
			
			ans.push(st)
			break
		}	
	}
	
	for (l=0;l<arr.length;l++){
		var color=document.getElementById('t'+l.toString()).style.border;
		if (color=="solid"){
			var st2=l+1
			ans.push(st2)
			break
		}	
	}

	return ans
}

function delet(){
	var arr1=['Номер','Название товара','Отдел','Цена(сум)','Производитель','Поставщик','Срок хранения (суток)','Количество (штук)'] //greeds
	var arr2=['Номер','Название отдела','Заведующий']//otdel
	var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
	var arr4=['Номер','Название поставщика','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
	var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
	var arr6=['Номер','Товар','Количество','Поставщик']//sklad
	var m=['0','1','2','3','4','5'];
	var ans=[]
	
	ans=give_tablename_and_id(m)
	
	y=prompt('Удалить: y/n')
	
	if (y!="y"){
		return 0
	}

	var id=document.getElementById('tabled_'+(parseInt(ans[1])-1).toString()+'0').innerHTML
	
	$.ajax ({
		type:"POST",
		url : "delete.php",
		data : { name: ans[0],id:id},
		dataType : "json",	

	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		
		if (ans[0]=="greeds"){
			showtable(arr1,tmp)
		}
		if (ans[0]=="otdel"){
			showtable(arr2,tmp)
		}
		if (ans[0]=="personal"){
			showtable(arr3,tmp)
		}
		if (ans[0]=="postavshik"){
			showtable(arr4,tmp)
		}
		
		if (ans[0]=="salesman"){
			showtable(arr5,tmp)
		}
		
		if (ans[0]=="sklad"){
			showtable(arr6,tmp)
		}
		
	},
	
	});
}	


function change(){
	var m=['0','1','2','3','4','5'];
	var st1=''
	
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			var st=document.getElementById(m[l]).innerHTML;
			break
		}	
	}
	
	var tdItems = document.getElementsByTagName("td");
	for (var i = 0; i < tdItems.length; i++){
		tdItems[i].addEventListener('contextmenu', tdClick,false)
	}
}
	
function tdClick(e) {
	event = event || window.event;
	event.preventDefault ? event.preventDefault() : event.returnValue = false;

	var $this = $(this);
	
    var $input = $('<input>', {
        value: e.target.innerHTML,
        type: 'text',
        focusout: function() {
           $this.text(this.value);
		   ss=$(this).id
        },
        contextmenu: function(e) {
           $input.blur();
        }
    }).appendTo( $this.empty() ).focus();
};

function save(){
 var arr1=['Номер','Название товара','Код Отдела','Цена(сум)','Производитель','Номер Поставщика','Срок хранения (суток)','Количество(штук)'] //greeds
 var arr2=['Номер','Название отдела','Заведующий']//otdel
 var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
 var arr4=['Номер','Название поставщика','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
 var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
 var arr6=['Номер','Код Товара','Количество','Номер Поставщика']//sklad
 var m=['0','1','2','3','4','5'];
 var ans=[]
 var arr=[]
 ans=give_tablename_and_id(m)
 
 if (ans[0]=="greeds"){
	arr=arr1
 }
 
 if (ans[0]=="otdel"){
	arr=arr2
 }
 
 if (ans[0]=="personal"){
	arr=arr3
 }
 
 if (ans[0]=="postavshik"){
	arr=arr4
 }
 
 if (ans[0]=="salesman"){
	arr=arr5
 }
 
 if (ans[0]=="sklad"){
	arr=arr6
 }

 var mystr=''
 
 
	for(l=0;l<arr.length;l++){
		if (l==arr.length-1){
		mystr=mystr+'`'+arr[l]+'`= \''+document.getElementById('tabled_'+(ans[1]-1).toString()+(l).toString()).innerHTML+'\''
		} else {
			mystr=mystr+'`'+arr[l]+'`= \''+document.getElementById('tabled_'+(ans[1]-1).toString()+(l).toString()).innerHTML+'\', '
		}
	}
	
	$.ajax ({
	type:"POST",
	url : "update.php",
	data : { name:ans[0],id:ans[1],str:mystr},
	dataType : "json",	
	
	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		if (ans[1]==0){
			showqueries(arr1,k)
			showtable(arr1,tmp)
		}
		
		if (ans[1]==1){
			showqueries(arr2,k)
			showtable(arr2,tmp)
		}
		
		if (ans[1]==2){
			showqueries(arr3,k)
			showtable(arr3,tmp)
		}
		
		if (ans[1]==3){
			showqueries(arr4,k)
			showtable(arr4,tmp)
		}
		
		if (ans[1]==4){
			showqueries(arr5,k)
			showtable(arr5,tmp)
		}
		
		if (ans[1]==5){
			showqueries(arr6,k)
			showtable(arr6,tmp)
		}
		
	},
		
	
	});
}	


function write(arr,tmp,check_arr){
	var st1='<br><table border="1">'
	st1=st1+"<tr align='center'>"
			
	for (m=0;m<arr.length;m++){
		if (check_arr[m]==0){
			continue;	
		}
			
		st1=st1+"<td style='width: 100px;'><strong>"+arr[m]+"</strong></td>"
	}
			
	st1=st1+'</tr>'
			
	for (m=0;m<tmp.length;m++){
			st1=st1+"<tr align='center'>"
				for (i=0;i<arr.length;i++){
					if (tmp[m][arr[i]]==undefined){
						continue;	
					}
					st1=st1+"<td style='width: 100px;'>"+tmp[m][arr[i]]+"</td>"
				}
		
			st1=st1+'</tr>'
	}
		
	document.getElementById('mydiv3').innerHTML=st1;	
}

function give(arr){
	var ans=[]
	var arr_u=[]
	var check_arr=[]
	var e=0
	var mystr=''
	var first=0;
		for (l=0;l<arr.length;l++){
			var p=document.getElementById("textfield_"+l.toString()).value
			if (first==0 && p.length!=""){ //начало условия без and
				mystr=mystr+"`"+arr[l]+"`"
				arr_u.push("`"+arr[l]+"`= "+"'"+p+"'")
				check_arr.push(1)
				first=1;
				continue
			}
				
			if (first==1 && p.length!=""){
				arr_u.push(" AND `"+arr[l]+"`= "+"'"+p+"'")
				mystr=mystr+",`"+arr[l]+"`"
				check_arr.push(1)
			}
			
			if (p==""){
				if (l==0 || l==1){
					mystr=mystr+"`"+arr[l]+"`,"
					check_arr.push(1)
				}
				else {
				check_arr.push(0)
				}
			}
		}
			
	ans.push(mystr)
	ans.push(arr_u)
	ans.push(check_arr)
	return ans
}


function ok(m){
	var name="greeds"
	var arr1=['Номер','Товар','Отдел','Цена(сум)','Производитель','Поставщик','Срок хранения (суток)','Количество (штук)'] //greeds
	var arr2=['Номер','Отдел','Заведующий']//otdel
	var arr3=['Номер','ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст'] //personal
	var arr4=['Номер','Поставщик','Дата последней поставки (дней назад)','Дата следующей поставки (дней вперед)'] //postavshik
	var arr5=['Номер','Сотрудник','Отдел','Количество проданного товара за месяц (штук)','План по прибыли (сум)'] //salesman
	var arr6=['Номер','Товар','Количество','Поставщик']//sklad
	
	var m=['0','1','2','3','4','5'];
	var ans=[]

	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			m=l
			break
		}	
	}
	
	if (m==0){
		name="greeds"
		ans=give(arr1)
	}
	
	
	if (m==1){
		name="otdel"
		ans=give(arr2)
	}
	
	if (m==2){
		name="personal"
		ans=give(arr3)
	}
	
	if (m==3){
		name="postavshik"
		ans=give(arr4)
	}
	
	if (m==4){
		name="salesman"
		ans=give(arr5)
	}
	
	if (m==5){
		name="sklad"
		ans=give(arr6)
	}
	
	var st="SELECT "+ans[0]+" FROM "+name+" WHERE ";
	for (l=0;l<ans[1].length;l++){
		st=st+ans[1][l]
	}
	
	console.log(st)
	$.ajax ({
	type:"POST",
	url : "qr.php",
	data : {str:st},
	dataType : "json",	

	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		var i;
		var k=m
		
		if (k==0){
			write(arr1,tmp,ans[2])
		}
		
		if (k==1){
			write(arr2,tmp,ans[2])
		}
		
		if (k==2){
			write(arr3,tmp,ans[2])
		}
	
		if (k==3){
			write(arr4,tmp,ans[2])
		}
	
		if (k==4){
			write(arr5,tmp,ans[2])
		}
		
		if (k==5){
			write(arr6,tmp,ans[2])
		}
	}
	});
	
}	

function tosearch(){
var m=['0','1','2','3','4','5'];

for (l=0;l<m.length;l++){
	var color=document.getElementById(m[l]).style.color;
	if (color=="blue"){
		var table_name=document.getElementById(m[l]).innerHTML;
		break
	}	
}

 location.href='form4.php?field='+table_name
}
	
window.onload = function() {
	newtable('0')
};



</script>
</body>
</html>