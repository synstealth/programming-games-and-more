<?php

/*

function tor_wrapper($url){



$ua = array('Mozilla','Opera','Microsoft Internet Explorer','ia_archiver');

$op = array('Windows','Windows XP','Linux','Windows NT','Windows 2000','OSX');

$agent  = $ua[rand(0,3)].'/'.rand(1,8).'.'.rand(0,9).' ('.$op[rand(0,5)].' '.rand(1,7).'.'.rand(0,9).'; en-US;)';

        

        # Tor address & port

        $tor = '127.0.0.1:9050';



        # set a timeout.

        $timeout = '300';

	

        $ack = curl_init(); 

        curl_setopt ($ack, CURLOPT_PROXY, $tor); 

        curl_setopt ($ack, CURLOPT_URL, $url);

        curl_setopt ($ack, CURLOPT_HEADER, 1);  

        curl_setopt ($ack, CURLOPT_USERAGENT, $agent); 

        curl_setopt ($ack, CURLOPT_RETURNTRANSFER, 1); 

        curl_setopt ($ack, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt ($ack, CURLOPT_TIMEOUT, $timeout);



        $syn = curl_exec($ack);

		

        # $info = curl_getinfo($ack);



        curl_close($ack);

		

        # $info['http_code'];



   return $syn;

}



        # example:

        $wrapped = tor_wrapper("http://www.sillysite.com?page=1' OR 1=1");



        echo $wrapped;

*/

?>