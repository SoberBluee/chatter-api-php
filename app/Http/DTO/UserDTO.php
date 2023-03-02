<?php

namespace App\DTO\UserDTO;

use App\DTO\MessagesDTO\MessagesDTO;
use App\Models\User;

/**
 * Create user DTO
 */
class UserDTO
{
    public function __construct(
        public readonly int $id,
        public string $user_name,
        public string $first_name,
        public string $sur_name,
        public string $email,
        public int $phonenumber,
        public string $password,
        public int $email_verifed_at,
        public int $post_id,
        public int $message_id,
        public string $friend_list,
        public string $remember_token,
        public ?MessagesDTO $messages,
    ) {
    }

    public static function fromModel(User $model){
        return new self(
            id: $model->id,
            user_name: $model->user_name,
            first_name: $model->first_name,
            sur_name: $model->surname,
            email: $model->email,
            phonenumber: $model->phone_number,
            password: $model->password,
            email_verifed_at: $model->email_verifed_at,
            post_id: $model->post_id,
            message_id: $model->message_id,
            friend_list: $model->friend_list,
            remember_token: $model->remember_token,
            messages: isset($model->message_id) ? MessagesDTO::fromModel($model->messages): null,
        );
    }

    public function serialize(){
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'first_name' => $this->first_name,
            'sur-name'=> $this->sur_name,
            'email' => $this->email,
            'phone_number'=> $this->phonenumber,
            'password' => $this->password,
            'email_verifed_at' => $this->email_verifed_at,
            'post_id' => $this->post_id,
            'message_id' => $this->message_id,
            'friend_list' => $this->friend_list,
            'remember_token' => $this->remember_token,
            'message' => $this->messages->serialize(),
        ];

    }
}

