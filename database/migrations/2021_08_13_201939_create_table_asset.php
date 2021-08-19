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
            // $table->string('asset_id');
            $table->string('display_name');
            $table->string('description');
            $table->string('image');
            $table->string('asset_path');
            $table->string('asset_type');
            $table->integer('asset_size');
            $table->string('model_path')->nullable();
            $table->string('model_type')->nullable();
            $table->integer('model_size')->nullable();
            $table->decimal('price',8,2); //สูงสุด 8 หลัก ทศนิยม 2 ตำแหน่ง
            $table->string('status_show')->default(0);
            $table->string('formats');
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
