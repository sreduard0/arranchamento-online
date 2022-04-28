<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Arranchamentos extends Migration
{

    public function up()
    {
        Schema::create('arranchamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('date', 255);
            $table->tinyInteger('brekker');
            $table->tinyInteger('lunch');
            $table->tinyInteger('dinner');
             $table->integer('company_id');
              $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('arranchamentos');
    }
}
