<?php

namespace App\DTO\MessagesDTO;
use App\Models\Messages;

/**
 * Create user DTO
 */
class MessagesDTO
{
    public function __construct(
        public readonly int $id,
        public int $user_sender_id,
        public int $user_reciever_id,
        public string $message,
        public string $created_at,
        public string $updated_at,
    ) {
    }

    public static function fromModel(Messages $model): self{
        return new self(
            id: $model->id,
            user_sender_id: $model->user_sender_id,
            user_reciever_id: $model->user_reciever_id,
            message: $model->message,
            created_at: $model->created_at,
            updated_at: $model->updated_at,
        );
    }

    public function serialize(){
        return [
            'id' => $this->id,
            'user_sender_id' => $this->user_sender_id,
            'user_reciever_id' => $this->user_reciever_id,
            'message'=> $this->message,
            'created_at' => $this->created_at,
            'updated_at'=> $this->updated_at,
        ];
    }
}

