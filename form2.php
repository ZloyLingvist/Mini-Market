<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"></script>
<script language="JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>    
<link href="style.css" rel="stylesheet">

<title>Мини-маркет</title>
</head>
<body>

<div id="mydiv1"><br>Работа с таблицами <br><div id="mydiv2">
</div><div id="mydiv9"></div>

<div id="mydiv3">Текущая таблица <br></div>
<div id="mydiv4"><br>
<button name="Ввод" onclick="dob()" id="vvod">Ввод</button>
<button value="Добавить" onclick="dob()" id="dob">Добавить</button>
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
<script>

var globo_mod=0;
var where_work=0;

/* Добавление записей в таблицу */

function dob(){
	var m=['0','1','2','3','4','5'];
	
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			var table_name=document.getElementById(m[l]).innerHTML;
			document.getElementById("q_"+l.toString()).checked=false;
			break
		}	
	}
	
	if (table_name=="postavshik"){
		document.getElementById("textfield0_postavshik").style.display="none"
		document.getElementById("mydiv5").innerHTML+="<input class='otdel' id='textfield_0_postavshik'>"
	}
	
	if (table_name=="greeds"){
		document.getElementById("textfield2_greeds").style.display="none"
		document.getElementById("mydiv5").innerHTML+="<input class='otdel' id='textfield_2_greeds'>"
	}
	
	if (table_name=="personal"){
		document.getElementById("textfield2_personal").style.display="none"
		document.getElementById("mydiv5").innerHTML+="<input class='otdel' id='textfield_2_personal'>"
	}
	
	if (table_name=="salesman"){
		document.getElementById("textfield5_salesman").style.display="none"
		document.getElementById("mydiv5").innerHTML+="<input class='otdel' id='textfield_5_salesman'>"
	}
	

	document.getElementById('mydiv8').innerHTML='<br><div id="whatido">Добавление</div><br>'+
	'<button onclick="ochist()">Очистить</button> <button onclick="transfer()">Ok'+
	'</button> <button onclick="newtable('+m[l]+')">Назад</button>'
}
function transfer(){ 
	var m=['0','1','2','3','4','5'];
	var arr1=['Наименование','Цена(сум)','Производитель','Отдел','Срок хранения (суток)','Кол-во в отделе(штук)'] //greeds
	var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
	var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)'] //postavshik
	var arr4=['ФИО','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус'] //salesman
	var arr5=['Товар','Поставщик','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
	var arr6=['Дата продажи','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
	var m=['0','1','2','3','4','5'];
	var arr=[]
	var st=''
	var tmp=[]
	var k=''
	
	for (l=0;l<m.length;l++){
		var color=document.getElementById(m[l]).style.color;
		if (color=="blue"){
			var table_name=document.getElementById(m[l]).innerHTML;
			document.getElementById("q_"+l.toString()).checked=false;
			break
		}	
	}

	if (table_name=="greeds"){
		arr=arr1;
		k='0'
		
		for (i=0;i<arr.length;i++){
			if (i!=3){
				var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
				if (r.length!=""){
					r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name)	.value+'"'
				} else {
					alert('Заполните пожалуйста все поля')
					return 0
				}
			}
		
			if (i==3){
				var r=document.getElementById("textfield"+i.toString()+"_"+table_name)	.value
				if (r.length!=""){
					r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
				} else {
					alert('Заполните пожалуйста все поля')
					return 0
				}
			}
			
			tmp.push(r)
	}
	
	st="INSERT INTO greeds (`Наименование`,`Цена(сум)`, `Производитель`, `Код отдела`,`Срок хранения (суток)`,`Кол-во в отделе(штук)`) "+
	"SELECT "+tmp[0]+","+tmp[1]+","+tmp[2]+","+
	"( SELECT `Номер` FROM otdel WHERE `Отдел`="+tmp[3]+"),"+tmp[4]+","+tmp[5]
	
	}

	if (table_name=="personal"){
		arr=arr2;
		k='1'
		for (i=0;i<arr.length;i++){
				var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
				if (r.length!=""){
					r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
				} else {
					alert('Заполните пожалуйста все поля')
					return 0
			}
		
		tmp.push(r)
	}
	st="INSERT INTO personal (`ФИО`,`Трудовой стаж (лет)`, `Должность`,`Зарплата (сум)`,`Возраст (лет)`,`Адрес`,`Телефон`) VALUES ("+tmp[0]+","+tmp[1]+","+tmp[2]+","+tmp[3]+","+tmp[4]+","+tmp[5]+","+tmp[6]+")"
}
if (table_name=="postavshik"){
	arr=arr3;
	k='2'

	for (i=0;i<arr.length;i++){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}

		tmp.push(r)
	}
	st="INSERT INTO postavshik (`Поставщик`,`Дата поставки`, `Юридический адрес`,`Телефон`,`Цена поставки(сум)`,`Оплачено(процент)`,`Поставлено товара(штук)`)"+
	" SELECT "+tmp[0]+","+tmp[1]+","+tmp[2]+","+tmp[3]+","+tmp[4]+","+tmp[5]+","+tmp[6]
}

