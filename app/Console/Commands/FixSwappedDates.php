<?php

namespace App\Console\Commands;

use App\Models\Shipment;
use Illuminate\Console\Command;
use Carbon\Carbon;

class FixSwappedDates extends Command
{
    protected $signature = 'shipments:fix-swapped-dates 
                           {--dry-run : Show what would be fixed without actually fixing}
                           {--force : Force fix without confirmation}';

    protected $description = 'Fix shipments where open_stack and closing_cargo dates are swapped';

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $force = $this->option('force');
        
        $this->info('🔍 Checking for shipments with swapped open_stack and closing_cargo dates...');
        
        // Find shipments where open_stack > closing_cargo (which is logically wrong)
        $swappedShipments = Shipment::whereRaw('open_stack > closing_cargo')
                                  ->whereNull('deleted_at')
                                  ->get();
        
        if ($swappedShipments->isEmpty()) {
            $this->info('✅ No shipments found with swapped dates.');
            return 0;
        }
        
        $this->info("📋 Found {$swappedShipments->count()} shipments with swapped dates:");
        
        // Display table of swapped shipments
        $headers = ['Shipment ID', 'Vessel Name', 'Open Stack (Wrong)', 'Closing Cargo (Wrong)', 'Should Be Swapped?'];
        $rows = [];
        
        foreach ($swappedShipments as $shipment) {
            $openStack = Carbon::parse($shipment->open_stack);
            $closingCargo = Carbon::parse($shipment->closing_cargo);
            
            $rows[] = [
                $shipment->shipment_id,
                $shipment->vessel_name,
                $openStack->format('d M Y H:i'),
                $closingCargo->format('d M Y H:i'),
                'YES - Open Stack should be earlier'
            ];
        }
        
        $this->table($headers, $rows);
        
        if ($dryRun) {
            $this->warn('🔍 DRY RUN MODE: No dates were actually swapped.');
            $this->info('💡 Run without --dry-run to actually fix these dates.');
            return 0;
        }
        
        // Confirm fix
        if (!$force && !$this->confirm("⚠️  Are you sure you want to swap the dates for these {$swappedShipments->count()} shipments?")) {
            $this->info('❌ Operation cancelled.');
            return 1;
        }
        
        // Fix the swapped dates
        $fixedCount = 0;
        foreach ($swappedShipments as $shipment) {
            try {
                // Store original values
                $originalOpenStack = $shipment->open_stack;
                $originalClosingCargo = $shipment->closing_cargo;
                
                // Swap the dates
                $shipment->update([
                    'open_stack' => $originalClosingCargo,     // closing_cargo becomes open_stack
                    'closing_cargo' => $originalOpenStack      // open_stack becomes closing_cargo
                ]);
                
                $fixedCount++;
                $this->line("✅ Fixed: {$shipment->shipment_id} - {$shipment->vessel_name}");
                $this->line("   Open Stack: {$originalOpenStack} → {$originalClosingCargo}");
                $this->line("   Closing Cargo: {$originalClosingCargo} → {$originalOpenStack}");
                
            } catch (\Exception $e) {
                $this->error("❌ Failed to fix {$shipment->shipment_id}: {$e->getMessage()}");
            }
        }
        
        $this->info("🎉 Successfully fixed {$fixedCount} shipments with swapped dates.");
        $this->info("📝 Note: Open Stack now comes before Closing Cargo as it should be.");
        
        return 0;
    }
}