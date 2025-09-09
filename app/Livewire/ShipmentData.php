<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shipment;
use Illuminate\Support\Facades\Log;

class ShipmentData extends Component
{
    public $isOpen = false;
    public $editingShipmentId;

    public $from_city = '';
    public $to_city = '';
    public $vessel_name = '';
    public $closing_cargo = '';
    public $etb = '';
    public $etd = '';
    public $eta = '';
    public $freight_20 = '';
    public $freight_40 = '';

    // Add listeners for Livewire events
    protected $listeners = ['freightUpdated' => 'handleFreightUpdate'];

    public function hydrate()
    {
        // Ensure freight values are properly formatted for display when component is hydrated
        if (is_numeric($this->freight_20) && !empty($this->freight_20)) {
            $this->freight_20 = number_format($this->freight_20, 0, ',', '.');
        }
        if (is_numeric($this->freight_40) && !empty($this->freight_40)) {
            $this->freight_40 = number_format($this->freight_40, 0, ',', '.');
        }
    }

    public function handleFreightUpdate()
    {
        // Re-emit to update frontend formatting
        $this->emit('freightFormatted');
    }

    public $cities = [
        'surabaya',
        'pontianak',
        'semarang',
        'banjarmasin',
        'sampit',
        'jakarta',
        'kumai',
        'samarinda',
        'balikpapan',
        'berau',
        'palu',
        'bitung',
        'gorontalo',
        'ambon'
    ];

    protected $rules = [
        'from_city' => 'required|string',
        'to_city' => 'required|string',
        'vessel_name' => 'required|string|max:255',
        'closing_cargo' => 'required|date',
        'etb' => 'required|date',
        'etd' => 'required|date|after:etb',
        'eta' => 'required|date|after:etd',
        'freight_20' => 'required|numeric|min:0',
        'freight_40' => 'required|numeric|min:0',
    ];

    protected $messages = [
        'from_city.required' => 'Port of Loading is required',
        'to_city.required' => 'Port of Discharge is required',
        'vessel_name.required' => 'Vessel name is required',
        'closing_cargo.required' => 'Closing cargo date is required',
        'etb.required' => 'ETB is required',
        'etd.required' => 'ETD is required',
        'eta.required' => 'ETA is required',
        'etd.after' => 'ETD must be after ETB',
        'eta.after' => 'ETA must be after ETD',
        'freight_20.required' => 'Rate per container is required',
        'freight_20.numeric' => 'Rate must be a number',
        'freight_20.min' => 'Rate cannot be negative',
        'freight_40.required' => 'Rate per container is required',
        'freight_40.numeric' => 'Rate per container must be a number',
        'freight_40.min' => 'Rate per container cannot be negative',
    ];

    public function addSchedule()
    {
        try {
            // Clean dots from freight values to get pure numbers
            $this->freight_20 = $this->cleanNumber($this->freight_20);
            $this->freight_40 = $this->cleanNumber($this->freight_40);

            $validatedData = $this->validate();

            // Convert vessel name to uppercase
            $validatedData['vessel_name'] = strtoupper($validatedData['vessel_name']);

            // Create new shipment
            Shipment::create($validatedData);

            // Reset form after success
            $this->reset(['from_city', 'to_city', 'vessel_name', 'closing_cargo', 'etb', 'etd', 'eta', 'freight_20', 'freight_40']);

            // Show success message
            session()->flash('success', 'Shipment schedule created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to create shipment schedule. Please try again.');
        }
    }


    public function deleteShipment($shipmentId)
    {
        try {
            $shipment = Shipment::findOrFail($shipmentId);
            $shipment->delete();
            session()->flash('success', 'Shipment deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete shipment. Please try again.');
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset();
    }

    public function mount(Shipment $shipment)
    {
        $this->vessel_name = $shipment->vessel_name;
        $this->from_city = $shipment->from_city;
        $this->to_city = $shipment->to_city;
        $this->closing_cargo = $shipment->closing_cargo;
        $this->etb = $shipment->etb;
        $this->etd = $shipment->etd;
        $this->eta = $shipment->eta;
        // Format freight values with thousand separators for display
        $this->freight_20 = $shipment->freight_20 ? number_format($shipment->freight_20, 0, ',', '.') : '';
        $this->freight_40 = $shipment->freight_40 ? number_format($shipment->freight_40, 0, ',', '.') : '';
    }

    // Method to format numbers for display
    public function formatForDisplay($value)
    {
        return $value ? number_format($value, 0, ',', '.') : '';
    }

    // Method to clean numbers for processing
    public function cleanNumber($value)
    {
        return str_replace('.', '', $value);
    }


    public function update()
    {
        try {
            // Clean dots from freight values to get pure numbers
            $this->freight_20 = $this->cleanNumber($this->freight_20);
            $this->freight_40 = $this->cleanNumber($this->freight_40);

            $validatedData = $this->validate();

            // Convert vessel name to uppercase
            $validatedData['vessel_name'] = strtoupper($validatedData['vessel_name']);

            $this->shipment->update($validatedData);

            session()->flash('success', 'Shipment updated successfully');
            return redirect()->route('dashboard-admin');
        } catch (\Exception $e) {
            Log::error('Error updating shipment: ' . $e->getMessage());
            session()->flash('error', 'Failed to update shipment. Please try again.');
        }
    }

    public function render()
    {
        $shipments = Shipment::all();
        return view('livewire.shipment-data', [
            'shipments' => $shipments
        ]);
    }
}