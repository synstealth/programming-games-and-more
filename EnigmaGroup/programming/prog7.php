<?

#############################################################
#			Remote login and post an challenge				#
#############################################################
$Url = "http://www.enigmagroup.org/forums/login2/";
$login_email = 'synstealth';
$login_pass = 'xxxxxxxxx';
#############################################################

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_REFERER, "http://www.enigmagroup.org");
curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.urlencode($login_email).'&passwrd='.urlencode($login_pass).'&cookieneverexp=on&hash_password=xxxxxxxxx');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
$page = curl_exec($ch);

##########################################################################################################################
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/7/');
$output = curl_exec($ch);

// filter out the output
preg_match_all("/.*?(.*?)<br /", $output, $matches);
preg_match_all("/the.*(.*)/",$matches[0][4],$deptFilter);
$step2 = explode(" ",$deptFilter[0][0]);
$deptName = $step2[1];
// fix the dept string, grab only the dept name
$fix = substr($matches[0][14],8);
// fix the html tag on the ending of string <br
$co = substr($fix,1,strlen($fix)-5); 
$cofix = htmlspecialchars($co);
// the beginning whitespace fix
$companyName = substr($cofix,1);

echo '<br /><br />You need to collect the data for the <b>[ <font color="red">'.$deptName.'</font> ]</b> department.<br /><br />';
echo 'Your Company Name is: '.$companyName.'<br /><br />The Following List of Budgets have been collected:';
echo '<hr>';
$list = substr($matches[0][16],2);
$step1 = explode(" ",$list);
for($x=0; $x<count($step1); $x++){
	//collect dept names
	if($step1[$x] == 'Department:'){
		//echo 'Checking for dept name: '.$step1[$x+1].'<br />';
		switch($step1[$x+1]){
			case 'Technical':	$code='Technical';
				//echo 'Technical Support FOUND: now collecting budgets: '.$step1[$x+5].'<br />';
				$technical++;
				$total_tech += (int)substr($step1[$x+5],1);
				break;
			case 'Programmers':	$code='Programmers';
				//echo 'Programers FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$programmers++;
				$total_prog += substr($step1[$x+4],1);
				break;
			case 'Management':	$code='Management';
				//echo 'Management FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Management++;
				$total_mgmr += substr($step1[$x+4],1);
				break;
			case 'Technicians':	$code='Technicians';
				//echo 'Technicians FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Technicians++;
				$total_techs += substr($step1[$x+4],1);
				break;
			case 'Manufacturing':	$code='Manufacturing';
				//echo 'Manufacturing FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Manufacturing++;
				$total_mfgr += substr($step1[$x+4],1);
				break;
			case 'Accounting':	$code='Accounting';
				//echo 'Accounting FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Accounting++;
				$total_acct += substr($step1[$x+4],1);
				break;
			case 'Sales':	$code='Sales';
				//echo 'Sales FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Sales++;
				$total_sale += substr($step1[$x+4],1);
				break;
			case 'Marketing':	$code='Marketing';
				//echo 'Marketing FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Marketing++;
				$total_mkts += substr($step1[$x+4],1);
				break;
			case 'Importing':	$code='Importing';
				//echo 'Importing FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Importing++;
				$total_impt += substr($step1[$x+4],1);
				break;
			case 'Testing':	$code='Testing';
				//echo 'Testing FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Testing++;
				$total_test += substr($step1[$x+4],1);
				break;
			case 'Exporting':	$code='Exporting';
				//echo 'Exporting FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Exporting++;
				$total_expt += substr($step1[$x+4],1);
				break;
			case 'Secretaries':	$code='Secretaries';
				//echo 'Secretaries FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Secretaries++;
				$total_sect += substr($step1[$x+4],1);
				break;
			case 'Networkers':	$code='Networkers';
				//echo 'Networkers FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Networkers++;
				$total_netw += substr($step1[$x+4],1);
				break;
			case 'Research':	$code='Research';
				//echo 'Research FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Research++;
				$total_resc += substr($step1[$x+4],1);
				break;	
			case 'Purchasing':	$code='Purchasing';
				//echo 'Purchasing FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Purchasing++;
				$total_purs += substr($step1[$x+4],1);
				break;
			case 'Logistics':	$code='Logistics';
				//echo 'Logistics FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$Logistics++;
				$total_logt += substr($step1[$x+4],1);
				break;
			case 'I.T':
				//echo 'I.T. FOUND: now collecting budgets: '.$step1[$x+4].'<br />';
				$IT++;
				$total_its += substr($step1[$x+4],1);
				break;
			default:		break;
		}		
	}
}

