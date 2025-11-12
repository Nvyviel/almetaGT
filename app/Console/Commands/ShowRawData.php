<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class ShowRawData extends Command
{
    protected $signature = 'shipments:raw {id?}';
    protected $description = 'Show raw shipment data from database';

    public function handle()
    {
        $id = $this->argument('id');
        
        if ($id) {
            $shipment = DB::table('shipments')->where('id', $id)->first();
            if (!$shipment) {
                $this->error("Shipment with ID {$id} not found!");
                return 1;
            }
            
            $this->info("RAW Database Data for Shipment ID: {$id}");
            $this->line("from_city: '{$shipment->from_city}'");
            $this->line("to_city: '{$shipment->to_city}'");
            $this->line("vessel_name: '{$shipment->vessel_name}'");
        } else {
            $shipments = DB::table('shipments')->select('id', 'from_city', 'to_city', 'vessel_name')->get();
            
            $this->info("RAW Database Data for All Shipments:");
            foreach ($shipments as $shipment) {
                $this->line("ID: {$shipment->id} | from_city: '{$shipment->from_city}' | to_city: '{$shipment->to_city}'");
            }
        }
    }
}