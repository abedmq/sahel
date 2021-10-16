<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends \App\Classes\BaseMigration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
//            $table->id();
            $this->addDefaultTable($table);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->string('image')->nullable();

            $table->rememberToken();
//            $table->timestamps();
//            $table->softDeletes();
        });


        \App\Models\User::create([
            'name'               => 'abedelrahman abu amna',
            'status'             => 1,
            'email'             => "abedmq2@gmail.com",
            'mobile_verified_at' => \Carbon\Carbon::now(),
            'password'           => '123123123',
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
