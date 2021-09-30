<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('subject_id')->constrained();
          
            $table->integer('trimester');
            $table->decimal('ap')->nullable();
            $table->decimal('poe')->nullable();
            $table->decimal('pf')->nullable();
            $table->decimal('ef')->nullable();
            $table->decimal('nf')->nullable();
            $table->enum('status',['aproved','failed','coursing']);
            $table->softDeletes();
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
        Schema::dropIfExists('subject_user');
    }
}
