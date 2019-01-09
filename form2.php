<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"></script>
<script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>    
<link href="style2.css" rel="stylesheet">
<style>
#mydiv1{
position: fixed; /* or absolute */
top: 25%;
left: 90%;
width: 200px;
height: 370px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;	
border: 1px solid black;		
}

#mydiv2{
position: fixed; /* or absolute */
top: 37%;
left: 92%;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;
	
}

#mydiv9{
position: fixed; /* or absolute */
top: 39%;
left: 100%;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 20px;	
}

#mydiv5{
position: fixed; /* or absolute */
top: 30%;
left: 11%;
width: 280px;
height: 370px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 16px;	
overflow-y: scroll;		
}

#mydiv8{
position: fixed; /* or absolute */
top: 15%;
left: 10%;
width: 300px;
height:500px;
margin: -50px 0 0 -100px;
background: white;
text-align: center;
font-family: 'Playfair Display SC', serif;
font-size: 18px;	
border: 1px solid black;			
}


#mydiv3{
position: fixed; /* or absolute */
top: 15%;
left: 35%;
background:white;	
width: 700px;
height:500px;
border: 1px solid black;
overflow-y: scroll;
}

#mydiv4{
position: fixed; /* or absolute */
top: 85%;
left: 30%;
background:white;	
width: 650px;
height:50px;
}

</style>
<title>Форма 2</title>
</head>
<body>

<div id="mydiv1"><br>Работа с таблицей <br><div id="mydiv2">
</div><div id="mydiv9"></div>

<div id="mydiv3">Текущая таблица <br></div>
<div id="mydiv4"><br>
<button name="Ввод" onclick="transfer()" id="vvod">Ввод</button>
<button value="Добавить" onclick="transfer()" id="dob">Добавить</button>
<button name="Удалить" onclick="delet()" id="del">Удалить</button>
<button value="Изменить" onclick="change()" id="ch">Изменить</button>
<button value="Сохранить" onclick="save()" id="sv">Сохранить</button>
<button value="Поиск" onclick="tosearch()" id="s">Поиск </button>
</div>
<div id="mydiv8"><br><div id="whatido">Запросы</div><button value="Очистить" onclick="ochist()"> Очистить</button></div>
<div id="mydiv5"></div>

<div id="dc_1" style="position: fixed;left:50%;visibility:hidden;position:absolute;
    background-color:#f9f9f9;
    min-width:30px;
    box-shadow:0px 8px 10px 0px rgba(0,0,0,0.2)">
 </div>
 
 <div id="dc_2" style="position: fixed;left:50%;visibility:hidden;position:absolute;
    background-color:#f9f9f9;
    min-width:30px;
    box-shadow:0px 8px 10px 0px rgba(0,0,0,0.2)">
 </div>
 
 <div id="dc_3" style="position: fixed;left:50%;visibility:hidden;position:absolute;
    background-color:#f9f9f9;
    min-width:30px;
    box-shadow:0px 8px 10px 0px rgba(0,0,0,0.2)">
 </div>
  
 <input maxlength="4" size="4" style="visibility:hidden" id="tmp_input1" style="visibility:visible">
  <input maxlength="4" size="4" style="visibility:hidden" id="tmp_input2" style="visibility:visible">
   <input maxlength="4" size="4" style="visibility:hidden"  id="tmp_input3" style="visibility:visible">
 
<script>

var globo_mod=0;

function transfer(){ //при наличии уже существующих строк
//// При нажатие имени таблицы, оно подсвечивается синим. 
//// Если нажата кнопка "Добавить", то текущее "синее" название отправляется на добавление

var m=['0','1','2','3','4','5'];

for (l=0;l<m.length;l++){
	var color=document.getElementById(m[l]).style.color;
	if (color=="blue"){
		var table_name=document.getElementById(m[l]).innerHTML;
		document.getElementById("q_"+l.toString()).checked=false;
		break
	}	
}

//document.getElementById("mydiv2").style.visibility="hidden"
//document.getElementById("mydiv9").style.visibility="hidden"
//document.getElementById("mydiv8").innerHTML='<br><button value="Ok">Добавить</button><button value="Ok">Назад</button>'

var arr1=['Наименование','Цена(сум)','Производитель','Категория товара','Отдел','Срок хранения (суток)','Количество(штук)'] //greeds
var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
var arr4=['ФИО','Отдел','План по прибыли(сум/месяц)'] //salesman
var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
var arr6=['Дата продажи','Продажа','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
var m=['0','1','2','3','4','5'];
var arr=[]

var st=''
var tmp=[]
var k=''

if (table_name=="greeds"){
	arr=arr1;
	k='0'
	for (i=0;i<arr.length;i++){
		if (i!=2 && i!=3 &&i!=4){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name)	.value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==2 || i==3 || i==4){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name)	.value
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			} 
				else {
					alert('Заполните пожалуйста все поля')
					return 0
			}
		}
		
		tmp.push(r)
}

st="INSERT INTO greeds (`Наименование`,`Цена(сум)`, `Производитель`, `Код категории`,`Код отдела`,`Срок хранения (суток)`,`Количество(штук)`) SELECT "+tmp[0]+","+tmp[1]+","+tmp[2]+","+
"( SELECT `Номер` FROM sklad WHERE `Категория товара` ="+tmp[3]+"),"+
"( SELECT `Номер` FROM otdel WHERE `Отдел`="+tmp[4]+"),"+tmp[5]+","+tmp[6]
}

if (table_name=="personal"){
	arr=arr2;
	k='1'
	for (i=0;i<arr.length;i++){
		if (i!=2){
		    var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==2){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name).value
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			}
			else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		tmp.push(r)
	}

	st="INSERT INTO personal (`ФИО`,`Трудовой стаж (лет)`, `Должность`,`Зарплата (сум)`,`Возраст (лет)`,`Адрес`,`Телефон`) VALUES ("+tmp[0]+","+tmp[1]+","+tmp[2]+","+tmp[3]+","+tmp[4]+","+tmp[5]+","+tmp[6]+")"

}

