<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 15. 10. 04.
 * Time: 12:02
 */

namespace albertborsos\mailmaster;


class MailMasterAPI {

    protected $apiUser;
    protected $apiKey;

    protected $listID;
    protected $formID;

    protected $apiUrl;

    function __construct($listID, $formID, $apiUser, $apiKey)
    {
        $this->listID = $listID;
        $this->formID = $formID;
        $this->apiUser = $apiUser;
        $this->apiKey = $apiKey;
    }

    protected function getApiUrl(){
        return 'http://' . $this->apiUser . ':' . $this->apiKey . '@restapi.emesz.com/';
    }

    public function subscribe($data){
        $url = 'subscribe/' . $this->listID . '/form/' . $this->formID;
        $this->sendRequest($url, $data);
    }

    protected function sendRequest($url, $data, $method = 'POST'){

    }

}