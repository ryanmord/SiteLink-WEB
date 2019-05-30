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
        'apiKey' => 'AAAAl2LQWCg:APA91bFeM0f7RojB3_jzuHfPjR4ZUO3RasGnd2y3v7A4N41p0zb7g06Xo89MG-Kpilxo-vIx3iXtlncOqAmpwTqNOYm7ZpPC9bfFUH0-f6rQn2CIBKJUG6d_bhiimyuRq3XOj-qZns_1',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => '1234', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => true
  ]
];