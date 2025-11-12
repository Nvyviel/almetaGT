<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Shipment;
use Carbon\Carbon;

class ValidateShipmentDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipments:validate-dates 
                            {--fix : Automatically fix invalid date orders}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate shipment dates are in correct chronological order (open_stack -> closing_cargo -> etd -> eta)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Validating shipment dates chronology...');
        
        $issues = [];
        $shipments = Shipment::whereNotNull(['open_stack', 'closing_cargo', 'etd', 'eta'])->get();
        
        foreach ($shipments as $shipment) {
            $dates = [
                'open_stack' => Carbon::parse($shipment->open_stack),
                'closing_cargo' => Carbon::parse($shipment->closing_cargo),
                'etd' => Carbon::parse($shipment->etd),
                'eta' => Carbon::parse($shipment->eta)
            ];
            
            $invalidSequences = [];
            
            // Check open_stack <= closing_cargo
            if ($dates['open_stack']->gt($dates['closing_cargo'])) {
                $invalidSequences[] = 'open_stack > closing_cargo';
            }
            
            // Check closing_cargo <= etd
            if ($dates['closing_cargo']->gt($dates['etd'])) {
                $invalidSequences[] = 'closing_cargo > etd';
            }
            
            // Check etd <= eta
            if ($dates['etd']->gt($dates['eta'])) {
                $invalidSequences[] = 'etd > eta';
            }
            
            if (!empty($invalidSequences)) {
                $issues[] = [
                    'shipment' => $shipment,
                    'issues' => $invalidSequences,
                    'dates' => $dates
                ];
            }
        }
        
        if (empty($issues)) {
            $this->info('✅ All shipment dates are in correct chronological order!');
            return 0;
        }
        
        $this->warn(sprintf('⚠️  Found %d shipments with date sequence issues:', count($issues)));
        
        foreach ($issues as $issue) {
            $shipment = $issue['shipment'];
            $dates = $issue['dates'];
            
            $this->newLine();
            $this->line("📦 Shipment: {$shipment->vessel_name} ({$shipment->from_city} → {$shipment->to_city})");
            $this->line("   Issues: " . implode(', ', $issue['issues']));
            $this->line("   Open Stack: " . $dates['open_stack']->format('d M Y H:i'));
            $this->line("   Closing Cargo: " . $dates['closing_cargo']->format('d M Y H:i'));
            $this->line("   ETD: " . $dates['etd']->format('d M Y H:i'));
            $this->line("   ETA: " . $dates['eta']->format('d M Y H:i'));
        }
        
        if ($this->option('fix')) {
            $this->newLine();
            if ($this->confirm('Do you want to automatically fix these date sequences?')) {
                $this->fixDateSequences($issues);
            }
        } else {
            $this->newLine();
            $this->info('💡 Run with --fix option to automatically correct these issues.');
            $this->info('   Command: php artisan shipments:validate-dates --fix');
        }
        
        return 1;
    }
    
    private function fixDateSequences($issues)
    {
        $fixed = 0;
        
        foreach ($issues as $issue) {
            $shipment = $issue['shipment'];
            $dates = $issue['dates'];
            
            // Create a properly ordered sequence
            $orderedDates = collect([
                $dates['open_stack'],
                $dates['closing_cargo'],
                $dates['etd'],
                $dates['eta']
            ])->sort();
            
            $newDates = $orderedDates->values();
            
            // Update shipment with corrected dates
            $shipment->update([
                'open_stack' => $newDates[0]->format('Y-m-d H:i:s'),
                'closing_cargo' => $newDates[1]->format('Y-m-d H:i:s'),
                'etd' => $newDates[2]->format('Y-m-d H:i:s'),
                'eta' => $newDates[3]->format('Y-m-d H:i:s')
            ]);
            
            $this->info("✅ Fixed: {$shipment->vessel_name}");
            $fixed++;
        }
        
        $this->info("🎉 Successfully fixed {$fixed} shipments!");
    }
}