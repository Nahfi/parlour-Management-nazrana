<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('photo')->default('default.jpg');
            $table->text('brand_id')->nullable();
            $table->text('category_id');
            $table->longText('name');
            $table->longText('details')->nullable();
            $table->double('price');
            $table->double('service_ratings')->nullable();
            $table->integer("service_rating_count")->nullable();
            $table->string('status')->default('Active');
            $table->string('type')->default('product');
            $table->string('created_by');
            $table->string('edited_by')->nullable();
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
        Schema::dropIfExists('products');
    }
}