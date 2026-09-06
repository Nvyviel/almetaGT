<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameConsigneeAttribute($value)
    {
        return $value ?? ($this->attributes['consignee_name'] ?? null);
    }

    public function getEmailAttribute($value)
    {
        return $value ?? ($this->attributes['consignee_email'] ?? null);
    }

    public function getPhoneNumberAttribute($value)
    {
        return $value ?? ($this->attributes['consignee_phone'] ?? null);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingInstruction()
    {
        return $this->hasMany(shippingInstruction::class);
    }

    public function containers()
    {
        return $this->hasMany(Container::class, 'consignee_id');
    }
}