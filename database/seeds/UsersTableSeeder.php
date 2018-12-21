<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        $user = User::first();
        $user_data = [
            'name' => '921t',
            'email' => '921t@qq.com',
            'password' => bcrypt('123456'),
            'avatar' => '/uploads/images/avatars/201812/21/1_1545375846_9gZzIAgisP.jpg',
            'introduction' => 'nothing like the love i have for you.',
        ];
        $user->update($user_data);
    }
}
