<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Tommy",
            'last_name' => "Oliver",
            'email' => "greenranger@gmail.com",
            'username' => "greenranger",
            'gender' => "Male",
            'birthday' => '1991-08-12',
            'password' => bcrypt('password'),
            'profile_pic' => "/users/greenranger/GreenRanger.jpg"
        ]);

        DB::table('users')->insert([
            'first_name' => "Jason Lee",
            'last_name' => "Scott",
            'email' => "redranger@gmail.com",
            'username' => "redranger",
            'gender' => "Male",
            'birthday' => '1991-08-12',
            'password' => bcrypt('password'),
            'profile_pic' => "/users/redranger/Mighty_Morphin'_Red_Ranger_1.jpg"
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'body' => "Has it ever occured to you that I might have other things on my mind? News flash, Kimberly: You are not the center of everyone's universe."
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'body' => "What? Putties can drive?"
        ]);

        DB::table('friends')->insert([
            'user_id' => 1,
            'friend_id' => 2,
            'accepted' => 1
        ]);

        DB::table('conversation_user')->insert([
            'user_id' => 1,
            'conversation_id' => 1
        ]);

        DB::table('conversation_user')->insert([
            'user_id' => 2,
            'conversation_id' => 1
        ]);

        DB::table('conversations')->insert([
            'id' => 1
        ]);

        DB::table('messages')->insert([
            'user_id' => 2,
            'conversation_id' => 1,
            'body' => "You wear a green Ranger costume, yet your loyalty is with Rita."
        ]);
        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 1,
            'body' => "I am her Green Ranger, and she is my empress!"
        ]);
        DB::table('messages')->insert([
            'user_id' => 2,
            'conversation_id' => 1,
            'body' => "She's evil!"
        ]);
        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 1,
            'body' => "Yeah, and so am I."
        ]);
    }
}
