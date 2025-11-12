<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ForceFixCities extends Command
{
    protected $signature = 'shipments:force-fix-cities';
    protected $description = 'Force fix city names to lowercase';

    public function handle()
    {
        $this->info('🔧 Force fixing city names to lowercase...');
        
        // Get current data
        $shipments = DB::table('shipments')->get();
        $this->info("Found {$shipments->count()} shipments to update");
        
        foreach ($shipments as $shipment) {
            $newFromCity = strtolower($shipment->from_city);
            $newToCity = strtolower($shipment->to_city);
            
            $this->line("ID {$shipment->id}: {$shipment->from_city} → {$newFromCity}, {$shipment->to_city} → {$newToCity}");
            
            DB::table('shipments')
                ->where('id', $shipment->id)
                ->update([
                    'from_city' => $newFromCity,
                    'to_city' => $newToCity
                ]);
        }
        
        $this->info('✅ All city names fixed to lowercase!');
        return 0;
    }
}