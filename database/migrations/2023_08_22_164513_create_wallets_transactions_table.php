<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('symbol');
            $table->decimal('amount', 18, 8);
            $table->decimal('amount_recieved', 18, 8);
            $table->decimal('charge', 18, 8);
            $table->decimal('fees', 18, 8);
            $table->string('to');
            $table->string('type');
            $table->string('chain');
            $table->string('status');
            $table->string('trx');
            $table->string('wallet_type');
            $table->string('address');
            $table->string('details');
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
        Schema::dropIfExists('wallets_transactions');
    }
};
