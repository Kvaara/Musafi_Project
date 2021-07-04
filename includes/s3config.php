<?php
// Include the SDK using the composer autoloader
require '../../../vendor/autoload.php';

// If the application is running in production
if (getenv("production")) {
    $s3 = new Aws\S3\S3Client([
        'region'  => 'eu-central-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => getenv("aws_access_key"),
            'secret' => getenv("aws_secret_access_key"),
        ]
    ]);
} else {
    $s3 = new Aws\S3\S3Client([
        'region'  => 'eu-central-1',
        'version' => 'latest',
        // No need to set credentials, because we have a credentials file in the home directory in a folder .aws/
    ]);
}
