<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('category_id');
            $table->double('original_price');
            $table->double('discount_price');
            $table->tinyInteger( 'in_stock' )->default( 1 );
            $table->tinyInteger( 'status' )->default( 0 );
            $table->timestamps();
            
            
        });
        
        Schema::table('products', function($table) {
           $table->foreign( 'category_id' )
            ->references( 'id' )->on( 'categories' )
            ->onDelete( 'cascade' )
            ->onUpdate( 'cascade' );
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
