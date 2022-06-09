<?php

namespace Nhivonfq\Unlock\Transformer;

use Nhivonfq\Unlock\Models\User;

class UserTransformer
{
    public function toArray(User $user): array
    {
        return [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
        ];
    }
}
