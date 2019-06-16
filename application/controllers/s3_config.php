<?php
// Bucket Name
$bucket="pnpfacedetectdemo1cidms";
if (!class_exists('S3'))require_once('S3.php');
			
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAICVEZUFAPM3JLWOA');
if (!defined('awsSecretKey')) define('awsSecretKey', 'wD2/eqtid53eNC6RADBgKC7JKC5pxdRd/BvttPa9mNxL');
			
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>