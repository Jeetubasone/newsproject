<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->comment('this will be from category(id)')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->comment('this will be from subcategory(id)')->nullable();
            $table->foreign('subcategory_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('subcategory_name')->nullable();
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->date('date')->nullable();
            $table->string('location')->nullable();
            $table->integer('total_view')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('news');
    }
};
