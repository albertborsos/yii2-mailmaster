# yii2-mailmaster
MailMaster API wrapper for Yii2 projects

# How to config in your project

```php
  'components' => [
    ...
    'mailmaster' => [
          'class' => 'albertborsos\mailmaster\MailMaster',
          'apiUser' => 'mailmaster-api-user-name',
          'apiKey' => 'mailmaster-api-password',
          'forms' => [
              'your-form-id' =>[
                  'formID' => 'mailmaster-form-id',
                  'listID' => 'mailmaster-list-id',
              ],
          ],
    ],
    ...
  ],
...
```

# How to handle after form submit

```php
  /** @var \albertborsos\mailmaster\MailMaster $mmc */
  $mmc = Yii::$app->mailmaster;
  $mm = $mmc->factory($this->_listID, $this->_formID);

  $response = $mm->subscribe([
      'email' => $this->email,
      'mssys_firstname' => $this->nameFirst,
      'mssys_lastname' => $this->nameLast,
  ]);
```
