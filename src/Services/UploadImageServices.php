<?php

namespace Nhivonfq\Unlock\Services;

use Aws\Result;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Dotenv\Dotenv;

class UploadImageServices
{
    private static Dotenv $loadEnv;

    private string $bucketName;
    private string $bucketRegion;
    private string $accessKey;
    private string $secretKey;

    public function __construct()
    {
        $this->bucketName = $_ENV['S3_BUCKET_NAME'];
        $this->bucketRegion = $_ENV['S3_BUCKET_REGION'];
        $this->accessKey = $_ENV['S3_ACCESS_KEY_ID'];
        $this->secretKey = $_ENV['S3_SECRET_ACCESS_KEY'];
    }

    /**
     * @param $file
     * @return Result
     */
    public function setS3Client($file): Result
    {
        $key = basename($file);
        $result = new S3Client([
            'version' => 'latest',
            'region' => $this->bucketRegion,
            'credentials' => ['key' => $this->accessKey, 'secret' => $this->secretKey]
        ]);
        $result = $result->putObject([
            'Bucket' => $this->bucketName,
            'Key' => $key,
            'SourceFile' => $file,
        ]);
        unlink($file);
        return $result;
    }

    public function getFilePath(string $fileName): string
    {
        $path = "../public/img/";
        $filename = md5(date('Y-m-d H:i:s:u')) . $fileName;
        return $path . $filename;
    }

    public function handleUpload($file)
    {
        $filePath = $this->getFilePath($file['name']);
        if (!move_uploaded_file($file["tmp_name"], $filePath)) {
            return null;
        }
        try {
            $result = $this->setS3Client($filePath);
            return $result->get('ObjectURL');
        } catch (S3Exception $e) {
            return null;
        }
    }
}