if(isset($technical)){
		if($deptName  == 'Technical Support'){echo '<font color="red"><b>Technical Support</b></font><br />';$budgetTotal=$total_tech;}
		else						  		 {echo '<b>Technical Support</b><br />';}
		echo 'Budget Total: $'.$total_tech.'<br />';
		
}
if(isset($programmers)){
		if($deptName  == 'Programmers'){echo '<font color="red"><b>Programmers</b></font><br />';$budgetTotal=$total_prog;}
		else						   {echo '<b>Programmers</b><br />';}
		echo 'Budget Total: $'.$total_prog.'<br />';
		
}
if(isset($Management)){
		if($deptName  == 'Management'){echo '<font color="red"><b>Management</b></font><br />';$budgetTotal=$total_mgmr;}
		else						   {echo '<b>Management</b><br />';}
		echo 'Budget Total: $'.$total_mgmr.'<br />';
		
}
if(isset($Technicians)){
		if($deptName  == 'Technicians'){echo '<font color="red"><b>Technicians</b></font><br />';$budgetTotal=$total_techs;}
		else						   {echo '<b>Technicians</b><br />';}
		echo 'Budget Total: $'.$total_techs.'<br />';
		
}
if(isset($Manufacturing)){
		if($deptName  == 'Manufacturing'){echo '<font color="red"><b>Manufacturing</b></font><br />';$budgetTotal=$total_mfgr;}
		else						     {echo '<b>Manufacturing</b><br />';}
		echo 'Budget Total: $'.$total_mfgr.'<br />';
		
}
if(isset($Accounting)){
		if($deptName  == 'Accounting'){echo '<font color="red"><b>Accounting</b></font><br />';$budgetTotal=$total_acct;}
		else						  {echo '<b>Accounting</b><br />';}
		echo 'Budget Total: $'.$total_acct.'<br />';
		
}
if(isset($Sales)){
		if($deptName  == 'Sales'){echo '<font color="red"><b>Sales</b></font><br />';$budgetTotal=$total_sale;}
		else						  {echo '<b>Sales</b><br />';}
		echo 'Budget Total: $'.$total_sale.'<br />';
		
}
if(isset($Marketing)){
		if($deptName  == 'Marketing'){echo '<font color="red"><b>Marketing</b></font><br />';$budgetTotal=$total_mkts;}
		else						  {echo '<b>Marketing</b><br />';}
		echo 'Budget Total: $'.$total_mkts.'<br />';
		
}
if(isset($Importing)){
		if($deptName  == 'Importing'){echo '<font color="red"><b>Importing</b></font><br />';$budgetTotal=$total_impt;}
		else						  {echo '<b>Importing</b><br />';}
		echo 'Budget Total: $'.$total_impt.'<br />';
		
}
if(isset($Testing)){
		if($deptName  == 'Testing'){echo '<font color="red"><b>Testing</b></font><br />';$budgetTotal=$total_test;}
		else						  {echo '<b>Testing</b><br />';}
		echo 'Budget Total: $'.$total_test.'<br />';
		$budgetTotal=$total_test;
}
if(isset($Exporting)){
		if($deptName  == 'Exporting'){echo '<font color="red"><b>Exporting</b></font><br />';$budgetTotal=$total_expt;}
		else						  {echo '<b>Exporting</b><br />';}
		echo 'Budget Total: $'.$total_expt.'<br />';
		
}
if(isset($Secretaries)){
		if($deptName  == 'Secretaries'){echo '<font color="red"><b>Secretaries</b></font><br />';$budgetTotal=$total_sect;}
		else						  {echo '<b>Secretaries</b><br />';}
		echo 'Budget Total: $'.$total_sect.'<br />';
		
}
if(isset($Networkers)){
		if($deptName  == 'Networkers'){echo '<font color="red"><b>Networkers</b></font><br />';$budgetTotal=$total_netw;}
		else						  {echo '<b>Networkers</b><br />';}
		echo 'Budget Total: $'.$total_netw.'<br />';
		
}
if(isset($Research)){
		if($deptName  == 'Research'){echo '<font color="red"><b>Research</b></font><br />';$budgetTotal=$total_resc;}
		else						  {echo '<b>Research</b><br />';}
		echo 'Budget Total: $'.$total_resc.'<br />';
		
}
if(isset($Purchasing)){
		if($deptName  == 'Purchasing'){echo '<font color="red"><b>Purchasing</b></font><br />';$budgetTotal=$total_purs;}
		else						  {echo '<b>Purchasing</b><br />';}
		echo 'Budget Total: $'.$total_purs.'<br />';
		
}
if(isset($Logistics)){
		if($deptName  == 'Logistics'){echo '<font color="red"><b>Logistics</b></font><br />';$budgetTotal=$total_logt;}
		else						  {echo '<b>Logistics</b><br />';}
		echo 'Budget Total: $'.$total_logt.'<br />';
		
}
if(isset($IT)){
		if($deptName  == 'I.T.'){echo '<font color="red"><b>I.T.</b></font><br />';$budgetTotal=$total_its;}
		else						  {echo '<b>I.T.</b><br />';}
		echo 'Budget Total: $'.$total_its.'<br />';
		
}
echo '<hr>';
echo '<br />Result to be submitted:[ submit.php?company='.$companyName.'&department='.$deptName.'&total='.$budgetTotal.' ]<br /><br />';
echo '<hr>';
$postfields = 'company='.$companyName.'&department='.$deptName.'&total='.$budgetTotal;
curl_setopt($ch, CURLOPT_URL, 'http://www.enigmagroup.org/missions/programming/7/submit.php?'.urlencode($postfields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
echo curl_exec($ch); 
curl_close($ch);
?>
