<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Recipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
        $table->bigIncrements('recipes_id');
        $table->string('recipes_name');
        $table->string('recipes_type');
        $table->integer('recipes_cost');
        $table->longText('recipes_discription')->nullable();
        $table->integer('recipes_protein');
        $table->string('recipes_preparation');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
  
        });
    }


    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
