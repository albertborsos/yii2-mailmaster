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

    /**
     * Feliratkozás.
     * Címadatok küldése a címlistára. Az 'email' mező megadása kötelező
     * a feliratkozás megadásához. A rekord a feliratkozáskor aktív.
     *
     * <code>
     *   $mm->subscribe(['email' => 'foo@company.com']);
     *   $mm->subscribe([
     *      'email' => 'foo@company.com',
     *      'name' => 'Csepregi Balázs',
     *   ]);
     * </code>
     * @param array név-érték párok.
     * @return int A rekord azonosítója, hiba esetén: -1 - létező emailcím, -2 - hibás email, 0 - egyéb hiba, NULL - hibás művelet.
     */
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
            $respose = $client->request($method, $url, [
                'body' => json_encode($data),
            ]);
            if($respose->getStatusCode() != self::STATUS_OK){
                // set error
            }

            return (int)$respose->getBody()->getContents();
        }catch (\Exception $e){
            return false;
        }
    }

}