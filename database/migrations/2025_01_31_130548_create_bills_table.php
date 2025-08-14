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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('container_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipping_instruction_id')->constrained()->onDelete('cascade');
            $table->enum('payment_term', ['Port To Port','Door To Door','Door To Port','Port To Door'])->default('Port To Port');
            $table->unsignedBigInteger('thc_lolo');
            $table->unsignedBigInteger('freight_surcharge');
            $table->unsignedBigInteger('bl_do_fee');
            $table->unsignedBigInteger('apbs_fee');
            $table->unsignedBigInteger('trucking_buruh_fee');
            $table->unsignedBigInteger('grand_total');
            $table->unsignedBigInteger('seal_fee')->nullable();
            $table->unsignedBigInteger('operational_fee')->nullable();
            $table->unsignedBigInteger('dooring_fee');
            $table->unsignedBigInteger('refund_fee')->nullable();
            $table->unsignedBigInteger('ppn')->nullable();
            $table->unsignedBigInteger('others');
            $table->enum('status', ['Under Verification','Paid','Unpaid','Error'])->default('Unpaid');
            $table->string('upload_file');
            $table->timestamp('payment_confirmed_at')->nullable();
            $table->string('upload_confirmation')->nullable();
            $table->date('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
