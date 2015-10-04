<?php
/**
 * Created by PhpStorm.
 * User: albertborsos
 * Date: 15. 10. 04.
 * Time: 13:26
 */

namespace albertborsos\mailmaster\components;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class MailMasterFormModel extends Model
{

    protected $_listID;
    protected $_formID;

    public $formReplaceID;

    const ERROR_EMAIL_EXISTS = -1;
    const ERROR_EMAIL_FORMAT = -2;
    const ERROR_OTHER = 0;

    const MESSAGE_EMAIL_EXISTS = 'Ezzel az emailcímmel már felíratkoztál!';
    const MESSAGE_EMAIL_FORMAT = 'Hibás email cím!';
    const MESSAGE_OTHER = 'Hiba történt :(';

    public function init()
    {
        parent::init();
        $mm = \Yii::$app->mailmaster;
        $this->setListID(ArrayHelper::getValue($mm, 'forms.' . $this->formReplaceID . '.listID'));
        $this->setFormID(ArrayHelper::getValue($mm, 'forms.' . $this->formReplaceID . '.formID'));
    }


    public function setListID($listID)
    {
        $this->_listID = $listID;
    }

    public function setFormID($formID)
    {
        $this->_formID = $formID;
    }

    protected function processResponse($response)
    {
        switch ($response) {
            case self::ERROR_EMAIL_EXISTS:
                $alertType = 'error';
                $message = self::MESSAGE_EMAIL_EXISTS;
                break;
            case self::ERROR_EMAIL_FORMAT:
                $alertType = 'error';
                $message = self::MESSAGE_EMAIL_FORMAT;
                break;
            case self::ERROR_OTHER:
                $alertType = 'error';
                $message = self::MESSAGE_OTHER;
                break;
            default:
                $alertType = 'success';
                $message = 'Sikeres feliratkozás!';
                break;
        }

        Yii::$app->getSession()->setFlash($alertType, '<h4>' . $message . '</h4>');
    }
}