if (table_name=="salesman"){
	arr=arr4;
	k='3'
	
	for (i=0;i<arr.length;i++){
		if (i==0 || i==2){
			var r=document.getElementById("textfield"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i!=0 && i!=2){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		tmp.push(r)
	}
	
	st="INSERT INTO salesman (`Код сотрудника`, `План по прибыли(сум/месяц)`,`График работы`,`Премия(процент от продаж)`,`Работа в магазине(лет)`,`Статус`)"+
	"SELECT ( SELECT pl.`Номер` FROM (personal pl LEFT JOIN salesman sl ON pl.`Номер`=sl.`Код сотрудника`) WHERE pl.`ФИО`="+tmp[0]+"),"+
	tmp[1]+","+tmp[2]+","+tmp[3]+","+tmp[4]+","+tmp[5]
}
if (table_name=="sklad"){
	arr=arr5;
	k='4'
	for (i=0;i<arr.length;i++){
		if (i!=0 && i!=4 && i!=1){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==0 || i==4 || i==1){
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
	
	st="INSERT INTO sklad (`Код товара`,`Код поставки`, `Номер стеллажа`,`Номер полки`,`Получил`,`На складе(штук)`)"+
	" SELECT ( SELECT `Номер` FROM greeds WHERE `Наименование`="+tmp[0]+"),( SELECT `Номер` FROM postavshik "+
	" WHERE `Поставщик`="+tmp[1]+"),"+tmp[2]+","+tmp[3]+",("+
	" SELECT `Номер` FROM personal "+
	 "WHERE `ФИО`="+tmp[4]+"),"+tmp[5]
	console.log(st)
}

if (table_name=="sales"){
	arr=arr6;
	k='5'
	for (i=0;i<arr.length;i++){
		if (i!=2 && i!=3){
			var r=document.getElementById("textfield_"+i.toString()+"_"+table_name).value;
			if (r.length!=""){
				r='"'+document.getElementById("textfield_"+i.toString()+"_"+table_name).value+'"'
			} else {
				alert('Заполните пожалуйста все поля')
				return 0
			}
		}
		
		if (i==2 || i==3){
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
	
	st="INSERT INTO sales (`Дата продажи`,`Количество(штук)`,`Код продавца`,`Код товара`,`Скидка (процент)`)"+
	" SELECT "+tmp[0]+","+tmp[1]+","+
	" ( SELECT `Номер` FROM salesman WHERE `Код сотрудника`=(SELECT `Номер` FROM personal WHERE `ФИО`="+tmp[2]+
	")), (SELECT `Номер` FROM greeds WHERE `Наименование`="+tmp[3]+"),"+tmp[4]	
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
			document.getElementById("mydiv5").innerHTML=''
			newtable(k)
		} 
	}
	});
}

//////////////////////////////////////////////

/* Показ таблиц, полей для ввода*/
function showtable(arr,tmp,name){
/// arr-массив с названиями полей текущей таблицы
/// tmp-выводимые данные
var i;
document.getElementById('mydiv3').innerHTML="<br>Текущая таблица<br>"
var st1='<br><table id="TID">'
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
			if (name=="greeds" && arr[i]=="Кол-во на складе(штук)"){
				arr[i]="На складе(штук)"
			}
			if (name=="sklad"){
				if (arr[i]=="Получил"){
					arr[i]="ФИО"
				}
				if (arr[i]=="Товар"){
					arr[i]="Наименование"
				}
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
	
	   if (what=='Поставщик'){
		 str="SELECT `Поставщик` FROM postavshik"  
	   }
	}
	
	if (name=="salesman"){
		var k=3;
		
		if (what=='График работы'){
			str="SELECT `График` FROM job"
		}
		
		if (what=='Статус'){
				str="SELECT `Статус` FROM salesman"
		}
		
		if (what=='ФИО'){
				str="SELECT `ФИО` FROM personal WHERE `Должность`='Продавец'"
		}
	}
	
	if (name=="sklad"){
		var k=4;
		var a=''
		if (what=='Поставщик'){
			str="SELECT `Поставщик` FROM postavshik"
		}	
		
		if (what=='Товар'){
			str="SELECT `Наименование` FROM greeds"
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
		
		st2=what+' '+'<select class="asel" id="textfield'+id.toString()+'_'+name+'"><option selected disabled hidden value=""></option><option></option>'
		
		for (i=0;i<tmp.length;i++){
			if (what=="Получил" || (what=="Продавец" && name=="sales")){
				what="ФИО"
			}
			
			if (what=="Товар" && (name=="sales" || name=="sklad")){
			  what="Наименование"	
			}
			
			if (what=="График работы" && name=="salesman"){
			  what="График"	
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
			
			if ((what=="ФИО" || what=="Наименование" || what=="Поставщик") && name=="sklad"){
			  st2=st2+'<br>'	
			}
			
			if ((what=="Статус" || what=="ФИО" || what=="График") && name=="salesman"){
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
	   if (k=="greeds"){
		  if (arr[l]=="Кол-во в отделе(штук) на текущий момент"){
			continue
		 }
	   }
	   
	   if (k=="salesman" && (arr[l]=="Оплата при выполнении плана")){
		   continue
	   }
	   
	   if (k=="sales" && (arr[l]=="Цена со скидкой")){
			continue
	   }
	   
	   if (k=="postavshik" && (arr[l]=="Нужно оплатить")){
			continue
	   }
	   
	   if (k=="greeds" && (arr[l]=="Производитель" || arr[l]=="Отдел")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   } 
	   
	   if (k=="personal" && (arr[l]=="Должность")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   } 
	   
	    if (k=="postavshik" && (arr[l]=="Поставщик")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   } 
	   	  
	   if (k=="salesman" && (arr[l]=="Статус" || arr[l]=="ФИО" || arr[l]=="График работы")){
		   selection(k,arr[l],l,st)
		   flag=1;  
	   }
	   
	   if (k=="sklad" && (arr[l]=="Получил" || arr[l]=="Товар" || arr[l]=="Поставщик")){
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
			   
			st=st+arr[l]+'<br><br><input type="text" class="otdel" maxlength="6"   size="3" style="visibility:hidden" id="t_1'+l.toString()+k+'">'+
			'<select class="mysel" id="character'+l.toString()+k+'" onchange="kb(this)"><option selected disabled hidden value=""></option>'
			
			for (j=0;j<znak.length;j++){
				st=st+'<option>'+znak[j]+'</option>'
			}	
				st=st+'</select> <input type="text" class="otdel" maxlength="6"  size="3" style="visibility:hidden"  id="t_2'+l.toString()+k+'"><br><br>'
				
			} else {
				if (arr[l].indexOf('Дата') + 1){
				    st=st+arr[l]+' '+'<input type="date" data-date-format="YYYY MMMM DD"  maxlength="10"   size="10" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				} else {
					st=st+arr[l]+' '+'<input class="tf" type="text" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				}
			}
		  } else {
			  if (arr[l].indexOf('Дата') + 1){
				    st=st+arr[l]+' '+'<input type="date" data-date-format="YYYY MMMM DD"  maxlength="10"   size="10" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				} else {
					st=st+arr[l]+' '+'<input class="tf" type="text" id="textfield_'+l.toString()+'_'+k+'"><br><br>'
				}
		  }
	   }
	}
	
	document.getElementById("mydiv5").innerHTML+=st
}
function newtable(k){
 var arr1=['Наименование','Цена(сум)','Производитель','Отдел','Срок хранения (суток)','Кол-во в отделе(штук)','Кол-во в отделе(штук) на текущий момент'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)','Нужно оплатить'] //postavshik
 var arr4=['ФИО','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус','Оплата при выполнении плана'] //salesman
 var arr5=['Товар','Поставщик','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
 var arr6=['Дата продажи','Количество(штук)','Продавец','Товар','Скидка (процент)','Цена со скидкой']//sales
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
   	 str2="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,"+
	 "g.`Кол-во в отделе(штук)`,(@i:=g.`Кол-во в отделе(штук)`-( SELECT SUM(`Количество(штук)`) "+
	 "FROM sales WHERE `Код товара`=g.`Номер`)) AS `Кол-во в отделе(штук) на текущий момент` "+
	 "FROM (greeds g LEFT JOIN otdel o ON g.`Код Отдела`=o.`Номер`)";
 }
 
 if (k=='1'){
   str="personal"
   str2="SELECT p.`ФИО`,p.`Трудовой стаж (лет)`,p.`Должность`,p.`Зарплата (сум)`,p.`Возраст (лет)`,p.`Адрес`,p.`Телефон` FROM personal p"; 
 }
 
 if (k=='2'){
   str="postavshik"
   str2="SELECT `Поставщик`,`Дата поставки`,`Юридический адрес`,`Телефон`,`Цена поставки(сум)`,`Оплачено(процент)`,"+
   "`Поставлено товара(штук)`,(@i:=`Цена поставки(сум)`-`Цена поставки(сум)`*`Оплачено(процент)`/100) AS `Нужно оплатить` FROM postavshik "
 }
 
 if (k=='3'){
   str="salesman"
   str2="SELECT p.`ФИО`,s.`План по прибыли(сум/месяц)`,s.`График работы`,s.`Премия(процент от продаж)`,"+
   "s.`Работа в магазине(лет)`,s.`Статус`,(@i:=p.`Зарплата (сум)`+s.`План по прибыли(сум/месяц)`* s.`Премия(процент от продаж)`/100) "+
   "AS `Оплата при выполнении плана` FROM salesman s LEFT JOIN personal p ON s.`Код сотрудника`=p.`Номер`";	 
 }
 
 if (k=='4'){
   str="sklad"
   str2="SELECT g.`Наименование`,pt.`Поставщик`,s.`Номер стеллажа`,s.`Номер полки`,p.`ФИО`, "+
   "s.`На складе(штук)` FROM (sklad s LEFT JOIN personal p ON s.`Получил`=p.`Номер`) LEFT JOIN greeds g ON g.`Номер`=s.`Код товара`"+
   "LEFT JOIN postavshik pt ON s.`Код поставки`=pt.`Номер`"
 }
 
 if (k=='5'){
   str="sales"
   str2="SELECT s.`Дата продажи`,s.`Количество(штук)`,p.`ФИО`,g.`Наименование`,s.`Скидка (процент)`"+
   ",(@i:=s.`Количество(штук)`*(g.`Цена(сум)`-g.`Цена(сум)`* s.`Скидка (процент)`/100)) "+
   "AS `Цена со скидкой` FROM (sales s LEFT JOIN greeds g ON s.`Код товара`=g.`Номер`) LEFT "+
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
			//document.getElementById(st).style.backgroundColor="#f2f2f2"
		}	
	}
}

//////////////////////////////////////////////

function give_tablename_and_id(m){
var arr1=['Наименование','Цена(сум)','Производитель','Отдел','Срок хранения (суток)','Кол-во в отделе(штук)'] //greeds
var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)'] //postavshik
var arr4=['ФИО','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус'] //salesman
var arr5=['Товар','Поставщик','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
var arr6=['Дата продажи','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
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
 var arr1=['Наименование','Цена(сум)','Производитель','Отдел','Срок хранения (суток)','Кол-во в отделе(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)'] //postavshik
 var arr4=['ФИО','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус'] //salesman
 var arr5=['Товар','Поставщик','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
 var arr6=['Дата продажи','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
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
		} 
	}
	});
	
	
}

/* Редактирование*/
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
			var st="SELECT `Производитель` FROM `greeds`"
			zapros(st,"dc_2",'Производитель',0)
			
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
	}
	
	if (table_name=="salesman"){
			var st="SELECT `ФИО` FROM `personal` WHERE `Должность`='Продавец'"
			zapros(st,"dc_1",'ФИО',0)
		
			var st="SELECT `График` FROM `job`"
			zapros(st,"dc_2",'График',0)
			
			var st="SELECT `Статус` FROM `salesman`"
			zapros(st,"dc_3",'Статус',0)
	}
	
	if (table_name=="sklad"){
			var st="SELECT `Наименование` FROM `greeds`"
			zapros(st,"dc_1",'Наименование',0)
			
			var st="SELECT `Поставщик` FROM `postavshik`"
			zapros(st,"dc_2",'Поставщик',0)
			
			var st="SELECT `ФИО` FROM `personal`"
			zapros(st,"dc_3",'ФИО',0)
	}
	
	if (table_name=="sales"){
		var st="SELECT `ФИО` FROM `personal` WHERE `Должность`='Продавец'"
		zapros(st,"dc_1",'ФИО',0)
		
		var st="SELECT `Наименование` FROM `greeds`"
		zapros(st,"dc_2",'Наименование',0)
	}
	
	
	var tdItems = document.getElementsByTagName("td");
	
	$(document).bind("contextmenu",function(e){
		return false;
	});
	
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
	
	if (table_name=="greeds" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="greeds" && p==2){
		var dropDownContent = $("#dc_2").clone(true);
	}
    
	if (table_name=="greeds" && p==3){
		var dropDownContent = $("#dc_3").clone(true);
	}
	
	if (table_name=="personal" && p==2){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="postavshik" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="salesman" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="salesman" && p==2){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if (table_name=="salesman" && p==5){
		var dropDownContent = $("#dc_3").clone(true);
	}
	
	if (table_name=="sklad" && p==0){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="sklad" && p==1){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if (table_name=="sklad" && p==4){
		var dropDownContent = $("#dc_3").clone(true);
	}
	
	if (table_name=="sales" && p==2){
		var dropDownContent = $("#dc_1").clone(true);
	}
	
	if (table_name=="sales" && p==3){
		var dropDownContent = $("#dc_2").clone(true);
	}
	
	if ((table_name=="greeds" & (p==2 || p==3))
		|| (table_name=="personal" & (p==2))
		|| (table_name=="postavshik" & (p==0))
		|| (table_name=="salesman" & (p==0 || p==2 || p==5))
		|| (table_name=="sklad" & (p==0 || p==1 || p==4))
		|| (table_name=="sales" & (p==2 || p==3))
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
 var arr1=['Наименование','Цена(сум)','Производитель','Код отдела','Срок хранения (суток)','Кол-во в отделе(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)'] //postavshik
 var arr4=['Код сотрудника','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус'] //salesman
 var arr5=['Код товара','Код поставки','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
 var arr6=['Дата продажи','Количество(штук)','Код продавца','Код товара','Скидка (процент)']//sales
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
	
		
	var mystr=''		
	for (i=0;i<arr.length;i++){
			if (ans[0]=="greeds" && (arr[i]=='Код отдела')){
				if (arr[i]=='Код отдела'){
					mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM otdel WHERE `Отдел`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'3').innerHTML+"')"+'\,'
				}
				continue
			}
			
			if (ans[0]=="salesman" && (arr[i]=='Код сотрудника')){
					if (arr[i]=='Код сотрудника'){
						mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM personal WHERE `ФИО`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'0').innerHTML+"')"+'\,'
					}
					
					continue
			}
			
			if (ans[0]=="sklad" && (arr[i]=='Получил' || arr[i]=='Код товара' || arr[i]=='Код поставки')){
					if (arr[i]=='Код товара'){
						mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM greeds WHERE `Наименование`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'0').innerHTML+"')"+'\,'	
					}
					
					if (arr[i]=='Код поставки'){
						mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM postavshik WHERE `Поставщик`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'1').innerHTML+"')"+'\,'	
					}
					
					if (arr[i]=='Получил'){
						mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM personal WHERE `ФИО`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'4').innerHTML+"')"+'\,'	
					}
					continue
			}
			
			if (ans[0]=="sales" && (arr[i]=='Код продавца' || arr[i]=='Код товара')){
				if (arr[i]=='Код продавца'){
						mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM salesman WHERE `Код сотрудника`=(SELECT `Номер` FROM personal WHERE `Должность`="Продавец" AND `ФИО`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'2').innerHTML+"'))"+'\,'
				}
				
				if (arr[i]=='Код товара'){
						mystr=mystr+'`'+arr[i]+'`= \ (SELECT `Номер` FROM greeds WHERE `Наименование`='+
						"'"+document.getElementById('tabled_'+ans[1].toString()+'3').innerHTML+"')"+'\,'
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
	var st1='<br><table id="TID">'
	st1=st1+"<tr align='center'>"
					
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
			if ((names[t]=="greeds" && (l!=2 && l!=3)) || (names[t]=="personal" && l!=2) ||
				(names[t]=="postavshik" && l!=0) ||
				(names[t]=="salesman" && (l!=0 && l!=2 && l!=5)) ||
				(names[t]=="sklad" && l!=0 && l!=4 && l!=1) || (names[t]=="sales" && (l!=2 && l!=3))
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
				if ((names[t]=="personal" && l==2) || (names[t]=="greeds" && ((l==2)||(l==3)))
						|| (names[t]=="postavshik" && (l==0))
						|| (names[t]=="salesman" && (l==0 || l==2 || l==5))
						|| (names[t]=="sklad" && (l==0 || l==4 || l==1)) || (names[t]=="sales" && (l==2 || l==3)) 
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
	var arr1=['g.`Наименование`','g.`Цена(сум)`','g.`Производитель`','o.`Отдел`','g.`Срок хранения (суток)`','g.`Кол-во в отделе(штук)`'] //greeds
	var arr2=['pl.`ФИО`','pl.`Трудовой стаж (лет)`','pl.`Должность`','pl.`Зарплата (сум)`','pl.`Возраст (лет)`','pl.`Адрес`','pl.`Телефон`'] //personal
	var arr3=['pt.`Поставщик`','pt.`Дата поставки`','pt.`Юридический адрес`','pt.`Телефон`','pt.`Цена поставки(сум)`','pt.`Оплачено(процент)`','pt.`Поставлено товара(штук)`'] //postavshik
	var arr4=['pl.`ФИО`','sl.`План по прибыли(сум/месяц)`','sl.`График работы`','sl.`Премия(процент от продаж)`','sl.`Работа в магазине(лет)`','sl.`Статус`'] //salesman
	var arr5=['g.`Наименование`','pt.`Поставщик`','skl.`Номер стеллажа`','skl.`Номер полки`','pl.`ФИО`','skl.`На складе(штук)`']//sklad
	var arr6=['s.`Дата продажи`','s.`Количество(штук)`','pl.`ФИО`','g.`Наименование`','s.`Скидка (процент)`']//sales
	
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
			var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,"+
			"g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)` FROM (greeds g LEFT JOIN otdel o ON g.`Код Отдела`=o.`Номер`) "
		}
		
		if (names[0]=="personal pl"){
			var st="SELECT * FROM ("+names[0]+") "
		}
		
		if (names[0]=="postavshik pt"){
			var st="SELECT pt.`Поставщик`,pt.`Дата поставки`,pt.`Юридический адрес`,pt.`Телефон`, "+
			"pt.`Цена поставки(сум)`,pt.`Оплачено(процент)`,pt.`Поставлено товара(штук)` FROM postavshik pt "
		}
		
		if (names[0]=="salesman sl"){
				var st="SELECT pl.`ФИО`,sl.`План по прибыли(сум/месяц)`,sl.`График работы`,sl.`Премия(процент от продаж)`,"+
				"sl.`Работа в магазине(лет)`,sl.`Статус` FROM salesman sl "+
				"LEFT JOIN personal pl ON sl.`Код сотрудника`=pl.`Номер` "
		}
		
		if (names[0]=="sklad skl"){
			var st="SELECT g.`Наименование`,pt.`Поставщик`,skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` AS 'Получил',skl.`На складе(штук)` "+
			"FROM (sklad skl LEFT JOIN personal pl ON skl.`Получил`=pl.`Номер`) LEFT JOIN greeds g ON g.`Номер`=skl.`Код товара` "+
			"LEFT JOIN postavshik pt ON skl.`Код поставки`=pt.`Номер`"
		}
		
		if (names[0]=="sales s"){
				var st="SELECT s.`Дата продажи`,s.`Количество(штук)`,pl.`ФИО` AS 'Продавец',g.`Наименование`,s.`Скидка (процент)` "+
				"FROM (sales s LEFT JOIN greeds g ON s.`Код товара`=g.`Номер`) LEFT "+
				"JOIN salesman sl ON sl.`Номер`=s.`Код продавца` LEFT JOIN personal pl ON sl.`Код сотрудника`=pl.`Номер` "
		}
	}
	
	
	if (names.length==2){
		if ((names[0]=="greeds g" && names[1]=="sales s") || (names[1]=="greeds g" && names[0]=="sales s")) {
		  var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)`,"+
		  "s.`Дата продажи`,s.`Количество(штук)`,pl.`ФИО` AS `Продавец`,s.`Скидка (процент)`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		  st=st+ "s.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` LEFT JOIN sklad skl "+
		  "ON skl.`Код товара`=g.`Номер` LEFT JOIN salesman sl "+
		  "ON s.`Код продавца`=sl.`Номер` LEFT JOIN personal pl ON pl.`Номер`=sl.`Код сотрудника` "	
		  console.log(st)
		}
		
		if ((names[0]=="greeds g" && names[1]=="sklad skl") || (names[1]=="greeds g" && names[0]=="sklad skl")) {
		  var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)`,"+
		  "g.`Наименование`,pt.`Поставщик`,skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` AS 'Получил',skl.`На складе(штук)`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		  st=st+ "skl.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер`  "+
		  "LEFT JOIN personal pl ON skl.`Получил`=pl.`Номер` LEFT JOIN postavshik pt ON pt.`Номер`=skl.`Код поставки` "
		}
		
		if ((names[0]=="postavshik pt" && names[1]=="sklad skl") || (names[1]=="postavshik pt" && names[0]=="sklad skl")) {
		  var st="SELECT pt.`Поставщик`,pt.`Дата поставки`,pt.`Юридический адрес`,pt.`Телефон`,pt.`Цена поставки(сум)`,pt.`Оплачено(процент)`"+
		  ",pt.`Поставлено товара(штук)`,g.`Наименование`,skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` AS 'Получил',skl.`На складе(штук)`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		  st=st+ "skl.`Код поставки`=pt.`Номер`) LEFT JOIN greeds g ON g.`Номер`=skl.`Код товара`  "+
		  "LEFT JOIN personal pl ON skl.`Получил`=pl.`Номер`"
		}
		
		if ((names[0]=="personal pl" && names[1]=="sklad skl") || (names[1]=="personal " && names[0]=="sklad skl")) {
		  var st="SELECT pl.`ФИО` AS 'Получил',pl.`Трудовой стаж (лет)`,pl.`Должность`,pl.`Зарплата (сум)`,pl.`Возраст (лет)`,pl.`Адрес`,pl.`Телефон`,"+
		  "g.`Наименование`,pt.`Поставщик`,skl.`Номер стеллажа`,skl.`Номер полки`,skl.`На складе(штук)`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		  st=st+ "skl.`Получил`=pl.`Номер`)"+
		  "LEFT JOIN greeds g ON g.`Номер`=skl.`Код товара` LEFT JOIN postavshik pt ON pt.`Номер`=skl.`Код поставки` "
		}
		
		if ((names[1]=="salesman sl" && names[0]=="sales s") || (names[0]=="salesman sl" && names[1]=="sales s") ){
		  var st="SELECT s.`Дата продажи`,s.`Количество(штук)`,pl.`ФИО` AS `Продавец`,g.`Наименование`,s.`Скидка (процент)`,"+
		  "sl.`План по прибыли(сум/месяц)`,sl.`График работы`,sl.`Премия(процент от продаж)`,sl.`Работа в магазине(лет)`,sl.`Статус`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		  st=st+ "s.`Код продавца`=sl.`Номер`) LEFT JOIN personal pl ON sl.`Код сотрудника`=pl.`Номер` LEFT JOIN greeds g ON g.`Номер`=s.`Код товара`"	
		}
		
		
		if ((names[1]=="salesman sl" && names[0]=="personal pl") || (names[0]=="salesman sl" && names[1]=="personal pl") ){
		  var st="SELECT pl.`ФИО`,pl.`Трудовой стаж (лет)`,pl.`Должность`,pl.`Зарплата (сум)`,pl.`Возраст (лет)`,pl.`Адрес`,pl.`Телефон`,"+
		  "sl.`План по прибыли(сум/месяц)`,sl.`График работы`,sl.`Премия(процент от продаж)`,sl.`Работа в магазине(лет)`,sl.`Статус`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[1]+" ON "
		  st=st+ "sl.`Код сотрудника`=pl.`Номер`) "	
		}
	}
	
	if (names.length==3){
		if (names[0]=="greeds g" && names[1]=="salesman sl" && names[2]=="sales s"){
		  var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)`,"+
		  "s.`Дата продажи`,s.`Количество(штук)`,pl.`ФИО` AS 'Продавец',g.`Наименование`,s.`Скидка (процент)`"+
		  ",sl.`План по прибыли(сум/месяц)`,sl.`График работы`,sl.`Премия(процент от продаж)`,sl.`Работа в магазине(лет)`,sl.`Статус`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[2]+" ON "
		  st=st+ "s.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` "+
		  "LEFT JOIN salesman sl ON s.`Код продавца`=sl.`Номер` "+
		  "LEFT JOIN personal pl ON pl.`Номер`=sl.`Код сотрудника` "
		}
		
		if (names[0]=="greeds g" && names[2]=="sklad skl" && names[1]=="postavshik pt"){
		  var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)`,"+
		  "skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` AS `Получил товар на складе`,skl.`На складе(штук)`,"+
		  "pt.`Поставщик`,pt.`Дата поставки`,pt.`Юридический адрес`,pt.`Телефон`,pt.`Цена поставки(сум)`,pt.`Оплачено(процент)`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[2]+" ON "
		  st=st+ "skl.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` "+
		  "LEFT JOIN postavshik pt ON pt.`Номер`=skl.`Код поставки` "+
		  "LEFT JOIN personal pl ON pl.`Номер`=skl.`Получил` "
		}
		
		if (names[2]=="sklad skl" && names[1]=="postavshik pt" && names[0]=="personal pl"){
		  var st="SELECT "+
		  "skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` AS `Получил товар на складе`,skl.`На складе(штук)`,"+
		  "pt.`Поставщик`,pt.`Дата поставки`,pt.`Юридический адрес`,pt.`Телефон`,pt.`Цена поставки(сум)`,pt.`Оплачено(процент)`,"+
		  "pl.`ФИО`,pl.`Трудовой стаж (лет)`,pl.`Должность`,pl.`Зарплата (сум)`,pl.`Возраст (лет)`,pl.`Адрес`,pl.`Телефон`"+
		  " FROM ( sklad skl LEFT JOIN greeds g ON "
		  
		  st=st+ "skl.`Код товара`=g.`Номер`)"+
		  "LEFT JOIN postavshik pt ON pt.`Номер`=skl.`Код поставки` "+
		  "LEFT JOIN personal pl ON pl.`Номер`=skl.`Получил` "
		}
	}
	
	if (names.length==4){
		  if (names[0]=="greeds g" && names[3]=="sklad skl" && names[2]=="postavshik pt" && names[1]=="personal pl"){
		  var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)`,"+
		  "skl.`Номер стеллажа`,skl.`Номер полки`,pl.`ФИО` AS `Получил товар на складе`,skl.`На складе(штук)`,"+
		  "pt.`Поставщик`,pt.`Дата поставки`,pt.`Юридический адрес`,pt.`Телефон`,pt.`Цена поставки(сум)`,pt.`Оплачено(процент)`,"+
		  "pl.`ФИО`,pl.`Трудовой стаж (лет)`,pl.`Должность`,pl.`Зарплата (сум)`,pl.`Возраст (лет)`,pl.`Адрес`,pl.`Телефон`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[3]+" ON "
		  st=st+ "skl.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` "+
		  "LEFT JOIN postavshik pt ON pt.`Номер`=skl.`Код поставки` "+
		  "LEFT JOIN personal pl ON pl.`Номер`=skl.`Получил` "
		}
		
		if (names[0]=="greeds g" && names[1]=="personal pl" && names[2]=="salesman sl" && names[3]=="sales s"){
		  var st="SELECT g.`Наименование`,g.`Цена(сум)`,g.`Производитель`,o.`Отдел`,g.`Срок хранения (суток)`,g.`Кол-во в отделе(штук)`,"+
		  "s.`Дата продажи`,s.`Количество(штук)`,pl.`ФИО` AS 'Продавец',g.`Наименование`,s.`Скидка (процент)`"+
		  ",sl.`План по прибыли(сум/месяц)`,sl.`График работы`,sl.`Премия(процент от продаж)`,sl.`Работа в магазине(лет)`,sl.`Статус`"+
		  ", pl.`Трудовой стаж (лет)`,pl.`Должность`,pl.`Зарплата (сум)`,pl.`Возраст (лет)`,pl.`Адрес`,pl.`Телефон`"+
		  " FROM ("+names[0]+" LEFT JOIN "+names[3]+" ON "
		  st=st+ "s.`Код товара`=g.`Номер`) LEFT JOIN otdel o ON g.`Код отдела`=o.`Номер` "+
		  "LEFT JOIN salesman sl ON s.`Код продавца`=sl.`Номер` "+
		  "LEFT JOIN personal pl ON pl.`Номер`=sl.`Код сотрудника` "
		}
		
	}
	
	if (ans[1].length>0){
		st=st+" WHERE "
	} 
	
	for (l=0;l<ans[1].length;l++){
		st=st+ans[1][l]
	}

	console.log(st)
	
	$.ajax ({
	type:"POST",
	url : "refresh.php",
	data : {str:st},
	dataType : "json",	
	success: function(data){
		var str = JSON.stringify(data);
		var tmp = JSON.parse(str);
		
		if (tmp.length>0){
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
 var arr1=['Наименование','Цена(сум)','Производитель','Отдел','Срок хранения (суток)','Кол-во в отделе(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)'] //postavshik
 var arr4=['ФИО','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус'] //salesman
 var arr5=['Товар','Поставщик','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
 var arr6=['Дата продажи','Количество(штук)','Продавец','Товар','Скидка (процент)']//sales
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
 var arr1=['Наименование','Цена(сум)','Производитель','Отдел','Срок хранения (суток)','Кол-во в отделе(штук)'] //greeds
 var arr2=['ФИО','Трудовой стаж (лет)','Должность','Зарплата (сум)','Возраст (лет)','Адрес','Телефон'] //personal
 var arr3=['Поставщик','Дата поставки','Юридический адрес','Телефон','Цена поставки(сум)','Оплачено(процент)','Поставлено товара(штук)','Нужно оплатить'] //postavshik
 var arr4=['ФИО','План по прибыли(сум/месяц)','График работы','Премия(процент от продаж)','Работа в магазине(лет)','Статус','Оплата при выполнении плана'] //salesman
 var arr5=['Товар','Поставщик','Номер стеллажа','Номер полки','Получил','На складе(штук)']//sklad
 var arr6=['Дата продажи','Количество(штук)','Продавец','Товар','Скидка (процент)','Цена со скидкой']//sales
 var m=['0','1','2','3','4','5'];
 
 //test
 var count=0;
 for (r=0;r<m.length;r++){
	   var checkBox = document.getElementById("q_"+r.toString());
	   if (checkBox.checked == true){
		count++;
	   }
	   
	   if (count>4){
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
		globo_mod=0
	}
}	
function kb(id_){
	var table_name='greeds'
	id=id_.id.split('character')
	var t =document.getElementById("character"+id[1]).value;
	var znak=['>','<','=','!=','>=','<=','(a,b)','[a,b]','[a,b)','(a,b]']

	if (t==">" || t==">=" || t=="=" || t=="!="){
		document.getElementById("t_2"+id[1]).style.visibility="visible";
		document.getElementById("t_1"+id[1]).style.visibility="hidden";
	}
	
	if (t=="<" || t=="<="){
		document.getElementById("t_2"+id[1]).style.visibility="hidden";
		document.getElementById("t_1"+id[1]).style.visibility="visible";
	}
	
	if (t=='(a,b)' || t=='[a,b]' || t=='[a,b)' || t=='(a,b]'){
		document.getElementById("t_1"+id[1]).style.visibility="visible";
		document.getElementById("t_2"+id[1]).style.visibility="visible";
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
			if ((names[t]=="greeds" && (l==0)) || (names[t]=="personal" && (l==0 && l==5 && l==6)) ||
				(names[t]=="postavshik" && (l==1 || l==2 || l==3)) ||
				(names[t]=="sales" && (l==0))
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
			
			if ((names[t]=="greeds" && (l==1 || l==4 || l==5)) || (names[t]=='personal' && (l==1 || l==3 || l==4))
					|| (names[t]=="postavshik" && ((l==4) || (l==5) || (l==6))) 
					|| (names[t]=="salesman" && (l==1 || l==3 || l==4 || l==6)) 
					|| (names[t]=="sklad" && (l==2 || l==3 || l==5))
					|| (names[t]=="sales" && (l==1 || l==4 || l==5)))
			{
					
					console.log("character"+l.toString()+names[t])
					var znak=document.getElementById("character"+l.toString()+names[t]).value
					var fl_vis=1;
					
					if (document.getElementById("t_1"+l.toString()+names[t]).style.visibility=="hidden" &&
						document.getElementById("t_2"+l.toString()+names[t]).style.visibility=="hidden"){
						fl_vis=0;
					}
					
					if ((fl_vis==1) && (znak=='>' || znak=='>=' || znak=='=' || znak=='!=')){
						var b=document.getElementById("t_2"+l.toString()+names[t]).value
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
						var b=document.getElementById("t_1"+l.toString()+names[t]).value
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
						var a=document.getElementById("t_1"+l.toString()+names[t]).value
						var b=document.getElementById("t_2"+l.toString()+names[t]).value
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
			
			if (names[t]=="greeds" && (l==2 || l==3)){
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
			
			if (names[t]=="personal" && l==2){
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
			
			if (names[t]=="postavshik" && (l==0)){
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
			
			//console.log("textfield"+l.toString()+'_'+names[t])
			if (names[t]=="salesman" && ((l==0) || (l==2) || (l==5))){
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
			
			if (names[t]=="sklad" && (l==0 || l==1 || l==4)){
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
			
			if (names[t]=="sales" && (l==2 || l==3)){
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