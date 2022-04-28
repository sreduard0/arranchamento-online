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
            $table->time('h_ccsv');
            $table->time('h_cia1');
            $table->time('h_cia2');
            $table->time('h_cia4');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
