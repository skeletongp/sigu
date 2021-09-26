<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id()->startingValue(20210001);
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->string('fullname', 100)->nullable();
            $table->string('slug')->nullable();
            $table->enum('darkmode',['Y','N'])->default('N');
            $table->string('photo')->nullable();
            $table->string('email')->nullable()->unique();
            $table->date('birthday');
            $table->foreignId('career_id')->nullable()->constrained();
            $table->string('password')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
