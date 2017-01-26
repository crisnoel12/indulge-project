<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name');
            $table->string('email')->unique();
			$table->date('birthday')->nullable();
			$table->enum('gender', ['Male', 'Female']);
			$table->enum('ethnicity', ['African', 'Asian', 'Caucasian', 'Pacific Islander'])->nullable();
			$table->enum('interested_in', ['Men', 'Women', 'Men & Women'])->nullable();
			$table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed'])->nullable();
			$table->string('country')->nullable();
            $table->string('state')->nullable();
			$table->text('bio')->nullable();
            $table->string('profile_pic');
            $table->string('password', 60);
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
