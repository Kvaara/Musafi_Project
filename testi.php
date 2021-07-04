<?php

if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $temp_file_location = $_FILES['image']['tmp_name'];

    // Include the SDK using the composer autoloader
    require 'vendor/autoload.php';

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


    // Send a PutObject request and get the result object.
    // $key = '-- your filename --';

    $result = $s3->putObject([
        "ACL" => "public-read",
        'Bucket' => 'musafi',
        'Key'    => $file_name,
        'SourceFile'   => $temp_file_location,
        //'SourceFile' => 'c:\samplefile.png' -- use this if you want to upload a file from a local location
    ]);

    // Print the body of the result by indexing into the result object.
    // var_dump($result);
    echo $result["ObjectURL"];
}
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit" />
</form>

<script>
    const testi = new Audio();
    testi.src = "https://musafi.s3.eu-central-1.amazonaws.com/Darkness+of+Light.mp3";
    console.log(testi.src);
</script>