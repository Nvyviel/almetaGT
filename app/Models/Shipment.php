<?php

namespace App\Models;

use App\Models\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Shipment $shipment) {
            if (empty($shipment->shipment_id)) {
                do {
                    $shipment->shipment_id = Str::random(8);
                } while (static::where('shipment_id', $shipment->shipment_id)->exists());
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'shipment_id';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_shipment_container')->withPivot('container_id');
    }

    public function user_order()
    {
        return $this->belongsTo(User::class);
    }

    public function containers()
    {
        return $this->hasMany(Container::class);
    }

    public function shippingInstructions()
    {
        return $this->hasMany(ShippingInstruction::class);
    }
}
