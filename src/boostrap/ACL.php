<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Services\SessionServices;
use Nhivonfq\Unlock\Services\TokenServices;

class ACL
{
    private Request $request;
    private SessionServices $sessionServices;
    private TokenServices $tokenServices;
    private UserRepository $userRepository;

    public function __construct(Request         $request,
                                SessionServices $sessionServices,
                                TokenServices   $tokenServices,
                                UserRepository  $userRepository
    )
    {
        $this->request = $request;
        $this->sessionServices = $sessionServices;
        $this->tokenServices = $tokenServices;
        $this->userRepository = $userRepository;
    }

    public function checkCanAccess(int $role): bool
    {
        $authortoken = $this->request->getToken();
        $session = $this->sessionServices->hasSession('user_id');
        if ($authortoken == null && !$session) {
            return false;
        }
        if($session) {
            $userId = $this->sessionServices->get('user_id');
        } else {
            $tokenPayload = $this->tokenServices->getTokenPayload($authortoken);
            if (!$tokenPayload) {
                return false;
            }
            $userId = $tokenPayload['data']->id;
        }
        $user = $this->userRepository->findOne(['id' => $userId]);
        if ($user->getRole() === $role) {
            return true;
        }
        return false;

    }
}
