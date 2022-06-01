<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemDisbursedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_disburseds', function (Blueprint $table) {
            $table->id();
            $table->string('itemnam');
            $table->string('zoneName');
            $table->string('roadName');
            $table->integer('quantity');
            $table->date('disbursedDate');
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
        Schema::dropIfExists('item_disburseds');
    }
}
