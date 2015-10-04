<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 15. 10. 04.
 * Time: 11:48
 */

namespace albertborsos\mailmaster\components;

use albertborsos\mailmaster\MailMasterAPI;
use yii\base\Component;

class MailMaster extends Component{

    public $apiUser;
    public $apiKey;

    /**
     * @param $listID
     * @param $formID
     * @return MailMasterAPI
     */
    public function factory($listID, $formID){
        $api = new MailMasterAPI($listID, $formID, $this->apiUser, $this->apiKey);

        return $api;
    }
}