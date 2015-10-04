<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 15. 10. 04.
 * Time: 12:02
 */

namespace albertborsos\mailmaster\components;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use yii\helpers\VarDumper;

class MailMasterAPI {

    const STATUS_OK = 200;

    const ERROR_CODE_UNKNOWN = 0;
    const ERROR_CODE_EXISTS = -1;
    const ERROR_CODE_EMAIL = -2;

    protected $apiUser;
    protected $apiKey;

    protected $listID;
    protected $formID;

    protected $apiUrl = 'http://restapi.emesz.com/';

    function __construct($listID, $formID, $apiUser, $apiKey)
    {
        $this->listID = $listID;
        $this->formID = $formID;
        $this->apiUser = $apiUser;
        $this->apiKey = $apiKey;
    }

    public function subscribe($data){
        $url = 'subscribe/' . $this->listID . '/form/' . $this->formID;
        return $this->sendRequest($url, $data);
    }

    protected function sendRequest($url, $data, $method = 'POST'){
        try{
            $client = new Client([
                'base_uri' => $this->apiUrl,
                'auth' => [$this->apiUser, $this->apiKey]
            ]);
            /** @var Response $respose */
            $respose = $client->request($method, $url, $data);
            var_dump($respose->getBody()->read(1000));exit;
            if($respose->getStatusCode() == self::STATUS_OK){
                var_dump($respose->getBody());exit;
                return true;
            }else{
                switch($respose->getBody()){
                    case self::ERROR_CODE_UNKNOWN:
                        break;
                    case self::ERROR_CODE_EXISTS:
                        break;
                    case self::ERROR_CODE_EMAIL:
                        break;
                }
                var_dump($respose->getBody());
                exit;
            }
        }catch (\Exception $e){
            VarDumper::dump($e, 10, 1);exit;
        }
    }

}