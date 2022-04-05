<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration
{
 public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('date', 255);
            $table->text('brekker');
            $table->text('lunch');
            $table->text('dinner');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
