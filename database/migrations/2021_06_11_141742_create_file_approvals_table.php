<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('file_id')->index();
            $table->string('title');
            $table->string('overview_short', 300);
            $table->text('overview');
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
        Schema::dropIfExists('file_approvals');
    }
}
