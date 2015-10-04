<?php

namespace albertborsos\mailmaster\models;

use albertborsos\mailmaster\components\MailMasterFormModel;
use albertborsos\mailmaster\MailMaster;
use Yii;

class SubscribeForm extends MailMasterFormModel{

    public $nameFirst;
    public $nameLast;
    public $email;

    public $view = '@vendor/albertborsos/yii2-mailmaster/views/subscribe';

    public $formReplaceID = '[#subscribe#]';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['nameFirst', 'nameLast', 'email'], 'required'],
            [['nameFirst', 'nameLast'], 'trim'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nameFirst' => 'Keresztnév',
            'nameLast' => 'Vezetéknév',
            'email' => 'E-mail cím',
        ];
    }

    public function process()
    {
        /** @var MailMaster $mmc */
        $mmc = Yii::$app->mailmaster;
        $mm = $mmc->factory($this->_listID, $this->_formID);

        $response = $mm->subscribe([
            'email' => $this->email,
            'mssys_firstname' => $this->nameFirst,
            'mssys_lastname' => $this->nameLast,
        ]);

        $this->processResponse($response);
    }
} 