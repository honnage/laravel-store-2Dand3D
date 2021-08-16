<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAsset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('display_name');
            $table->string('description');
            $table->string('image');
            $table->string('asset');
            $table->string('model_path')->nullable();
            $table->string('model_type')->nullable();
            $table->string('model_size')->nullable();
            $table->decimal('price',8,2); //สูงสุด 8 หลัก ทศนิยม 2 ตำแหน่ง
            $table->integer('category_id');
            $table->integer('typefile_id');
            $table->integer('license_id');
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
        Schema::dropIfExists('asset');
    }
}
