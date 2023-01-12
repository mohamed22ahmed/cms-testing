<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->getUserId(),
            'title' => Str::random(10),
            'body' => Str::random(30)
        ];
    }

    private function getUserId(){
        $user = User::latest()->first();
        if($user)
            return $user->id +1;
        return 1;
    }
}
