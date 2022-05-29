<?php

namespace Nhivonfq\Unlock\Services;
use Dotenv\Dotenv;
use Exception;
use Firebase\JWT\JWT;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class TokenServices
{
    private string $jwtSecret;
    private array $token;
    private int $issuedAt;
    private int $expire;
    private string $jwt;

    public function __construct()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->issuedAt = time();
        $this->expire = $this->issuedAt + 3600;
        $this->jwtSecret = $_ENV['JWT_SECRET'];
    }

    /**
     * @param $iss
     * @param $data
     * @return string
     */
    public function jwtEncodeData($iss, $data): string
    {

        $this->token = array(
            "iss" => $iss,
            "aud" => $iss,
            "iat" => $this->issuedAt,
            "exp" => $this->expire,
            "data" => $data
        );

        $this->jwt = JWT::encode($this->token, $this->jwtSecret, 'HS256');
        return $this->jwt;
    }

    public function jwtDecodeData($jwtToken)
    {
        try {
            return JWT::decode($jwtToken, $this->jwtSecret, array('HS256'))->data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
