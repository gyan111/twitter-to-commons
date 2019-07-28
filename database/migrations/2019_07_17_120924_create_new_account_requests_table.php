<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewAccountRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_account_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('handle');
            $table->string('name');
            $table->string('template');
            $table->string('category');
            $table->string('author');
            $table->tinyInteger('is_approved')->default(0);
            $table->string('otrs')->nullable();
            $table->integer('approved_by')->nullable();
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
        Schema::dropIfExists('new_account_requests');
    }
}
