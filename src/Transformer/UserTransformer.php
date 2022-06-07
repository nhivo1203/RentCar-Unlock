<?php

namespace Nhivonfq\Unlock\Transformer;

use Nhivonfq\Unlock\Models\UserModel;

class UserTransformer
{
    public function toArray(UserModel $user): array
    {
        return [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
        ];
    }
}
