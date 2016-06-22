<?php
$sitesHandle = fopen("sites.txt", "r");
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
curl_setopt($ch, CURLOPT_NOBODY, true);    // we don't need body
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$opts = getopt("f::");
if(array_key_exists("f", $opts))
{
	//don't use tor
}
else
{
	curl_setopt($ch, CURLOPT_PROXY, "https://127.0.0.1:9050/");
	echo("Configured to use TOR!\r\n\r\n");
}
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
if ($sitesHandle) {
	while (($site = fgets($sitesHandle)) !== false) 
	{
		$site = trim($site);
		$dirsHandle = fopen("dirs.txt", "r");
		if ($dirsHandle) {
	    		while (($dir = fgets($dirsHandle)) !== false) {
				$dir = trim($dir);
				$shellsHandle = fopen("shells.txt", "r");
				if ($shellsHandle) {
	    				while (($shell = fgets($shellsHandle)) !== false) {
						$shell = trim($shell);
						$url = $site.$dir.$shell;
						echo($url);
						curl_setopt($ch, CURLOPT_URL, $url);
						$output = curl_exec($ch);
						$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						$curl_error = curl_error($ch);
						if($curl_error != "")
						{
							echo('CURL ERROR:'.$curl_error."\r\n");
						}

						if($httpcode == "200")
						{	
							file_put_contents("sitesWithShells.txt", $url." code: ".$httpcode."\r\n", FILE_APPEND);
						}
						echo("     Code: ".$httpcode."\r\n");
					}
				}
			}		
		}
	}

	if(isset($handle))
	{	
		fclose($handle);
	}else{
		echo("End of sites.txt reached. Check sitesWithShells.txt\r\n");	
	}
} else {
    echo("sites.txt not found. Please create it in the shellScrape directory\r\n");
}
curl_close($ch);

?>
