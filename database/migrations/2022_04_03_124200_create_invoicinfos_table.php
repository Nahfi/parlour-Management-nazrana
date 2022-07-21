<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicinfosTable extends Migration
{
    /**
     * Run the migrations .
     * @return void
     */
    public function up()
    {
        Schema::create('invoicinfos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('price');
            $table->integer('service_ratings')->nullable();
            $table->integer('employee_ratings')->nullable();
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
        Schema::dropIfExists('invoicinfos');
    }
}
