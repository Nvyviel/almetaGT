<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class ChronologicalDates implements ValidationRule
{
    private $dates;
    
    public function __construct($dates)
    {
        $this->dates = $dates;
    }
    
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Convert all dates to Carbon instances
        $dateValues = [];
        
        foreach ($this->dates as $key => $dateValue) {
            if ($key === $attribute) {
                $dateValues[$key] = Carbon::parse($value);
            } else {
                $dateValues[$key] = $dateValue ? Carbon::parse($dateValue) : null;
            }
        }
        
        // Check if all required dates are present
        if (in_array(null, $dateValues)) {
            return; // Skip validation if any date is missing
        }
        
        // Define expected order
        $expectedOrder = ['open_stack', 'closing_cargo', 'etd', 'eta'];
        
        // Validate chronological order
        for ($i = 0; $i < count($expectedOrder) - 1; $i++) {
            $current = $expectedOrder[$i];
            $next = $expectedOrder[$i + 1];
            
            if (isset($dateValues[$current]) && isset($dateValues[$next])) {
                if ($dateValues[$current]->gt($dateValues[$next])) {
                    $currentLabel = ucfirst(str_replace('_', ' ', $current));
                    $nextLabel = ucfirst(str_replace('_', ' ', $next));
                    
                    $fail("$currentLabel cannot be later than $nextLabel. Please ensure dates are in chronological order: Open Stack → Closing Cargo → ETD → ETA");
                    return;
                }
            }
        }
    }
}