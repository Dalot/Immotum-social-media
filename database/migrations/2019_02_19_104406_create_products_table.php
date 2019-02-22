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
            $table->mediumText('description');
            $table->string('category_name');
            $table->unsignedInteger('category_id')->nullable();
            $table->double('original_price');
            $table->double('our_price_factor')->default( 30 );
            $table->double('our_price')->nullable();
            $table->unsignedMediumInteger( 'min' );
            $table->unsignedInteger('max');
            $table->boolean('available')->default( true );
            $table->softDeletes();
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
