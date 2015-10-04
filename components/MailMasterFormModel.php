<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 15. 10. 04.
 * Time: 13:26
 */

namespace albertborsos\mailmaster\components;


use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class MailMasterFormModel extends Model {

    protected $_listID;
    protected $_formID;

    public $formReplaceID;

    public function init()
    {
        parent::init();
        $mm = \Yii::$app->mailmaster;
        $this->setListID(ArrayHelper::getValue($mm, 'forms.' . $this->formReplaceID . '.listID'));
        $this->setFormID(ArrayHelper::getValue($mm, 'forms.' . $this->formReplaceID . '.formID'));
    }


    public function setListID($listID){
        $this->_listID = $listID;
    }

    public function setFormID($formID){
        $this->_formID = $formID;
    }

}