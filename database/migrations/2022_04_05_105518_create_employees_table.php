<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->text("image")->default('default.jpg');
            $table->longText("description");
            $table->text("address");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("designation");
            $table->string("identificationNumber")->unique();
            $table->double("salary");
            $table->double("advanced_payment")->default(0);
            $table->double("remaining_advanced_payment")->default(0);
            $table->dateTime('update_date_time')->nullable();
            $table->double("employee_ratings")->nullable();
            $table->integer("employee_rating_count")->nullable();
            $table->string('status')->default('Active');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->softDeletes();
            $table->date('joinDate');
            $table->rememberToken();
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
        Schema::dropIfExists('employees');
    }
}