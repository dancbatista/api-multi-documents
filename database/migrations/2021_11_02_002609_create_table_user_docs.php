<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_docs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('document_type_id');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->string('document')->unique();
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
        Schema::dropIfExists('user_docs');
    }
}
