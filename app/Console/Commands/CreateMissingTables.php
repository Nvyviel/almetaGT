<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMissingTables extends Command
{
    protected $signature = 'make:missing-tables';
    protected $description = 'Create all missing tables in correct order';

    public function handle()
    {
        $this->info('🚀 Creating missing tables...');
        
        // 1. Create consignees table
        $this->createConsigneesTable();
        
        // 2. Create stock_seals table
        $this->createStockSealsTable();
        
        // 3. Create shipping_instructions table
        $this->createShippingInstructionsTable();
        
        // 4. Create bills table (depends on shipping_instructions)
        $this->createBillsTable();
        
        // 5. Create feedback table
        $this->createFeedbackTable();
        
        $this->info('🎉 All missing tables created successfully!');
        return 0;
    }
    
    private function createConsigneesTable()
    {
        if (Schema::hasTable('consignees')) {
            $this->line('✓ Table consignees already exists');
            return;
        }
        
        Schema::create('consignees', function (Blueprint $table) {
            $table->id();
            $table->string('consignee_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('consignee_name');
            $table->string('consignee_address');
            $table->string('consignee_phone');
            $table->string('consignee_email');
            $table->timestamps();
        });
        
        DB::table('migrations')->insert([
            'migration' => '2025_01_13_065520_create_consignees_table',
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);
        
        $this->info('✅ Table consignees created');
    }
    
    private function createStockSealsTable()
    {
        if (Schema::hasTable('stock_seals')) {
            $this->line('✓ Table stock_seals already exists');
            return;
        }
        
        Schema::create('stock_seals', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->integer('stock');
            $table->timestamps();
        });
        
        DB::table('migrations')->insert([
            'migration' => '2025_01_23_013245_create_stock_seals_table',
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);
        
        $this->info('✅ Table stock_seals created');
    }
    
    private function createShippingInstructionsTable()
    {
        if (Schema::hasTable('shipping_instructions')) {
            $this->line('✓ Table shipping_instructions already exists');
            return;
        }
        
        Schema::create('shipping_instructions', function (Blueprint $table) {
            $table->id();
            $table->string('si_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->foreignId('container_id')->constrained()->onDelete('cascade');
            $table->foreignId('consignee_id')->constrained()->onDelete('cascade');
            $table->string('shipper_name');
            $table->text('shipper_address');
            $table->string('shipper_phone');
            $table->string('shipper_email');
            $table->string('notify_party_name')->nullable();
            $table->text('notify_party_address')->nullable();
            $table->string('notify_party_phone')->nullable();
            $table->string('notify_party_email')->nullable();
            $table->text('description_of_goods');
            $table->decimal('gross_weight', 10, 2);
            $table->decimal('net_weight', 10, 2);
            $table->decimal('measurement', 10, 2);
            $table->integer('packages');
            $table->string('package_type');
            $table->text('marks_and_numbers')->nullable();
            $table->text('special_instructions')->nullable();
            $table->enum('status', ['Draft', 'Submitted', 'Approved', 'Rejected'])->default('Draft');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
        
        DB::table('migrations')->insert([
            'migration' => '2025_01_18_110435_create_shipping_instructions_table',
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);
        
        $this->info('✅ Table shipping_instructions created');
    }
    
    private function createBillsTable()
    {
        if (Schema::hasTable('bills')) {
            $this->line('✓ Table bills already exists');
            return;
        }
        
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
        
        DB::table('migrations')->insert([
            'migration' => '2025_01_31_130548_create_bills_table',
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);
        
        $this->info('✅ Table bills created');
    }
    
    private function createFeedbackTable()
    {
        if (Schema::hasTable('feedback')) {
            $this->line('✓ Table feedback already exists');
            return;
        }
        
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('feedback_id')->unique();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->enum('status', ['New', 'Read', 'Replied'])->default('New');
            $table->text('admin_reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });
        
        DB::table('migrations')->insert([
            'migration' => '2025_08_03_151452_create_feedback_table',
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);
        
        $this->info('✅ Table feedback created');
    }
}