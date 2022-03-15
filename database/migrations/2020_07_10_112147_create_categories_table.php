<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('slug_en')->unique();
            $table->longText('description_en')->nullable();
            $table->string('title_ar');
            $table->string('slug_ar')->unique();
            $table->longText('description_ar')->nullable();
            $table->string('image')->nullable();
            $table->enum('published',[0,1])->default(1);   
            $table->boolean('is_parent')->default(1);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
           
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('categories');
    }
}
