<?php

namespace albertborsos\mailmaster\models;

use albertborsos\mailmaster\components\MailMasterFormModel;
use Yii;

class SubscribeForm extends MailMasterFormModel{

    public $nameFirst;
    public $nameLast;
    public $email;

    public $view = '@vendor/albertborsos/yii2-mailmaster/views/subscribe';

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

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function process()
    {
        Yii::$app->getSession()->setFlash('success', '<h4>Sikeres feliratkozás!</h4>');
    }
} 