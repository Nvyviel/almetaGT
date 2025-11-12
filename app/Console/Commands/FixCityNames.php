<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Shipment;

class FixCityNames extends Command
{
    protected $signature = 'shipments:fix-city-names {--dry-run : Show what will be changed without making changes}';
    protected $description = 'Fix city names to use lowercase format for consistency';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->info('🔍 DRY RUN MODE - No changes will be made');
        } else {
            $this->info('🔧 FIXING city names...');
        }
        
        $this->newLine();
        
        // City name mappings (from current format to correct format)
        $cityMappings = [
            'Surabaya' => 'surabaya',
            'Pontianak' => 'pontianak',
            'Semarang' => 'semarang',
            'Banjarmasin' => 'banjarmasin',
            'Sampit' => 'sampit',
            'Jakarta' => 'jakarta',
            'Kumai' => 'kumai',
            'Samarinda' => 'samarinda',
            'Balikpapan' => 'balikpapan',
            'Berau' => 'berau',
            'Palu' => 'palu',
            'Bitung' => 'bitung',
            'Gorontalo' => 'gorontalo',
            'Ambon' => 'ambon',
            'Makassar' => 'makassar',
            'Morowali' => 'morowali',
            'Kendari' => 'kendari',
            'Pomala' => 'pomala',
            'Ternate' => 'ternate',
            'Jayapura' => 'jayapura',
            'Kupang' => 'kupang',
            'Sorong' => 'sorong',
            'Manokwari' => 'manokwari',
            'Merauke' => 'merauke',
            'Bau-Bau' => 'bau-bau',
            'Maumere' => 'maumere',
            'Tual' => 'tual',
            'Fak-Fak' => 'fak-fak',
            'Bintuni' => 'bintuni',
            'Nabire' => 'nabire',
            'Serui' => 'serui'
        ];
        
        $shipments = Shipment::all();
        $fixedCount = 0;
        
        foreach ($shipments as $shipment) {
            $changed = false;
            $oldFromCity = $shipment->from_city;
            $oldToCity = $shipment->to_city;
            $newFromCity = $oldFromCity;
            $newToCity = $oldToCity;
            
            // Check from_city
            if (isset($cityMappings[$shipment->from_city])) {
                $newFromCity = $cityMappings[$shipment->from_city];
                $changed = true;
            }
            
            // Check to_city  
            if (isset($cityMappings[$shipment->to_city])) {
                $newToCity = $cityMappings[$shipment->to_city];
                $changed = true;
            }
            
            if ($changed) {
                $this->line("📦 Shipment ID {$shipment->id} ({$shipment->vessel_name}):");
                $this->line("   From: '{$oldFromCity}' → '{$newFromCity}'");
                $this->line("   To: '{$oldToCity}' → '{$newToCity}'");
                
                if (!$isDryRun) {
                    $shipment->update([
                        'from_city' => $newFromCity,
                        'to_city' => $newToCity
                    ]);
                    $this->info("   ✅ Fixed!");
                }
                
                $fixedCount++;
                $this->newLine();
            }
        }
        
        if ($fixedCount === 0) {
            $this->info('✅ All city names are already in correct format!');
        } else {
            if ($isDryRun) {
                $this->warn("Found {$fixedCount} shipments that need city name fixes.");
                $this->info("💡 Run without --dry-run to apply the fixes:");
                $this->info("   php artisan shipments:fix-city-names");
            } else {
                $this->info("🎉 Successfully fixed {$fixedCount} shipments!");
            }
        }
        
        return 0;
    }
}