if (table_name=="postavshik"){
	arr=arr3;
	k='2'
	for (i=0;i<arr.length;i++){
		if (i!=0 && i!=2){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==0 || i==2){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		tmp.push(r)
	}

	st="INSERT INTO postavshik (`Поставщик`,`Дата следующей поставки`, `Код категории`,`Адрес`,`Телефон`)"+
	" SELECT "+tmp[0]+","+tmp[1]+",("+
	" SELECT `Номер` FROM sklad WHERE `Категория товара` ="+tmp[2]+"),"+tmp[3]+","+tmp[4]
}

if (table_name=="salesman"){
	arr=arr4;
	k='3'
	for (i=0;i<arr.length;i++){
		if (i==2){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i!=2){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		tmp.push(r)
	}
	
	st="INSERT INTO salesman (`Код сотрудника`, `Код Отдела`, `План по прибыли(сум/месяц)`)"+
	"SELECT ( SELECT pl.`Номер` FROM (personal pl LEFT JOIN salesman sl ON pl.`Номер`=sl.`Код сотрудника`) WHERE pl.`ФИО`="+tmp[0]+"),"+
	"( SELECT `Номер` FROM otdel WHERE `Отдел`="+tmp[1]+"),"+tmp[2]
	
}

if (table_name=="sklad"){
	arr=arr5;
	k='4'
	for (i=0;i<arr.length;i++){
		if (i!=0 && i!=4){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==0 || i==4){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		tmp.push(r)
	}

	st="INSERT INTO sklad (`Категория товара`,`Дата получения`, `Номер стеллажа`,`Номер полки`,`Получил`)"+
	" SELECT "+tmp[0]+","+tmp[1]+","+tmp[2]+","+tmp[3]+",("+
	" SELECT `Номер` FROM personal "+
	 "WHERE `ФИО`="+tmp[4]+")"
}

if (table_name=="sales"){
	arr=arr6;
	k='5'
	for (i=0;i<arr.length;i++){
		if (i!=3 && i!=4){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==3 || i==4){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		tmp.push(r)
	}

	st="INSERT INTO sales (`Дата продажи`,`Продажа`, `Количество(штук)`,`Код продавца`,`Код товара`,`Скидка (процент)`)"+
	" SELECT "+tmp[0]+","+tmp[1]+","+tmp[2]+","+
	" ( SELECT `Номер` FROM salesman WHERE `Код сотрудника`=(SELECT `Номер` FROM personal WHERE `ФИО`="+tmp[3]+
	")), (SELECT `Номер` FROM greeds WHERE `Наименование`="+tmp[4]+"),"+tmp[5]	
}


$.ajax ({
	type:"POST",
	url : "add.php",
	data : {table:table_name,str:st},
	dataType : "json",	

	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
	
		if (tmp.length>1){
			var keys=Object.keys(tmp[0])
			newtable(k)
		} 
	}
	});
}

function showtable(arr,tmp,name){
/// arr-массив с названиями полей текущей таблицы
/// tmp-выводимые данные
var i;
document.getElementById('mydiv3').innerHTML="<br>Текущая таблица<br>"

var st1='<br><table id="TID" border="1;solid" style="margin:5px ; border-collapse: collapse">'
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
	document.getElementById('s').style.visibility="hidden"
	document.getElementById('vvod').style.visibility="visible"
} else{
	document.getElementById('vvod').style.visibility="hidden"
	document.getElementById('dob').style.visibility="visible"
	document.getElementById('sv').style.visibility="visible"
	document.getElementById('ch').style.visibility="visible"
	document.getElementById('del').style.visibility="visible"
	document.getElementById('dob').style.visibility="visible"
	document.getElementById('s').style.visibility="visible"
}
		
/// При клике на строку вызываем функцию ukaz		
for (m=0;m<tmp.length;m++){
		st1=st1+"<tr align='center' id='"+'t'+m.toString()+"' onclick='ukaz("+m.toString()+','+tmp.length.toString()+")'>"
		for (i=0;i<arr.length;i++){
			if (name=="sklad" && arr[i]=="Получил"){
				arr[i]="ФИО"
			}
			
			if (name=="sales"){
				if (arr[i]=="Продавец"){
					arr[i]="ФИО"
				}
				
				if (arr[i]=="Товар"){
					arr[i]="Наименование"
				}			
			 }
	
			st1=st1+"<td id='tabled_"+m.toString()+i.toString()+"' style='width: 100px;'>"+tmp[m][arr[i]]+"</td>"
		}
		
		st1=st1+'</tr>'
}

document.getElementById('mydiv3').innerHTML+=st1;
////////////////////////////////////////////////////////
}

function selection(name,what,id,st){
	var str='',st2='',m='';
	var tr=[]
	
	st2=st;
	if (name=="greeds"){
		var k=0;
		if (what=='Категория товара'){
		   str="SELECT `Категория товара` FROM sklad"
	   }
	   
	   if (what=='Отдел'){
			str="SELECT `Отдел` FROM otdel"
		}
		
		if (what=='Производитель'){
			str="SELECT `Производитель` FROM greeds"
		}
	}
	
	if (name=="personal"){
		var k=1;
		str="SELECT `Должность` FROM personal"
	}
	
	if (name=="postavshik"){
	   var k=2;
	   if (what=='Категория товара'){
		   str="SELECT `Категория товара` FROM sklad"
	   }
	   
	   if (what=='Поставщик'){
		 str="SELECT `Поставщик` FROM postavshik"  
	   }
	}
	
	if (name=="salesman"){
		var k=3;
		if (what=='Отдел'){
				str="SELECT `Отдел` FROM otdel"
		}
		
		if (what=='ФИО'){
				str="SELECT `ФИО` FROM personal WHERE `Должность`='Продавец'"
		}
	}
	
	if (name=="sklad"){
		var k=4;
		var a=''
		if (what=='Категория товара'){
			str="SELECT `Категория товара` FROM sklad"
		}
		
		if (what=='Получил'){
			str="SELECT `ФИО` FROM personal"
		}
	}
	
	if (name=="sales"){
		var k=5;
		if (what=='Продавец'){
			str="SELECT `ФИО` FROM personal WHERE `Должность`='Продавец'"
		}
		
		if (what=='Товар'){
			str="SELECT `Наименование` FROM greeds"
		}	
	}
	
	$.ajax({ 
		url : "sel.php",
		type : "POST",
		data:{str: str},
		dataType : "json",	
		success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		
		st2=what+' '+'<select id="textfield'+id.toString()+'_'+name+'"><option selected disabled hidden value=""></option>'
		
		for (i=0;i<tmp.length;i++){
			if (what=="Получил" || (what=="Продавец" && name=="sales")){
				what="ФИО"
			}
			
			if (what=="Товар" && name=="sales"){
			  what="Наименование"	
			}
			
			var st=tmp[i][what];	
			m=m+'<option>'+st+'</option>'
		}
			
			st2=st2+m+'</select><br>'
			
			if ((what=="Категория товара" || what=="Отдел" || what=="Производитель") && name=="greeds"){
			  st2=st2+'<br>'	
			}
			
			if ((what=="Поставщик" || what=="Категория товара") && name=="postavshik"){
			  st2=st2+'<br>'	
			}
			
			if ((what=="ФИО" || what=="Категория товара") && name=="sklad"){
			  st2=st2+'<br>'	
			}
			
			if ((what=="Отдел" || what=="ФИО") && name=="salesman"){
				st2=st2+'<br>'
			}
			
			if ((what=="Наименование" || what=="ФИО") && name=="sales"){
				st2=st2+'<br>'
			}
			
			document.getElementById("mydiv5").innerHTML+=st2
		}
	});
}

