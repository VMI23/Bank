<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_account_id')->nullable();
            $table->unsignedBigInteger('receiver_account_id')->nullable();
            $table->unsignedBigInteger('receiver_user_id')->nullable();
            $table->string('type');
            $table->string('currency');
            $table->string('direction');
            $table->decimal('amount', 8, 2);
            $table->decimal('rate', 8, 2);
            $table->decimal('amount_in_corresponding_currency', 15, 2);
            $table->timestamp('date');

            // Add other columns as needed

            $table->timestamps();

            $table->foreign('sender_account_id')->references('id')->on('accounts')
                ->onDelete('cascade');
            $table->foreign('receiver_account_id')->references('id')->on('accounts')
                ->onDelete('set null');
            $table->foreign('receiver_user_id')->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
