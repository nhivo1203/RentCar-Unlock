<?php

namespace Nhivonfq\Unlock\Services;
use Dotenv\Dotenv;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class TokenServices
{
    private string $jwtSecret;
    private int $issuedAt;
    private int $expire;

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
    public function jwtEncodeData($data): string
    {
        $payload = array(
            "iat" => $this->issuedAt,
            "exp" => $this->expire,
            "data" => $data
        );

        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }

    /**
     * @param $token
  route   * @return array
     */
    public function checkToken($token): array
    {
        $decoded = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));

        return (array)$decoded;
    }

    public function getTokenPayload($authorizationToken): bool|array
    {
        if ($authorizationToken === null) {
            return false;
        }
        $token = str_replace('Bearer ', '', $authorizationToken);
        $payload = $this->checkToken($token);
        if ($payload) {
            return $payload;
        }
        return false;
    }
}
