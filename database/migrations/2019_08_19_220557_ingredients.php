<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ingredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ingredient_name');
            $table->string('ingredient_type');
            $table->float('ingredient_servings',4,1);
            $table->float('ingredient_price',4,2);
            $table->float('ingredient_quantity_kg',4,2);
            $table->float('ingredient_proteins',5,2);
            $table->float('ingredient_calories',5,2);
            $table->float('ingredient_lifetime',5,2);
            $table->string('ingredient_icon');
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