function showqueries(arr,k,mode){
	var st='<br>'+k+'<br><br>'
	var st2=''
	var temp_st=''
	var flag=0;
	var count=0;
	
	if (mode==0){
		document.getElementById("mydiv5").innerHTML=""
	}
	
	for (l=0;l<arr.length;l++){
	   flag=0;
	   if (k=="greeds" && (arr[l]=="Категория товара" || arr[l]=="Производитель" || arr[l]=="Поставщик" || arr[l]=="Отдел")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   } 
	   
	   if (k=="personal" && (arr[l]=="Должность")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   } 
	   
	    if (k=="postavshik" && (arr[l]=="Поставщик" || arr[l]=="Категория товара")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   } 
	   
	   if (k=="salesman" && (arr[l]=="Отдел" || arr[l]=="ФИО")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   }
	   
	   if (k=="sklad" && (arr[l]=="Категория товара" || arr[l]=="Получил")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   }
	   
	   if (k=="sales" && (arr[l]=="Продавец" || arr[l]=="Товар")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   }
	   
	   if (flag==0){
		   if (mode==2){
		   if ((arr[l].indexOf('(') + 1) || arr[l]=='Номер полки' || arr[l]=='Номер стеллажа'){
			   var znak=['>','<','=','!=','>=','<=','(a,b)','[a,b]','[a,b)','(a,b]']
			st=st+arr[l]+'<br><br><input maxlength="4" size="4" style="visibility:hidden" id="t_1'+l.toString()+'">'+
			'<select id="character'+l.toString()+'" onchange="kb('+l+')"><option selected disabled hidden value=""></option>'
			for (j=0;j<znak.length;j++){
				st=st+'<option>'+znak[j]+'</option>'
			}	
				st=st+'</select> <input style="visibility:hidden" maxlength="4" size="4" id="t_2'+l.toString()+'"><br><br>'
			} else {
				if (arr[l].indexOf('Дата') + 1){
				    st=st+arr[l]+' '+'<input type="date" data-date-format="YYYY MMMM DD" value="'+getDate()+'" maxlength="10"   size="10" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				} else {
					st=st+arr[l]+' '+'<input maxlength="10"  size="10" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				}
			}
		  } else {
			  if (arr[l].indexOf('Дата') + 1){
				    st=st+arr[l]+' '+'<input type="date" data-date-format="YYYY MMMM DD" value="'+getDate()+'" maxlength="10"   size="10" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				} else {
					st=st+arr[l]+' '+'<input maxlength="10"  size="10" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				}
		  }
	   }
	}
	
	document.getElementById("mydiv5").innerHTML+=st
}

function newtable(k){
 var arr1=['Наименование','Цена(сум)','Производитель','Категория товара','Отдел','Срок хранения (суток)','Количество(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
 var arr4=['ФИО','Отдел','План по прибыли(сум/месяц)'] //salesman
 var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
 var arr6=['Дата продажи','Продажа','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
 var m=['0','1','2','3','4','5'];
 var st2=''
 var str=''
 
 for (l=0;l<m.length;l++){
	document.getElementById("q_"+l.toString()).checked=false
	document.getElementById(m[l]).style.color="black"
 }

 document.getElementById(k).style.color="blue"
 document.getElementById("q_"+k).checked=true
 
 if (k=='0'){
	 str="greeds"
   	 str2="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,s.`Категория товара`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Количество(штук)` FROM (greeds g LEFT JOIN otdel o ON g.`Код Отдела`=o.`Номер`) LEFT JOIN sklad s ON g.`Код категории`=s.`Номер` ";
 }
 
 if (k=='1'){
   str="personal"
   str2="SELECT p.`ФИО`,p.`Трудовой стаж (лет)`,p.`Должность`,p.`Зарплата (сум)`,p.`Возраст (лет)`,p.`Адрес`,p.`Телефон` FROM personal p"; 
 }
 
 if (k=='2'){
   str="postavshik"
   str2="SELECT p.`Поставщик`,p.`Дата следующей поставки`,s.`Категория товара`,p.`Адрес`,p.`Телефон` FROM (postavshik p LEFT JOIN sklad s ON p.`Код категории`=s.`Номер`)"
 }
 
 if (k=='3'){
   str="salesman"
   str2="SELECT p.`ФИО`,o.`Отдел`,s.`План по прибыли(сум/месяц)` FROM (salesman s LEFT JOIN otdel o ON s.`Код Отдела`=o.`Номер`) LEFT JOIN personal p ON s.`Код сотрудника`=p.`Номер`";	 
 }
 
 if (k=='4'){
   str="sklad"
   str2="SELECT s.`Категория товара`,s.`Дата получения`,s.`Номер стеллажа`,s.`Номер полки`,p.`ФИО` FROM (sklad s LEFT JOIN personal p ON s.`Получил`=p.`Номер`)"	 
 }
 
 if (k=='5'){
   str="sales"
   str2="SELECT s.`Дата продажи`,s.`Продажа`,s.`Количество(штук)`,p.`ФИО`,g.`Наименование`,s.`Скидка (процент)`"+
   " FROM (sales s LEFT JOIN greeds g ON s.`Код товара`=g.`Номер`) LEFT "+
   "JOIN salesman sl ON s.`Код продавца`=sl.`Номер` LEFT JOIN personal p ON p.`Номер`=sl.`Код сотрудника`" 
 }
 	
 $.ajax ({
	type:"POST",
	url : "refresh.php",
	data : { str: str2},
	dataType : "json",	
	
	success: function(data){
		var str_ = JSON.stringify(data);
		var tmp = JSON.parse(str_);
		
		if (k=='0'){ //greeds
			showqueries(arr1,str,0)
			showtable(arr1,tmp,str)
		}
		
		if (k=='1'){ //personal
			showqueries(arr2,str,0)
			showtable(arr2,tmp,str)
		}
		
		if (k=='2'){//postavshik
			showqueries(arr3,str,0)
			showtable(arr3,tmp,str)
		}
		
		if (k=='3'){ //salesman
			showqueries(arr4,str,0)
			showtable(arr4,tmp,str)
		}
		
		if (k=='4'){ //sklad
			showqueries(arr5,str,0)
			showtable(arr5,tmp,str)
		}	
		
		if (k=='5'){ //sales
			showqueries(arr6,str,0)
			showtable(arr6,tmp,str)
		}	
	}
	});
	
	document.getElementById('mydiv8').innerHTML='<br><div id="whatido">Запросы</div><br>'+
	'<button onclick="ochist()">Очистить</button> <button onclick="ok('+k.toString()+')">Ok'+
	'</button> <button onclick="newtable('+k.toString()+')">Назад</button>'
	
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
var arr1=['Наименование','Цена(сум)','Производитель','Категория товара','Отдел','Срок хранения (суток)','Количество(штук)'] //greeds
var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст','Адрес','Телефон'] //personal
var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
var arr4=['ФИО','Отдел','План по прибыли(сум/месяц)'] //salesman
var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
var arr6=['Дата продажи','Продажа','Количество','Продавец','Товар','Скидка (процент)']//sales
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
			
			if (st=='personal'){
				arr=arr2
			}
			
			if (st=='postavshik'){
				arr=arr3
			}
			
			if (st=='salesman'){
				arr=arr4
			}
			
			if (st=='sklad'){
				arr=arr5
			}
			
			if (st=='sales'){
				arr=arr6
			}
			
			ans.push(st)
			break
		}	
}

	var table=document.getElementById("TID")
	
	for (l=0;l<table.rows.length;l++){
		var color=document.getElementById('t'+l.toString()).style.border;
		if (color=="solid"){
			var st2=l
			ans.push(st2)
			break
		}	
	}

	return ans
}

function delet(){
 var arr1=['Наименование','Цена(сум)','Производитель','Категория товара','Отдел','Срок хранения (суток)','Количество(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
 var arr4=['ФИО','Отдел','План по прибыли(сум/месяц)'] //salesman
 var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
 var arr6=['Дата продажи','Продажа','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
 var m=['0','1','2','3','4','5'];
 var ans=[]
 
 ans=give_tablename_and_id(m)
 var q1="SELECT * FROM "+ans[0]+" LIMIT 1 OFFSET "+ans[1]
 
 y=prompt('Удалить: y/n')
	
    if (y!="y"){
		return 0
	}
	
	var mode='delete'
	
	$.ajax ({
		type:"POST",
		url : "delete.php",
		data : { q1: q1,table:ans[0],mode:mode},
		dataType : "json",	

	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		//console.log(tmp)
		if (ans[0]=="greeds"){
			newtable('0')
		}
		
		if (ans[0]=="personal"){
			newtable('1')
		}
		if (ans[0]=="postavshik"){
			newtable('2')
		}
		
		if (ans[0]=="salesman"){
			newtable('3')
		}
		
		if (ans[0]=="sklad"){
			newtable('4')
		}	
		
		if (ans[0]=="sales"){
			newtable('5')
		}	
	}
	
	});
}	

function zapros(str,dc,what,mode){
	var tt=''
	$.ajax ({
	type:"POST",
	url : "refresh.php",
	data : { str: str},
	dataType : "json",	
	
	success: function(data){
		var str_ = JSON.stringify(data);
		var tmp = JSON.parse(str_);
		if (mode==0){
			for (i=0;i<tmp.length;i++){
				tt=tt+'<a href="#"  style="color:black;padding:12px 16px;text-decoration:none;display:block">'+
				tmp[i][what]+'</a>'
			}
			document.getElementById(dc).innerHTML=tt
		} else {
			tt=tmp[0][what]
			document.getElementById(dc).value=tt
		}
	}
	});
	
	

}

function change(){
	var m=['0','1','2','3','4','5'];
	var st1=''
	
	document.getElementById("whatido").innerHTML="Редактирование<br>"
	
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			var table_name=document.getElementById(m[l]).innerHTML;
			break
		}	
	}
	
	if (table_name=="greeds"){
			var st="SELECT `Категория товара` FROM `sklad`"
			zapros(st,"dc_2",'Категория товара',0)
			
			var st="SELECT `Отдел` FROM `otdel`"
			zapros(st,"dc_3",'Отдел',0)
	}
	
	if (table_name=="personal"){
			var st="SELECT `Должность` FROM `personal`"
			zapros(st,"dc_1",'Должность',0)
	}
	
	if (table_name=="postavshik"){
			var st="SELECT `Поставщик` FROM `postavshik`"
			zapros(st,"dc_1",'Поставщик',0)
		
			var st="SELECT `Категория товара` FROM `sklad`"
			zapros(st,"dc_2",'Категория товара',0)
	}
	
	if (table_name=="salesman"){
			var st="SELECT `ФИО` FROM `personal` WHERE `Должность`='Продавец'"
			zapros(st,"dc_1",'ФИО',0)
		
			var st="SELECT `Отдел` FROM `otdel`"
			zapros(st,"dc_2",'Отдел',0)
	}
	
	if (table_name=="sklad"){
			var st="SELECT `Категория товара` FROM `sklad`"
			zapros(st,"dc_1",'Категория товара',0)
			
			var st="SELECT `ФИО` FROM `personal`"
			zapros(st,"dc_2",'ФИО',0)
	}
	
	if (table_name=="sales"){
		var st="SELECT `ФИО` FROM `personal` WHERE `Должность`='Продавец'"
		zapros(st,"dc_1",'ФИО',0)
		
		var st="SELECT `Наименование` FROM `greeds`"
		zapros(st,"dc_2",'Наименование',0)
	}
	
	
	var tdItems = document.getElementsByTagName("td");
	
	for (var i = 0; i < tdItems.length; i++){
		tdItems[i].addEventListener('contextmenu', tdClick,false)
	}
}

function tdClick(e) {
	var m=['0','1','2','3','4','5'];
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			var table_name=document.getElementById(m[l]).innerHTML;
			break
		}	
	}
	event = event || window.event;
	event.preventDefault ? event.preventDefault() : event.returnValue = false;
	
	var $this = $(this);
	
	var p=e.target.id;
	p=p[p.length-1]
	
	
	if (table_name=="greeds" && p==3){
		var dropDownContent = $("#dc_2").clone(true);
	}
    
	if (table_name=="greeds" && p==4){
		var dropDownContent = $("#dc_3").clone(true);
	}
	
	if (table_name=="personal" && p==2){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="postavshik" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="postavshik" && p==2){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if (table_name=="salesman" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="salesman" && p==1){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if (table_name=="sklad" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="sklad" && p==4){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if (table_name=="sales" && p==3){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="sales" && p==4){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if ((table_name=="greeds" & (p==3 || p==4))
		|| (table_name=="personal" & (p==2))
		|| (table_name=="postavshik" & (p==0 || p==2))
		|| (table_name=="salesman" & (p==0 || p==1))
		|| (table_name=="sklad" & (p==0 || p==4))
		|| (table_name=="sales" & (p==3 || p==4))
	){
		$(dropDownContent).css({"visibility":"visible"});
		$(this).append($(dropDownContent));
		currenttd=this;   
		$("a").click(function(){
		$(currenttd).html($(this).text());
			 $(dropDownContent).hide();
		}); 
	} else {
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
		
	}
	
	
};

function save(){
var arr1=['Наименование','Цена(сум)','Производитель','Код категории','Код отдела','Срок хранения (суток)','Количество(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
 var arr4=['Код сотрудника','Код отдела','План по прибыли(сум/месяц)'] //salesman
 var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
 var arr6=['Дата продажи','Продажа','Количество(штук)','Код продавца','Код товара','Скидка (процент)']//sales
 var m=['0','1','2','3','4','5'];
 var ans=[]
 var arr=[]
 ans=give_tablename_and_id(m)
 
 if (ans[0]=="greeds"){
	arr=arr1
 }
 
 if (ans[0]=="personal"){
	arr=arr2
 }
 
 if (ans[0]=="postavshik"){
	arr=arr3
 }
 
 if (ans[0]=="salesman"){
	arr=arr4
 }
 
 if (ans[0]=="sklad"){
	arr=arr5
 }
 
  if (ans[0]=="sales"){
	arr=arr6
 }

	if (ans[0]=="greeds"){
		var qr="SELECT `Номер` FROM sklad WHERE `Категория товара`='"+
		document.getElementById('tabled_'+ans[1].toString()+'3').innerHTML+"'"
		zapros(qr,"tmp_input2",'Номер',1)
		
		var qr="SELECT `Номер` FROM otdel WHERE `Отдел`='"+
		document.getElementById('tabled_'+ans[1].toString()+'4').innerHTML+"'"
		zapros(qr,"tmp_input3",'Номер',1)
	}
	
	if (ans[0]=="personal"){
		var qr="SELECT `Номер` FROM personal WHERE `Должность`='"+
		document.getElementById('tabled_'+ans[1].toString()+'2').innerHTML+"'"
		zapros(qr,"tmp_input1",'Номер',1)
	}
	
	if (ans[0]=="postavshik"){
		var qr="SELECT `Номер` FROM postavshik WHERE `Поставщик`='"+
		document.getElementById('tabled_'+ans[1].toString()+'0').innerHTML+"'"
		zapros(qr,"tmp_input1",'Номер',1)
		
		var qr="SELECT `Номер` FROM sklad WHERE `Категория товара`='"+
		document.getElementById('tabled_'+ans[1].toString()+'2').innerHTML+"'"
		zapros(qr,"tmp_input2",'Номер',1)
	}
		
		
	if (ans[0]=="salesman"){
		var qr="SELECT `Номер` FROM personal WHERE `ФИО`='"+
		document.getElementById('tabled_'+ans[1].toString()+'0').innerHTML+"'"
		zapros(qr,"tmp_input1",'Номер',1)
		
		var qr="SELECT `Номер` FROM otdel WHERE `Отдел`='"+
		document.getElementById('tabled_'+ans[1].toString()+'1').innerHTML+"'"
		zapros(qr,"tmp_input2",'Номер',1)
	}
		
	
    if (ans[0]=="sklad"){
		var qr="SELECT `Номер` FROM sklad WHERE `Категория товара`='"+
		document.getElementById('tabled_'+ans[1].toString()+'0').innerHTML+"'"
		zapros(qr,"tmp_input1",'Номер',1)
		
		var qr="SELECT `Номер` FROM personal WHERE `ФИО`='"+
		document.getElementById('tabled_'+ans[1].toString()+'4').innerHTML+"'"
		zapros(qr,"tmp_input2",'Номер',1)
	}
	
	if (ans[0]=="sales"){
		var qr="SELECT `Номер` FROM personal WHERE `Должность`=='Продавец' AND `ФИО`='"+
		document.getElementById('tabled_'+ans[1].toString()+'3').innerHTML+"'"
		zapros(qr,"tmp_input1",'Номер',1)
		
		var qr="SELECT `Номер` FROM greeds WHERE `Наименование`='"+
		document.getElementById('tabled_'+ans[1].toString()+'4').innerHTML+"'"
		zapros(qr,"tmp_input2",'Номер',1)
	}
			
	var mystr=''		
	for (i=0;i<arr.length;i++){
			if (ans[0]=="greeds" && (arr[i]=='Код категории' || arr[i]=='Код отдела')){
				
				if (arr[i]=='Код категории'){
					mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input2').value+'\", '
				}
				
				if (arr[i]=='Код отдела'){
					mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input3').value+'\", '
				}
				continue
			}
			
			if (ans[0]=="personal" && (arr[i]=='Должность')){
				if (arr[i]=='Должность'){
					mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input1').value+'\", '
				}
				
				continue
			}
			
			if (ans[0]=="postavshik" && (arr[i]=='Поставщик' || arr[i]=='Код категории')){
				if (arr[i]=='Поставщик'){
					mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input1').value+'\", '
				}
				
				if (arr[i]=='Код категории'){
					mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input2').value+'\", '
				}
				
				continue
			}
			
			if (ans[0]=="salesman" && (arr[i]=='Код продавца' || arr[i]=='Код отдела')){
					if (arr[i]=='Код продавца'){
						mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input1').value+'\", '	
					}
					
					if (arr[i]=='Код отдела'){
						mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input2').value+'\", '	
					}
					
					continue
			}
			
			if (ans[0]=="sklad" && (arr[i]=='Категория товара' || arr[i]=='Получил')){
					if (arr[i]=='Категория товара'){
						mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input1').value+'\", '	
					}
				
					if (arr[i]=='Получил'){
						mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input2').value+'\", '	
					}
					continue
			}
			
			if (ans[0]=="sales" && (arr[i]=='Код продавца' || arr[i]=='Код товара')){
				if (arr[i]=='Код продавца'){
						mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input1').value+'\", '	
				}
				
				if (arr[i]=='Код товара'){
						mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tmp_input2').value+'\", '	
				}
				
				continue
			}
			
			if (i==arr.length-1){
				mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tabled_'+ans[1].toString()+(i).toString()).innerHTML+'\"'
			} else {
				mystr=mystr+'`'+arr[i]+'`= \"'+document.getElementById('tabled_'+ans[1].toString()+(i).toString()).innerHTML+'\", '
			}
		}
	
	mystr='UPDATE '+ans[0]+' SET '+mystr+' WHERE `Номер`='
	var mode='SELECT * FROM '+ans[0]+' LIMIT 1 OFFSET '+ans[1]
	
	console.log(mystr)

	$.ajax ({
	type:"POST",
	url : "delete.php",
	data : { q1:mystr,table:ans[0],mode:mode},
	dataType : "json",	
	
	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		
		if (ans[0]=="greeds"){
			newtable('0')
		}
		
		if (ans[0]=="personal"){
			newtable('1')
		}
		if (ans[0]=="postavshik"){
			newtable('2')
		}
		
		if (ans[0]=="salesman"){
			newtable('3')
		}
		
		if (ans[0]=="sklad"){
			newtable('4')
		}	
		
		if (ans[0]=="sales"){
			newtable('5')
		}	
	}
	});
}	

function write(arr,tmp,mode){
	var st1='<br><table border="1;solid" style="margin:5px ; border-collapse: collapse">'
	st1=st1+"<tr align='center'>"
			
	console.log(tmp)
			
	for (m=0;m<arr.length;m++){
		if (mode==0){
			var a=arr[m].split('.')
			var b=a[1].split('`')
			st1=st1+"<td style='width: 100px;'><strong>"+b[1]+"</strong></td>"
		}
		
		if (mode==1){
			st1=st1+"<td style='width: 100px;'><strong>"+arr[m]+"</strong></td>"
		}
	}
			
	st1=st1+'</tr>'
			
	for (m=0;m<tmp.length;m++){
			st1=st1+"<tr align='center'>"
				for (i=0;i<arr.length;i++){
					if (mode==0){
						var a=arr[i].split('.')
						var b=a[1].split('`')
		
					if (b[1]=='Товар'){
					   b[1]='Наименование'	
					}
						st1=st1+"<td style='width: 100px;'>"+tmp[m][b[1]]+"</td>"
					}
					
					if (mode==1){
						st1=st1+"<td style='width: 100px;'>"+tmp[m][arr[i]]+"</td>"
						
					}
				}
		
			st1=st1+'</tr>'
	}
		
	document.getElementById('mydiv3').innerHTML=st1;
}

function give(arr,names){
	var ans=[]
	var arr_u=[]
	var e=0
	var mystr=''
	var first=0;
	
	for (t=0;t<arr.length;t++){
		for (l=0;l<arr[t].length;l++){
			if ((names[t]=="greeds" && l!=2 && l!=3 && l!=4) || (names[t]=="personal" && l!=2) ||
				(names[t]=="postavshik" && l!=0 && l!=2) ||
				(names[t]=="salesman" && l==2) ||
				(names[t]=="sklad" && l!=0 && l!=4) || (names[t]=="sales" && l!=3 && l!=4)
			){
			
			var p=document.getElementById("textfield_"+l.toString()+'_'+names[t]).value
			
			if (first==0 && p.length!=""){ //начало условия без and
				mystr=mystr+arr[t][l]
				arr_u.push(arr[t][l]+"= "+"'"+p+"'")
				first=1;
				continue
			}
				
			if (first==1 && p.length!=""){
				arr_u.push(" AND "+arr[t][l]+"= "+"'"+p+"'")
				mystr=mystr+",`"+arr[t][l]+"`"
			  }
			} 
			
			else {
				if ((names[t]=="personal" && l==2) || (names[t]=="greeds" && ((l==2)||(l==3) || (l==4)))
						|| (names[t]=="postavshik" && (l==0 || l==2))
						|| (names[t]=="salesman" && l!=2)
						|| (names[t]=="sklad" && (l==0 || l==4) || (names[t]=="sales" && (l==3 || l==4))) 
				){
					var p=document.getElementById("textfield"+l.toString()+'_'+names[t]).value
					
					if (first==0 && p.length!=""){ //начало условия без and
						mystr=mystr+arr[t][l]
						arr_u.push(arr[t][l]+"= "+"'"+p+"'")
						first=1;
						continue
					}
				
				if (first==1 && p.length!=""){
					arr_u.push(" AND "+arr[t][l]+"= "+"'"+p+"'")
					mystr=mystr+","+arr[t][l]
					
				}
			}
			}
		}
	}
    		
	
	ans.push(mystr)
	ans.push(arr_u)
	
	return ans;
}

function ok(m){
	var arr1=['g.`Наименование`','g.`Цена(сум)`','g.`Производитель`','skl.`Категория товара`','o.`Отдел`','g.`Срок хранения (суток)`','g.`Количество(штук)`'] //greeds
	var arr2=['pl.`ФИО`','pl.`Трудовой стаж (лет)`','pl.`Должность`','pl.`Зарплата (сум)`','pl.`Возраст (лет)`','pl.`Адрес`','pl.`Телефон`'] //personal
	var arr3=['pt.`Поставщик`','pt.`Дата следующей поставки`','skl.`Категория товара`','pt.`Адрес`','pt.`Телефон`'] //postavshik
	var arr4=['pl.`ФИО`','o.`Отдел`','sl.`План по прибыли(сум/месяц)`'] //salesman
	var arr5=['skl.`Категория товара`','skl.`Дата получения`','skl.`Номер стеллажа`','skl.`Номер полки`','pl.`ФИО`']//sklad
	var arr6=['s.`Дата продажи`','s.`Продажа`','s.`Количество(штук)`','pl.`ФИО`','g.`Наименование`','s.`Скидка (процент)`']//sales
	
	var m=['0','1','2','3','4','5'];
	var ans=[]
	var s_arr=[]
	var names=[]
	var arr=[]
	
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			m=l
			break
		}	
	}
	
	for (u=0;u<6;u++){
	   if (document.getElementById("q_"+u.toString()).checked==true){
            if (u==0){
				names.push(["greeds"])
				s_arr.push(arr1)
			}
			
			if (u==1){
				names.push(["personal"])
				s_arr.push(arr2)
			}
			
			if (u==2){
				names.push(["postavshik"])
				s_arr.push(arr3)
			}
			
			if (u==3){
				names.push(["salesman"])
				s_arr.push(arr4)
			}
			
			if (u==4){
				names.push(["sklad"])
				s_arr.push(arr5)
			}
			
			if (u==5){
				names.push(["sales"])
				s_arr.push(arr6)
			}
	   }
	}
	
	
	if (globo_mod!=2){
		ans=give(s_arr,names)
	} else {
		ans=give_search(s_arr,names)
	}
	
	for (i=0;i<names.length;i++){
		    if (names[i]=="greeds"){
				names[i]="greeds g"
			}
			if (names[i]=="personal"){
					names[i]="personal pl"
			}
			
			if (names[i]=="salesman"){
					names[i]="salesman sl"
			}
			
			if (names[i]=="sales"){
				names[i]="sales s"
			}
			
			if (names[i]=="sklad"){
				names[i]="sklad skl"
			}
			
			if (names[i]=="postavshik"){
					names[i]="postavshik pt"
			}
	}
	
	if (names.length==1){
		if (names[0]=="greeds g"){
			var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,skl.`Категория товара`,o.`Отдел`,"+
			"g.`Срок хранения (суток)`,g.`Количество(штук)` FROM (greeds g LEFT JOIN otdel o ON g.`Код Отдела`=o.`Номер`) "+
			"LEFT JOIN sklad skl ON g.`Код категории`=skl.`Номер` ";
		}
		
		if (names[0]=="personal pl"){
			var st="SELECT * FROM ("+names[0]+") "
		}
		
		if (names[0]=="postavshik pt"){
			var st="SELECT pt.`Поставщик`,pt.`Дата следующей поставки`,skl.`Категория товара`,pt.`Адрес`,pt.`Телефон` "+
			"FROM (postavshik pt LEFT JOIN sklad skl ON pt.`Код категории`=skl.`Номер`) "
		}
		
		if (names[0]=="salesman sl"){
				var st="SELECT pl.`ФИО`,o.`Отдел`,sl.`План по прибыли(сум/месяц)` "+
				"FROM (salesman sl LEFT JOIN otdel o ON sl.`Код Отдела`=o.`Номер`) "+
				"LEFT JOIN personal pl ON sl.`Код сотрудника`=pl.`Номер` "
		}
		
		if (names[0]=="sklad skl"){
			var st="SELECT skl.`Категория товара`,skl.`Дата получения`,skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` "+
			"FROM (sklad skl LEFT JOIN personal pl ON skl.`Получил`=pl.`Номер`) "
		}
		
		if (names[0]=="sales s"){
				var st="SELECT s.`Дата продажи`,s.`Продажа`,s.`Количество(штук)`,pl.`ФИО`,g.`Наименование`,s.`Скидка (процент)` "+
				"FROM (sales s LEFT JOIN greeds g ON s.`Код товара`=g.`Номер`) LEFT "+
				"JOIN salesman sl ON sl.`Номер`=s.`Код продавца` LEFT JOIN personal pl ON sl.`Код сотрудника`=pl.`Номер` "
		}
	}
	
	
	if (names.length==2){
		var st="SELECT * FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		
		if (names[0]=="greeds g" && names[1]=="sales s"){
		  st=st+ "s.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` LEFT JOIN sklad skl ON g.`Код категории`=skl.`Номер` LEFT JOIN salesman sl ON s.`Код продавца`=sl.`Номер` LEFT JOIN personal pl ON pl.`Номер`=sl.`Код сотрудника` "	
		}
		
		if (names[1]=="salesman sl" && names[0]=="personal pl"){
		  st=st+ "sl.`Код сотрудника`=pl.`Номер`) LEFT JOIN otdel o ON sl.`Код отдела`=o.`Номер` "	
		}
		
		if (names[1]=="sklad skl" && names[0]=="greeds g"){
		  st=st+ "g.`Код категории`=skl.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` "	
		}
		
		if (names[0]=="postavshik pt" && names[1]=="sklad skl"){
		  st=st+ "pt.`Код категории`=skl.`Номер`) "	
		}
	}
	
	if (names.length==3){
		if (names[0]=="greeds g" && names[2]=="sklad skl" && names[1]=="postavshik pt"){
		  var st="SELECT * FROM ("+names[0]+" LEFT JOIN "+names[2]+" ON "
		  st=st+ "g.`Код категории`=skl.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` LEFT JOIN postavshik pt ON pt.`Код категории`=skl.`Номер` "	
		}
		
		if (names[0]=="greeds g" && names[1]=="salesman sl" && names[2]=="sales s"){
			 var st="SELECT * FROM ("+names[0]+" LEFT JOIN "+names[2]+" ON "
			 st=st+ "s.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` LEFT JOIN sklad skl ON g.`Код категории`=skl.`Номер` LEFT JOIN salesman sl ON s.`Код продавца`=sl.`Номер` LEFT JOIN personal pl ON pl.`Номер`=sl.`Код сотрудника`  "	
		}
		
		if (names[0]=="personal pl" && names[1]=="salesman sl" && names[2]=="sales s"){
		     var st="SELECT * FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
			 st=st+ "sl.`Код сотрудника`=pl.`Номер`) LEFT JOIN otdel o ON sl.`Код отдела`=o.`Номер`  LEFT JOIN sales s ON s.`Код продавца`=sl.`Номер` "	
		}
		
		if (names[0]=="personal pl" && names[1]=="postavshik pt" && names[2]=="sklad skl"){
			 var st="SELECT * FROM ("+names[2]+" LEFT JOIN "+names[1]+" ON "
			 st=st+ "pt.`Код категории`=skl.`Номер`) LEFT JOIN personal pl ON skl.`Получил`=pl.`Номер` "
		}
		
		if (names[0]=="personal pl" && names[1]=="salesman sl" && names[2]=="sklad skl"){
			 var st="SELECT * FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
			 st=st+ "sl.`Код сотрудника`=pl.`Номер`) LEFT JOIN otdel o ON sl.`Код отдела`=o.`Номер` LEFT JOIN sklad skl ON skl.`Получил`=pl.`Номер` "
		}
	}
	
	if (ans[1].length>0){
		st=st+" WHERE "
	} 
	
	for (l=0;l<ans[1].length;l++){
		st=st+ans[1][l]
	}
	
	$.ajax ({
	type:"POST",
	url : "refresh.php",
	data : {str:st},
	dataType : "json",	

	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		
		if (tmp.length>1){
			var keys=Object.keys(tmp[0])
			write(keys,tmp,1)
		} else {
			if (names[0]=="greeds g"){
				write(arr1,tmp,0)
			}
		
			if (names[0]=="personal pl"){
				write(arr2,tmp,0)
			}
		
			if (names[0]=="postavshik pt"){
				write(arr3,tmp,0)
			}
	
			if (names[0]=="salesman sl"){
				write(arr4,tmp,0)
			}
	
			if (names[0]=="sklad skl"){
				write(arr5,tmp,0)
			}
		
			if (names[0]=="sales s"){
				write(arr6,tmp,0)
			}
		}
	}
	});
}	

