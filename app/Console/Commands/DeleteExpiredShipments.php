<?php

namespace App\Console\Commands;

use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredShipments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipments:delete-expired 
                           {--days=5 : Number of days after closing cargo to delete shipments}
                           {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Soft delete shipments that have passed their closing cargo date by specified days (default: 5 days)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->option('days');
        $dryRun = $this->option('dry-run');
        
        $this->info("🚢 Checking for expired shipments (older than {$days} days from closing cargo)...");
        
        // Calculate the cutoff date (current date - days)
        $cutoffDate = Carbon::now()->subDays($days);
        
        // Find shipments where closing_cargo is older than cutoff date and not already soft deleted
        $expiredShipments = Shipment::whereDate('closing_cargo', '<', $cutoffDate)
                                  ->whereNull('deleted_at')
                                  ->get();
        
        if ($expiredShipments->isEmpty()) {
            $this->info("✅ No expired shipments found.");
            return 0;
        }
        
        $this->info("📋 Found {$expiredShipments->count()} expired shipments:");
        
        // Display table of expired shipments
        $headers = ['Shipment ID', 'Vessel Name', 'Route', 'Closing Cargo', 'Days Expired'];
        $rows = [];
        
        foreach ($expiredShipments as $shipment) {
            $closingCargoDate = Carbon::parse($shipment->closing_cargo);
            $daysExpired = $closingCargoDate->diffInDays(Carbon::now());
            
            $rows[] = [
                $shipment->shipment_id,
                $shipment->vessel_name,
                strtoupper($shipment->from_city) . ' → ' . strtoupper($shipment->to_city),
                $closingCargoDate->format('d M Y H:i'),
                $daysExpired . ' days'
            ];
        }
        
        $this->table($headers, $rows);
        
        if ($dryRun) {
            $this->warn("🔍 DRY RUN MODE: No shipments were actually deleted.");
            $this->info("💡 Run without --dry-run to actually delete these shipments.");
            return 0;
        }
        
        // Confirm deletion
        if (!$this->confirm("⚠️  Are you sure you want to soft delete these {$expiredShipments->count()} shipments?")) {
            $this->info("❌ Operation cancelled.");
            return 1;
        }
        
        // Soft delete the expired shipments
        $deletedCount = 0;
        foreach ($expiredShipments as $shipment) {
            try {
                $shipment->delete(); // This will soft delete
                $deletedCount++;
                $this->line("✅ Deleted: {$shipment->shipment_id} - {$shipment->vessel_name}");
            } catch (\Exception $e) {
                $this->error("❌ Failed to delete {$shipment->shipment_id}: {$e->getMessage()}");
            }
        }
        
        $this->info("🎉 Successfully soft deleted {$deletedCount} expired shipments.");
        $this->info("📝 Note: Shipments are soft deleted - they remain in database for history but won't appear in searches.");
        
        return 0;
    }
}