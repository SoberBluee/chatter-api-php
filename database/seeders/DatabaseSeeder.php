<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Illuminate\Support\Carbon;

use App\Modaels\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "user_name" => "ethand",
            "first_name" => "ethan",
            "sur_name" => "donovan",
            "phonenumber" => "08888888",
            "email" => "ethan@mail.com",
            "password" => Hash::make("admin"),
            "post_id" => 1,
            "message_id" => 1,
            "friend_list" => '2, 3, 4, 5',
            "api_token" => Str::random(60),
            "api_token_expiry" => Carbon::now()->addMinute(30),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('users')->insert([
            "user_name" => Str::random(5),
            "first_name" => Str::random(5),
            "sur_name" => Str::random(5),
            "phonenumber" => rand(00000000, 999999999),
            "email" => Str::random(5) . "@gmail.com",
            "password" => Hash::make(Str::random(10)),
            "post_id" => 2,
            "message_id" => 2,
            "friend_list" => '1',
            "api_token" => Str::random(60),
            "api_token_expiry" => Carbon::now()->addMinute(30),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('users')->insert([
            "user_name" => Str::random(5),
            "first_name" => Str::random(5),
            "sur_name" => Str::random(5),
            "phonenumber" => rand(00000000, 999999999),
            "email" => Str::random(5) . "@gmail.com",
            "password" => Hash::make(Str::random(10)),
            "post_id" => 3,
            "message_id" => 3,
            "friend_list" => "1",
            "api_token" => Str::random(60),
            "api_token_expiry" => Carbon::now()->addMinute(30),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('users')->insert([
            "user_name" => Str::random(5),
            "first_name" => Str::random(5),
            "sur_name" => Str::random(5),
            "phonenumber" => rand(00000000, 999999999),
            "email" => Str::random(5) . "@gmail.com",
            "password" => Hash::make(Str::random(10)),
            "post_id" => 4,
            "message_id" => 4,
            "friend_list" => "1,2",
            "api_token" => Str::random(60),
            "api_token_expiry" => Carbon::now()->addMinute(30),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('users')->insert([
            "user_name" => Str::random(5),
            "first_name" => Str::random(5),
            "sur_name" => Str::random(5),
            "phonenumber" => rand(00000000, 999999999),
            "email" => Str::random(5) . "@gmail.com",
            "password" => Hash::make(Str::random(10)),
            "post_id" => 5,
            "message_id" => 5,
            "friend_list" => "1",
            "api_token" => Str::random(60),
            "api_token_expiry" => Carbon::now()->addMinute(30),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 1,
            "user_reciever_id" => 2,
            "message" => Str::random(10),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 1,
            "user_reciever_id" => 2,
            "message" => Str::random(10),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => Str::random(10),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('message_table')->insert([
            "user_sender_id" => 2,
            "user_reciever_id" => 1,
            "message" => "test message",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('post_table')->insert([
            'userId' => 1,
            "title" => Str::random(10),
            "img" => '',
            "body" => Str::random(50),
            "comment_id" => -1,
            "likes" => 1,
            "created_at" => Carbon::now()
        ]);

        DB::table('post_table')->insert([
            'userId' => 1,
            "title" => Str::random(10),
            "img" => '',
            "body" => Str::random(50),
            "comment_id" => -1,
            "likes" => 1,
            "created_at" => Carbon::now()
        ]);

        DB::table('post_table')->insert([
            'userId' => 2,
            "title" => Str::random(10),
            "img" => '',
            "body" => Str::random(50),
            "comment_id" => -1,
            "likes" => 1,
            "created_at" => Carbon::now()
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 1,
            "user_reciever_id" => 3,
            "message" => "User id 1",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('message_table')->insert([
            "user_sender_id" => 3,
            "user_reciever_id" => 1,
            "message" => "User id 2 ",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        DB::table('comment_table')->insert([
            "parentCommentId" => null,
            "postId" => 1,
            "userId" => 1,

            "comment" => "First comment on a post",
            "created_at" => Carbon::now(),
            "modified_at" => Carbon::now()
        ]);

        DB::table('comment_table')->insert([
            "parentCommentId" => null,
            "postId" => 1,
            "userId" => 2,
            "comment" => "THis comment was made by the user with an id of 2",
            "created_at" => Carbon::now(),
            "modified_at" => Carbon::now()
        ]);

        DB::table('comment_table')->insert([
            "parentCommentId" => 1,
            "postId" => 1,
            "userId" => 2,
            "comment" => "Second comment on a post",
            "created_at" => Carbon::now(),
            "modified_at" => Carbon::now()
        ]);
    }
}
