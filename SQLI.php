<html>
<head><title>SQLi Scanner</title>
<link rel="shortcut icon" href="../favicon.ico">
<!-- 2013 Revan Aditya -->
<script type="text/javascript">
jalan = false;
nomer = 1;
nomermax = 100;
heavy = false;

function ajax(vars, nom, cbFunction){
	var req = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP.3.0");
	var querystring = '?' + vars + '&page=' + nom;
	req.open("GET", querystring , true);
	req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function(){
		if (req.readyState == 4 && req.status == 200){
			if (req.responseText){
			  cbFunction(req.responseText,vars);
			}
		}
	}
	req.send(null);
}
function showResult(str, vars){
	var box = document.getElementById("result")
	if(str.match(/Warning|Fatal/gi)) box.innerHTML += '<span class=\"red\">*** </span> error...<br />';
	else box.innerHTML += str;

	if(!jalan){
		box.innerHTML += '<span class=\"red\">*** </span> paused...<br />';
		document.getElementById("loading").style.visibility = 'hidden';
		document.getElementById("btnOk").value = "Resume";
	}
	else {
		if(!str.match(/.*finish.*/gi)){
			sqlCheck(vars);
		}
		else{
			var pesan = str.substring(str.indexOf("|") + 1);
			box.innerHTML = '<span class=\"red\">*** </span> finish ( ' + pesan + ' )<br />';
			document.getElementById('setype').disabled = false;
			document.getElementById('dork').readOnly = false;
			document.getElementById("loading").style.visibility = 'hidden';
			document.getElementById("btnOk").value = "Search";
			nomer = 1;
			jalan = false;
		}
	}

	var oldYPos = 0, newYPos = 0;
	do{
		if (document.all){
			oldYPos = document.body.scrollTop;
		}
		else{
			oldYPos = window.pageYOffset;
		}
		window.scrollBy(0, 50);
		if (document.all){
			newYPos = document.body.scrollTop;
		}
		else{
			newYPos = window.pageYOffset;
		}
	} while (oldYPos < newYPos);
}
function keyHandler(ev){
	if (!ev){
		ev = window.event;
	}
	if (ev.which){
		keycode = ev.which;
	}
	else if (ev.keyCode){
		keycode = ev.keyCode;
	}
	if (keycode == 13){
		sikat();
	}
}
String.prototype.trim = function() {
	return this.replace(/^\s*|\s*$/g, "");
}
function sqlCheck(xdata){
	if(jalan){
		ajax(xdata, nomer, showResult);
		nomer++;
	}
}
function sqlHeavyCheck(xdata){
	if(jalan){
		ajax(xdata + '&heavy=1', nomer, showResult);
		nomer++;
	}
}
function sikat(){
	var btext = document.getElementById("btnOk");
	if((btext.value == 'Search') || (btext.value == 'Resume')){
		if(!jalan){
			if(btext.value == 'Search') nomer = 1;
			var target = document.getElementById('dork');
			var setype = document.getElementById('setype');
			if(target.value.trim().length>0) {
				document.getElementById("loading").style.visibility = 'visible';
				document.getElementById("btnOk").value = "Pause";
				target.readOnly = true;
				setype.disabled = true;
				jalan = true;
				sqlCheck('dork=' + encodeURIComponent(target.value) + '&setype=' + encodeURIComponent(setype.value));
			}
		}
		else alert("Please stop first...");
	}
	else {
		berhenti();
	}
}
function initpg(){
	document.onkeypress = keyHandler;
}
function berhenti(){
	jalan = false;
}
function bersih(){
	var tanya = confirm("Clear results and restart?");
	if(tanya == true) location.href = 'index.php';
}
function checkheavy_fix(){
	var heavyval = document.getElementById("heavy");
	if(heavyval.checked) heavyval.checked = false;
	else heavyval.checked = true;
	checkheavy();
}
function checkheavy(){
	var heavyval = document.getElementById("heavy").checked;
	var box = document.getElementById("result")
	if(heavyval) {
		heavy = true;
		box.innerHTML += '<span class=\"red\">*** </span> depth scan...<br />';
	}
	else {
		heavy = false;
		box.innerHTML += '<span class=\"red\">*** </span> quick scan...<br />';
	}
}

</script>
<style type="text/css">
*{
	background:url('../images/bg.gif') #111;
	font-family: Lucida Console,Tahoma;
	color:#bbb;
	font-size:11px;
	text-align:left;
}
input,select,textarea{
	border:0;
	border:1px solid #900;
	color:#fff;
	background:#000;
	margin:0;
	padding:2px 4px;
}
input:hover,textarea:hover,select:hover{
	background:#200;
	border:1px solid #f00;
}
option{
	background:#000;
}
.red{
	color:#f00;
}
.white{
	color:#fff;
}
a{
	text-decoration:none;
}
a:hover{
	border-bottom:1px solid #900;
	border-top:1px solid #900;
}
#status{
	width:100%;
	height:auto;
	padding:4px 0;
	border-bottom:1px solid #300;
}
#result a{
	color:#777;
}
.sign{
	color:#222;
}
#box{
	margin:10px 0 0 0;
}
</style>
</head>
<body onload="initpg();">



<div id="result"></div>
<div id="box">
<input type="text" name="dork" id="dork" value="" style="width:400px;" title="Give a keyword to search..." />
<select name="setype" id="setype">
	<option value="google" />Google</option>
	<option value="bing" />Bing</option>
</select>
<input type="submit" id="btnOk" name="btnOk" value="Search" onclick="sikat();" style="width:70px;text-align:center;" />
<input type="submit" name="btnClear" value="Restart" onclick="bersih();" style="width:70px;text-align:center;" />
<span class="sign">revres</span><span class="red">.</span><span class="sign">tanur</span>
<img src="../images/loading.gif" alt="" style="margin:0;padding:0;vertical-align:middle;visibility:hidden;" id="loading" title="loading..." />
<p><input onclick="checkheavy();" style="vertical-align:middle;margin:0 8px;padding:0;border:0;" type="checkbox" name="heavy" id="heavy" /><a style="vertical-align:middle;" href="javascript:checkheavy_fix();">Depth scan ( slow but sure )</a></p>
</div>


<!-- aku suka kamu suka sudah jangan bilang syapaa syapaaa... -->
</body>
</html>