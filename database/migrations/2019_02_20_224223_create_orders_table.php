<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('order_api_id')->default(0);
            $table->unsignedInteger('quantity')->default(1);
            $table->string('link')->default();
            $table->string('status')->default("In Progress");
            $table->longText('comments')->nullable();
            $table->string('usernames')->nullable();
            $table->unsignedInteger('runs')->nullable();
            $table->unsignedInteger('interval')->nullable();
            $table->unsignedInteger('qty_min')->nullable();
            $table->unsignedInteger('qty_max')->nullable();
            $table->unsignedInteger('posts')->nullable();
            $table->unsignedInteger('delay')->nullable(); // MINUTES Possible values: 0, 5, 10, 15, 30, 60, 90
            $table->dateTimeTz('expiry')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        

        
        Schema::table('orders', function($table) {
           $table->foreign( 'user_id' )
            ->references( 'id' )->on( 'users' )
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
        Schema::dropIfExists('orders');
    }
}
