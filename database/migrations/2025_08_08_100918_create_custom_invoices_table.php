<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_invoices', function (Blueprint $table) {
            $table->id();

            $table->string('serviceName');
            $table->integer('price');
            $table->string('duration');
            $table->longText('features');
            $table->longText('link');
            $table->text('country');
            
            $table->string('clientName');
            $table->string('clientEmail');
            $table->string('clientPhone');

            $table->string('paymentMethod');
            $table->text('transactionId');
            $table->integer('amountPaid');
            $table->integer('tips');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_invoices');
    }
};
