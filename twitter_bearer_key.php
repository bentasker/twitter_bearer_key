<?php
/** Cheat script to retrieve a Bearer key for App only Twitter Authentication
*
* You'll need to add your application at https://dev.twitter.com/ and get the Consumer key & Secret
* See the README for more information
*
* https://github.com/bentasker/twitter_bearer_key
*
* @copyright (C) 2013 B Tasker - http://www.bentasker.co.uk
* @license GNU GPL V2
* See LICENSE
*
*/


class twitSetup{

    function placecurlrequest($uri){
	$ch = curl_init("$uri");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $this->request);

	if (is_array($this->headers))
	curl_setopt($ch, CURLOPT_HTTPHEADER,$this->headers);

	$data = curl_exec($ch);
    
	curl_close($ch);

	return $data;
    }


    function getBearer($consumer,$secret){

      $this->encoded = base64_encode($consumer.":".$secret);
      $this->request = "grant_type=client_credentials";
      $this->headers = array(
	"Authorization: Basic {$this->encoded}", "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
      );

      return $this->placecurlrequest("https://api.twitter.com/oauth2/token");
    }


}


// If the keys aren't set, grab from the command line
if (!isset($consumer_key) && !isset($consumer_secret)){
  $consumer_key = $argv[1];
  $consumer_secret = $argv[2];  
}


$t = new twitSetup;
$k = $t->getBearer($consumer_key,$consumer_secret);

if (!$no_display_token)
  echo "Your Bearer token is {$k->access_token}\n";

?>