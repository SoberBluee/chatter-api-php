<?php

namespace App\DTO\UserDTO;

use App\Models\User;

/**
 * Create user DTO
 */
class UserDTO
{
    public function __construct(
        public readonly int $user_id,
        public string $user_name,
        public string $first_name,
        public string $sur_name,
        public string $email,
        public int $phonenumber,
        public string $password,
    ) {
    }

    public static function fromModel(User $model){
        return new self(
            user_id: $model->user_id,
            user_name: $model->user_name,
            first_name: $model->first_name,
            sur_name: $model->surname,
            email: $model->email,
            phonenumber: $model->phone_number,
            password: $model->password,
        );
    }

    public function serialize(){
        return [
            'user_id' => $this->user_id,
            'user_name' => $this->user_name,
            'first_name' => $this->first_name,
            'sur-name'=> $this->sur_name,
            'email' => $this->email,
            'phone_number'=> $this->phone_number,
            'password' => $this->password,
        ];

    }
}

