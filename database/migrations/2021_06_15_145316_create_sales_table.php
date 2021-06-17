<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier')->unique();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->unsignedBigInteger('file_id')->index()->nullable();
            $table->string('buyer_email');
            $table->decimal('sale_price', 6, 2);
            $table->decimal('sale_commission', 6, 2);
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
        Schema::dropIfExists('sales');
    }
}
