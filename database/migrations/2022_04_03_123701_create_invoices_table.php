<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->float('subtotal');
            $table->string('discountType');
            $table->integer('discount');
            $table->integer('tax')->nullable();
            $table->float('grandtotal');
            $table->float('amountPaid');
            $table->float('totalDue');
            $table->longText('note')->nullable();
            $table->longText('comments')->nullable();
            $table->string('payment_type')->default('cash');
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
        Schema::dropIfExists('invoices');
    }
}