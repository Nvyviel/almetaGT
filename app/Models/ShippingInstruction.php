<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInstruction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getInstructionsIdAttribute($value)
    {
        return $value ?? ($this->attributes['si_id'] ?? null);
    }

    public function getNoContainerAttribute($value)
    {
        return $value ?? ($this->attributes['marks_and_numbers'] ?? null);
    }

    public function getNoSealAttribute($value)
    {
        if ($value !== null) {
            return $value;
        }

        return preg_match('/Seal:\s*([^|]+)/', $this->attributes['special_instructions'] ?? '', $matches)
            ? trim($matches[1])
            : null;
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consignee()
    {
        return $this->belongsTo(Consignee::class);
    }
}
