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
        Schema::create('custom_emails', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->string('subject');
            $table->longText('message');
            $table->json('attachments')->nullable();

            $table->string('source')->nullable(); // 'custom' | 'reply'
            $table->string('in_reply_to')->nullable();
            $table->text('references')->nullable();
            $table->unsignedBigInteger('replied_inbox_id')->nullable(); // your IMAP msg id (optional)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_emails');
    }
};
