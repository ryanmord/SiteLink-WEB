<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'My_ApiKey',
  ],
  'fcm' => [
        'priority' => 'high',
        'dry_run' => false,
        'apiKey' => 'AAAA1XC4TOY:APA91bFz5hGNBaAmj9kFuaWP5LDA7CP5k4wqwka2WxSXYl1gBMF2U8DXEXdnZvie_JQ5kRU8HZE7k3d5VtbZxFgPP-yKcPp_kaYJTEwV-WwzMz7ak3pbo-aQsTabMLFUi5WGuMCq9U16',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => '1234', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => true
  ]
];