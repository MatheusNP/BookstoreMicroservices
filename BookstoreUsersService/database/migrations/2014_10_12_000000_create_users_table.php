<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['username' => 'suyash', 'password' => Hash::make('gulati')],
            ['username' => 'shivangi', 'password' => Hash::make('gupta')],
            ['username' => 'nimisha', 'password' => Hash::make('sehgal')],
            ['username' => 'avaleen', 'password' => Hash::make('kaur')],
            ['username' => 'ankita', 'password' => Hash::make('negi')],
            ['username' => 'astha', 'password' => Hash::make('bhargav')],
            ['username' => 'avani', 'password' => Hash::make('khurana')],
            ['username' => 'shikhar', 'password' => Hash::make('gupta')],
            ['username' => 'rakhi', 'password' => Hash::make('gupta')],
            ['username' => 'saurabh', 'password' => Hash::make('saha')],
            ['username' => 'suyashgulati', 'password' => Hash::make('s19')],
            ['username' => 'a', 'password' => Hash::make('a')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
