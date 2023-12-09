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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('stripe_customer_id')->default('0');
            $table->date('start_date')->default('0000-00-00');
            $table->date('end_date')->default('0000-00-00');
            $table->string('term')->default('');
            $table->integer('invoice_period')->default(0);
            $table->integer('term_interval')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
