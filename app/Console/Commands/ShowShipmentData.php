<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Shipment;

class ShowShipmentData extends Command
{
    protected $signature = 'shipments:show {id?} {--limit=3}';
    protected $description = 'Show shipment data for debugging';

    public function handle()
    {
        $id = $this->argument('id');
        $limit = $this->option('limit');
        
        if ($id) {
            // Show specific shipment
            $shipment = Shipment::find($id);
            
            if (!$shipment) {
                $this->error("Shipment with ID {$id} not found!");
                return 1;
            }
            
            $this->info("Shipment Details (ID: {$id}):");
            $this->newLine();
            $this->line("Vessel: {$shipment->vessel_name}");
            $this->line("Route: {$shipment->from_city} → {$shipment->to_city}");
            $this->line("Open Stack: {$shipment->open_stack}");
            $this->line("Closing Cargo: {$shipment->closing_cargo}");
            $this->line("ETD: {$shipment->etd}");
            $this->line("ETA: {$shipment->eta}");
            $this->line("Freight 20': Rp " . number_format($shipment->freight_20, 0, ',', '.'));
            $this->line("Freight 40': Rp " . number_format($shipment->freight_40, 0, ',', '.'));
            
        } else {
            // Show multiple shipments
            $shipments = Shipment::select('id', 'vessel_name', 'from_city', 'to_city', 'open_stack', 'closing_cargo')
                                ->take($limit)
                                ->get();
            
            $this->info("Found {$shipments->count()} shipments:");
            $this->newLine();
            
            foreach ($shipments as $shipment) {
                $this->line("ID: {$shipment->id}");
                $this->line("Vessel: {$shipment->vessel_name}");
                $this->line("Route: {$shipment->from_city} → {$shipment->to_city}");
                $this->line("Open Stack: {$shipment->open_stack}");
                $this->line("Closing Cargo: {$shipment->closing_cargo}");
                $this->line("---");
            }
        }
        
        return 0;
    }
}