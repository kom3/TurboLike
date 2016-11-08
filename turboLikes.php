<?php

$a = new turboLikes();
$a->id = "4123561051";
$a->mac = "54:a0:50:17:d2:a9";
$a->get()->process(true, "\n");

class turboLikes {

	public $id;
	public $mac;

	private $response;

	public function __construct(){

	}
	public function response(){
		return $this->response;
	}
	public function process($print = false, $nex = " "){
		$this->get();
		foreach($this->response as $data){
			$datas = $this->add($data['id']);
			if($print){
				echo $datas['meta']['balance'] . $nex;
			}
		}
	}
	private function add($mediaid){
		$base = 'http://www.boost4social.com/ig/addlike';
		$var = 'appID=4682288570826752&deviceAdsID=205aa4e8-57fa-4337-bf4e-3988d6b6cec6&deviceCategory=2&deviceIMEI=&deviceMAC=' . $this->mac . '&deviceNativeID1=0022FBA8FFCE0000&deviceSerialNumber=nox&mediaID=' . $mediaid . '&timestamp=1478599926&trackAppVersion=2.11&userID=' . $this->id;
		return $this->http($base, $var);
	}
	public function get(){
		$var = 'appID=4682288570826752&deviceAdsID=205aad4e8-57fa-4337-bf4e-3988d6b6cec6&deviceCategory=2&deviceIMEI=&deviceMAC=' . $this->mac . '&deviceNativeID1=0022FBA3FFCE0200&deviceSerialNumber=nox&timestamp=1478599926&trackAppVersion=2.11&userID=' . $this->id;
		$base = "http://www.boost4social.com/ig/getmedias";
		$this->response = $this->http($base, $var)['data'];
		return $this;
	}
	private function http($url, $var){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $var);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		$result = json_decode($response, true);
		return $result;
	}
}
