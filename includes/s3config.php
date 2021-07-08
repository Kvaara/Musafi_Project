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
    // If the application is running in ec2
} else if (getenv("EC2_DB_PASSWORD")) {
    $s3 = new Aws\S3\S3Client([
        'region'  => 'eu-central-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => getenv("ACC_KEY"),
            'secret' => getenv("ACC_SEC"),
        ]
    ]);
} else {
    // If the application is running in localhost
    $s3 = new Aws\S3\S3Client([
        'region'  => 'eu-central-1',
        'version' => 'latest',
        // No need to set credentials, because we have a credentials file.
    ]);
}
