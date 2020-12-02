<?php

	require "config.php";

	class payAPI
	{

	function IsTransactionConfirmed($publicKey, $request)
	{
		global $serviceUrl;

		$r = new stdClass();

		$r->publicKey = $publicKey;
		$r->request = $request;
		
		$url = $serviceUrl . "/IsTransactionConfirmed"; 

		return $this->doPost($r,$url);
	}

	function CreateTransaction($publicKey, $request)
	{
		global $serviceUrl;

		$r = new stdClass();

		$r->publicKey = $publicKey;
		$r->request = $request;

		$url = $serviceUrl . "/CreateTransaction"; 

    		return $this->doPost($r,$url);
	}

	function GetTransactionDetails($publicKey, $request)
	{
		global $serviceUrl;

		$r = new stdClass();

		$r->publicKey = $publicKey;
		$r->request = $request;

		$url = $serviceUrl . "/GetTransactionDetails"; 

    		return $this->doPost($r,$url);
	}

	function GetRate($publicKey, $request)
	{
		global $serviceUrl;

		$r = new stdClass();

		$r->publicKey = $publicKey;
		$r->request = $request;

		$url = $serviceUrl . "/GetRate"; 

    		return $this->doPost($r,$url);
	}

	function ReOpenTransaction($publicKey, $request)
	{
		global $serviceUrl;

		$r = new stdClass();

		$r->publicKey = $publicKey;
		$r->request = $request;

		$url = $serviceUrl . "/ReOpenTransaction"; 

    		return $this->doPost($r,$url);
	}

	function CancelTransaction($publicKey, $request)
	{
		global $serviceUrl;

		$r = new stdClass();

		$r->publicKey = $publicKey;
		$r->request = $request;

		$url = $serviceUrl . "/CancelTransaction"; 

    		return $this->doPost($r,$url);
	}

	function doPost($data, $url)
	{
		global $debugService;

		$url = $url; 

		$data->request->Hash = $this->hashData($data->request);

		if($debugService)
			var_dump($data);

		$jsonObject = json_encode($data);

    		$options = array(
    			CURLOPT_HTTPHEADER => array(
        		"Content-Type:application/json; charset=utf-8",
        		"Content-Length:".strlen($jsonObject)));

    		$defaults = array( 
        		CURLOPT_POST => 1, 
        		CURLOPT_HEADER => 0, 
        		CURLOPT_URL => $url, 
        		CURLOPT_FRESH_CONNECT => 1, 
        		CURLOPT_RETURNTRANSFER => 1, 
        		CURLOPT_FORBID_REUSE => 1, 
        		CURLOPT_TIMEOUT => 4, 
        		CURLOPT_POSTFIELDS => $jsonObject
   		); 

    		$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    		curl_setopt_array($ch, ($options + $defaults)); 
    		$response = curl_exec($ch);
    		curl_close($ch); 
		

		if($debugService){		
			print("<br /><br />");

			var_dump(json_decode($response));
		}

		return json_decode($response);
	}

	function hashData($data)
	{
		global $publicKey;
		global $privateKey;

		$members = get_object_vars($data);
		
		ksort($members);

		$s = "";

		foreach($members as $m=>$v)
		{
			if($m=='Hash')
				continue;

			if($v==null)
				continue;

			if(is_object($v))
				continue;

			$s .= $v;
		}
		
		return hash('sha256', $s . $privateKey);
	}

	function checkHash($data)
	{
		if($data==null)
			return true;

		if($data->Hash==null)
			return true;
	
		global $publicKey;
		global $privateKey;

		$members = get_object_vars($data);
		
		ksort($members);

		$s = "";
		$hash = $data->Hash;

		foreach($members as $m=>$v)
		{
			if($m =='Hash')
			{
				continue;
			}

			if($v == null)
				continue;

			if(is_object($v))
				continue;

			$s .= $v;
		}
		
		return hash('sha256', $s . $privateKey) == $hash;
	}


	}

?>