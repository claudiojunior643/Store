<?php

namespace Database\Seeders;

use App\Models\Seeeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

use App\Models\Profile;
use App\Models\User;
use App\Models\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $this->call([
        ProfileSeeder::class,
      ]);
    }
}