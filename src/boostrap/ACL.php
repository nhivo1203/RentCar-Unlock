<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\Exception\UnauthenticatedException;
use Nhivonfq\Unlock\Exception\UnauthorizedException;
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

    /**
     * @throws UnauthorizedException
     * @throws UnauthenticatedException
     */
    public function checkCanAccess(int $role): bool
    {
        $authorizationToken = $this->request->getToken();
        $sessionToken = $this->sessionServices->hasSession('user_id');
        if ($authorizationToken === null && !$sessionToken) {
            throw new UnauthenticatedException();
        }
        if ($sessionToken) {
            $userId = $this->sessionServices->get('user_id');
        } else {
            $tokenPayload = $this->tokenServices->getTokenPayload($authorizationToken);
            if (!$tokenPayload) {
                throw new UnauthenticatedException();
            }
            $userId = $tokenPayload['data']->id;
        }

        $user = $this->userRepository->findOne(['id' => $userId]);
        if ($user->getRole() === $role) {
            return true;
        }
        throw new UnauthorizedException();

    }
}
