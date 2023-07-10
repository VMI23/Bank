<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('holding_id');
            $table->decimal('amount_bought', 10, 4)->nullable();
            $table->decimal('amount_sold', 10, 4)->nullable();
            $table->decimal('price_bought', 10, 4)->nullable();
            $table->decimal('price_sold', 10, 4)->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('selling_date')->nullable();
            $table->timestamps();

            $table->foreign('holding_id')->references('id')->on('holdings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_histories');
    }
}