function tosearch(){
 var arr1=['Наименование','Цена(сум)','Производитель','Категория товара','Отдел','Срок хранения (суток)','Количество(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
 var arr4=['ФИО','Отдел','План по прибыли(сум/месяц)'] //salesman
 var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
 var arr6=['Дата продажи','Продажа','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
 var m=['0','1','2','3','4','5'];
 
 document.getElementById('vvod').style.visibility="hidden"
 document.getElementById('dob').style.visibility="hidden"
 document.getElementById('sv').style.visibility="hidden"
 document.getElementById('ch').style.visibility="hidden"
 document.getElementById('del').style.visibility="hidden"
 document.getElementById('dob').style.visibility="hidden"
 document.getElementById('s').style.visibility="hidden"
 
 for (l=0;l<m.length;l++){
	var color=document.getElementById(m[l]).style.color;
	if (color=="blue"){
		var table_name=document.getElementById(m[l]).innerHTML;
		break
	}	
 }
 
 document.getElementById("whatido").innerHTML="Поиск<br>"
 document.getElementById("mydiv5").innerHTML=""
 globo_mod=2;
 
 if (table_name=='greeds'){
	 showqueries(arr1,table_name,2)
 }
 
 if (table_name=='personal'){
	 showqueries(arr2,table_name,2)
 }
 
 if (table_name=='postavshik'){
	 showqueries(arr3,table_name,2)
 }
 
 if (table_name=='salesman'){
	 showqueries(arr4,table_name,2)
 }
 
 if (table_name=='sklad'){
	 showqueries(arr5,table_name,2)
 }
 
 if (table_name=='sales'){
	 showqueries(arr6,table_name,2)
 }
}

function add_q(i){
 var arr1=['Наименование','Цена(сум)','Производитель','Категория товара','Отдел','Срок хранения (суток)','Количество(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата следующей поставки','Категория товара','Адрес','Телефон'] //postavshik
 var arr4=['ФИО','Отдел','План по прибыли(сум/месяц)'] //salesman
 var arr5=['Категория товара','Дата получения','Номер стеллажа','Номер полки','Получил']//sklad
 var arr6=['Дата продажи','Продажа','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
 var m=['0','1','2','3','4','5'];
 
 //test
 var count=0;
 for (r=0;r<m.length;r++){
	   var checkBox = document.getElementById("q_"+r.toString());
	   if (checkBox.checked == true){
		count++;
	   }
	   
	   if (count>3){
		    checkBox.checked = false;
			ochist()
	}
 }
 
 var val=1;
 
 if (globo_mod==2){
		val=2;
 }
 
    var checkBox = document.getElementById("q_"+i);
	 
	if (checkBox.checked == true){
		if (i=='0'){
			str='greeds';
			showqueries(arr1,str,val)
		}
 
		if (i=='1'){
			str='personal'
			showqueries(arr2,str,val)			
		}
 
		if (i=='2'){
			str='postavshik'
			showqueries(arr3,str,val)			
		}
 
		if (i=='3'){
			str='salesman'
            showqueries(arr4,str,val)				
		}
 
		if (i=='4'){
			str='sklad'
            showqueries(arr5,str,val)				
		}
 
		if (i=='5'){
			str='sales'
			showqueries(arr6,str,val)				
		}
	 }
}

function ochist(){
	if (globo_mod==0 || globo_mod==1){
		var m=['0','1','2','3','4','5'];
		for (l=0;l<m.length;l++){
			var color=document.getElementById(m[l]).style.color;
			if (color=="blue"){
				var table_name=document.getElementById(m[l]).innerHTML;
				break
			}	
		}
		
		if (table_name=="greeds"){
			newtable('0')
		}
		
		if (table_name=="personal"){
			newtable('1')
		}
		
		if (table_name=="postavshik"){
			newtable('2')
		}
		
		if (table_name=="salesman"){
			newtable('3')
		}
		
		if (table_name=="sklad"){
			newtable('4')
		}
		
		if (table_name=="sales"){
			newtable('5')
		}
	}
		
	if (globo_mod==2){
		tosearch();  
	}
}	
	
function kb(l){
var t =document.getElementById("character"+l.toString()).value;
var znak=['>','<','=','!=','>=','<=','(a,b)','[a,b]','[a,b)','(a,b]']
if (t==">" || t==">=" || t=="=" || t=="!="){
	document.getElementById("t_2"+l.toString()).style.visibility="visible";
	document.getElementById("t_1"+l.toString()).style.visibility="hidden";
}

if (t=="<" || t=="<="){
	document.getElementById("t_2"+l.toString()).style.visibility="hidden";
	document.getElementById("t_1"+l.toString()).style.visibility="visible";
}

if (t=='(a,b)' || t=='[a,b]' || t=='[a,b)' || t=='(a,b]'){
	document.getElementById("t_1"+l.toString()).style.visibility="visible";
	document.getElementById("t_2"+l.toString()).style.visibility="visible";
}
}	

function give_search(arr,names){
	var ans=[]
	var arr_u=[]
	var e=0
	var mystr=''
	var first=0;
	
	for (t=0;t<arr.length;t++){
		for (l=0;l<arr[t].length;l++){
			if ((names[t]=="greeds" && l==0) || (names[t]=="personal" && (l==0 || l==5 || l==6)) ||
				(names[t]=="postavshik" && (l==1 || l==3 || l==4)) ||
				(names[t]=="sklad" && l==1) || (names[t]=="sales" && (l==0 || l==1))
			){
			
			
			var p=document.getElementById("textfield_"+l.toString()+'_'+names[t]).value
			
			if (p.length==1){
				p='LIKE "'+p+'%"'	
			}
			
			if (p.length>=2){
				if (p[0]=='*' && p[p.length-1]=='*'){
					p=p.slice(1)
					p=p.slice(0,-1)
					p='LIKE "%'+p+'%"'	
				}
			}
	
			if (p.length>1){
				if (p[0]=='*' && p[p.length-1]!='*'){
						p=p.slice(1)
						p='LIKE "%'+p+'"'	
				}
			}
			
			if (first==0 && p.length!=""){ //начало условия без and
				mystr=mystr+arr[t][l]
				if (p.indexOf('LIKE') + 1){
					arr_u.push(arr[t][l]+p)
				} else {
					arr_u.push(arr[t][l]+"= "+"'"+p+"'")
				}
				first=1;
				continue
			}
				
			if (first==1 && p.length!=""){
				if (p.indexOf('LIKE') + 1){
					arr_u.push(" AND "+arr[t][l]+p)
				} else {
					arr_u.push(" AND "+arr[t][l]+"= "+"'"+p+"'")
				}
				mystr=mystr+",`"+arr[t][l]+"`"
			  }
			} 
			
			else {
				if ((names[t]=="greeds" && (l==1 || l==5 || l==6)) || (names[t]=='personal' && (l==1 || l==3 || l==4))
					|| (names[t]=="salesman" && l==2) || (names[t]=="sklad" && (l==2 || l==3))
					|| (names[t]=="sales" && (l==2 || l==5))
				){
					var znak=document.getElementById("character"+l.toString()).value
					var fl_vis=1;
					
					if (document.getElementById("t_1"+l.toString()).style.visibility=="hidden" &&
						document.getElementById("t_2"+l.toString()).style.visibility=="hidden"){
						fl_vis=0;
					}
					
					if ((fl_vis==1) && (znak=='>' || znak=='>=' || znak=='=' || znak=='!=')){
						var b=document.getElementById("t_2"+l.toString()).value
						mystr=mystr+arr[t][l]
						
						if (first==0 && b.length!=""){
							if (znak=='>'){
								arr_u.push(arr[t][l]+">"+"'"+b+"'")
							}
						
							if (znak=='=>'){
								arr_u.push(arr[t][l]+">="+"'"+b+"'")
							}
						
							if (znak=='='){
								arr_u.push(arr[t][l]+"="+"'"+b+"'")
							}
						
							if (znak=='!='){
								arr_u.push(arr[t][l]+"!="+"'"+b+"'")
							}
							
							first=1;
						}
						
						if (first==1 && b.length!=""){
							if (znak=='>'){
								arr_u.push(" AND "+arr[t][l]+">"+"'"+b+"'")
							}
						
							if (znak=='=>'){
								arr_u.push(" AND "+arr[t][l]+"=>"+"'"+b+"'")
							}
						
							if (znak=='='){
								arr_u.push(" AND "+arr[t][l]+"="+"'"+b+"'")
							}
						
							if (znak=='!='){
								arr_u.push(" AND "+arr[t][l]+"!="+"'"+b+"'")
							}
						}
					}
					
					if ((fl_vis==1) && (znak=='<' || znak=='<=')){
						var b=document.getElementById("t_1"+l.toString()).value
						mystr=mystr+arr[t][l]
						if (znak=='<' && b.length!=""){
							if (first==0){
								arr_u.push(arr[t][l]+"<"+"'"+b+"'")
								first=1;
							} else {
								arr_u.push(" AND "+arr[t][l]+"<"+"'"+b+"'")
							}
						}
						
						if (znak=='<=' && b.length!=""){
							if (first==0){
								arr_u.push(arr[t][l]+"<="+"'"+b+"'")
								first=1;
							} else {
								arr_u.push(" AND "+arr[t][l]+"<="+"'"+b+"'")
							}
						}

					}
					
					
					if ((fl_vis==1) && (znak=='(a,b)' || znak=='[a,b]' || znak=='[a,b)' || znak=='(a,b]')){
						var a=document.getElementById("t_1"+l.toString()).value
						var b=document.getElementById("t_2"+l.toString()).value
						mystr=mystr+arr[t][l]
						if (znak=='(a,b)' && a.length!="" && b.length!=""){
							if (first==0){
								arr_u.push(arr[t][l]+">"+"'"+a+"' AND "+arr[t][l]+"<"+"'"+b+"'")
							    first=1;
							} else {
								arr_u.push(' AND '+arr[t][l]+">"+"'"+a+"' AND "+arr[t][l]+"<"+"'"+b+"'")
							}
						}
						
						if (znak=='[a,b)' && a.length!="" && b.length!=""){
							if (first==0){
								arr_u.push(arr[t][l]+">="+"'"+a+"' AND "+arr[t][l]+"<"+"'"+b+"'")
								first=1
							} else {
								arr_u.push(' AND '+arr[t][l]+">="+"'"+a+"' AND "+arr[t][l]+"<"+"'"+b+"'")	
							}
						}
						
						if (znak=='(a,b]' && a.length!="" && b.length!=""){
							if (first==0){
								arr_u.push(arr[t][l]+">"+"'"+a+"' AND "+arr[t][l]+"<="+"'"+b+"'")
								first=1
							} else {
								arr_u.push(' AND '+arr[t][l]+">"+"'"+a+"' AND "+arr[t][l]+"<="+"'"+b+"'")	
							}
						}
						
						if (znak=='[a,b]' && a.length!="" && b.length!=""){
							if (first==0){
								arr_u.push(arr[t][l]+">="+"'"+a+"' AND "+arr[t][l]+"<="+"'"+b+"'")
								first=1
							} else {
								arr_u.push(' AND '+arr[t][l]+">="+"'"+a+"' AND "+arr[t][l]+"<="+"'"+b+"'")	
							}
						}
					}
					
				}
				
				
				/*------------ Комбобоксы ----------------------*/
				
				if ((names[t]=="personal" && l==2) || (names[t]=="greeds" && ((l==2)||(l==3) || (l==4)))
						|| (names[t]=="postavshik" && (l==0 || l==2))
						|| (names[t]=="salesman" && l!=2)
						|| (names[t]=="sklad" && (l==0 || l==4) || (names[t]=="sales" && (l==3 || l==4))) 
				){
					var p=document.getElementById("textfield"+l.toString()+'_'+names[t]).value
					
					if (first==0 && p.length!=""){ //начало условия без and
						mystr=mystr+arr[t][l]
						arr_u.push(arr[t][l]+"= "+"'"+p+"'")
						first=1;
						continue
					}
				
				if (first==1 && p.length!=""){
					arr_u.push(" AND "+arr[t][l]+"= "+"'"+p+"'")
					mystr=mystr+","+arr[t][l]
					
				}
			}
			}
		}
	}
    		
	
	ans.push(mystr)
	ans.push(arr_u)
	
	return ans;
	
}

function getDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; 
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 

  today = yyyy + '-' + mm + '-' + dd;
  return today;
}

window.onload = function() {
	var tables=['greeds','personal','postavshik','salesman','sklad','sales']
	var st=''
	var st_=''
	for (i=0;i<tables.length;i++){
		st=st+'<div id="'+i.toString()+'" onclick="newtable('+i.toString()+')">'+tables[i]+'</div><br>';
		st_=st_+'<div><input type="checkbox" onchange="add_q('+i.toString()+')" style="transform: scale(2)" id="q_'+i.toString()+'"></div><br>'
	}
	
	document.getElementById('mydiv2').innerHTML=st;
	document.getElementById('mydiv9').innerHTML=st_;
    document.getElementById('0').style.color="blue";		
	newtable('0')
	
};


</script>
</body>
</html>