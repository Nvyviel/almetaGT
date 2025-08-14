<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Container;
use App\Models\Shipment;
use App\Models\ShippingInstruction;
use App\Models\Consignee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShippingInstructionData extends Component
{
    public $shipment_id;
    public $container_id;
    public $consignee_id;
    public $container_numbers = [];
    public $seal_numbers = [];
    public $container_notes = [];
    public $shipments = [];
    public $containers = [];
    public $consignees = [];
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadAvailableShipments();
        $this->loadConsignees();
    }

    protected function generateInstructionId()
    {
        do {
            // Generate 4 random uppercase letters only (A-Z)
            $letters = '';
            for ($i = 0; $i < 4; $i++) {
                $letters .= chr(rand(65, 90)); // ASCII 65-90 = A-Z
            }

            // Generate 4 random numbers (0000-9999)
            $numbers = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

            $instructionId = $letters . $numbers;

            $exists = ShippingInstruction::where('instructions_id', $instructionId)->exists();
        } while ($exists);

        return $instructionId;
    }

    protected function loadConsignees()
    {
        $this->consignees = Consignee::select(
            'id',
            'name_consignee',
            'industry',
            'city',
            'email',
            'phone_number',
            'consignee_address'
        )
            ->where('user_id', $this->user->id)
            ->get();
    }

    protected function loadAvailableShipments()
    {
        $shipmentsWithAvailableContainers = Shipment::whereHas('containers', function ($query) {
            $query->where('status', 'Approved')
                ->whereNotIn('id', function ($subQuery) {
                    $subQuery->select('container_id')
                        ->from('shipping_instructions')
                        ->groupBy('container_id');
                });
        })->select('id', 'vessel_name')->get();

        $this->shipments = $shipmentsWithAvailableContainers;

        if ($this->shipment_id && !$shipmentsWithAvailableContainers->contains('id', $this->shipment_id)) {
            $this->reset([
                'shipment_id',
                'container_id',
                'consignee_id',
                'container_numbers',
                'seal_numbers',
                'container_notes'
            ]);
        }
    }

    public function updatedConsigneeId($consigneeId)
    {
        $this->reset([
            'shipment_id',
            'container_id',
            'container_numbers',
            'seal_numbers',
            'container_notes'
        ]);

        // Reload shipments when consignee changes
        $this->loadAvailableShipments();
        $this->containers = collect();
    }

    public function updatedShipmentId($shipmentId)
    {
        $this->reset([
            'container_id',
            'container_numbers',
            'seal_numbers',
            'container_notes'
        ]);

        if ($shipmentId && $this->consignee_id) {
            // Load containers berdasarkan shipment dan user_id (bukan consignee_id)
            $this->containers = Container::where('user_id', $this->user->id)
                ->where('shipment_id', $shipmentId)
                ->where('status', 'Approved')
                ->whereNotIn('id', function ($query) {
                    $query->select('container_id')
                        ->from('shipping_instructions');
                })
                ->select('id', 'id_order', 'container_type', 'quantity', 'weight')
                ->get();

            if ($this->containers->isEmpty()) {
                session()->flash('info', 'No available approved containers for this shipment.');
            }
        } else {
            $this->containers = collect();
        }
    }

    public function updatedContainerId($containerId)
    {
        if ($containerId) {
            $container = Container::where('id', $containerId)
                ->where('status', 'Approved')
                ->firstOrFail();

            $this->container_numbers = array_fill(0, $container->quantity, '');
            $this->seal_numbers = array_fill(0, $container->quantity, '');
            $this->container_notes = array_fill(0, $container->quantity, '');
        }
    }

    protected function rules()
    {
        $rules = [
            'shipment_id' => 'required|exists:shipments,id',
            'container_id' => [
                'required',
                'exists:containers,id',
                function ($attribute, $value, $fail) {
                    $container = Container::find($value);
                    if ($container && $container->status !== 'Approved') {
                        $fail('The selected container must be approved.');
                    }
                },
            ],
            'consignee_id' => 'required|exists:consignees,id',
        ];

        $containerCount = count($this->container_numbers);

        for ($i = 0; $i < $containerCount; $i++) {
            $rules["container_numbers.$i"] = 'required|string|max:255';
            $rules["seal_numbers.$i"] = 'required|string|max:255';
            $rules["container_notes.$i"] = 'nullable|string|max:255';
        }

        return $rules;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if (empty($this->container_numbers)) {
            $this->addError('container_id', 'Please select a container first.');
            return;
        }

        $container = Container::find($this->container_id);
        if ($container->status !== 'Approved') {
            $this->addError('container_id', 'Only approved containers can be processed.');
            return;
        }

        // Cek apakah sudah ada shipping instruction untuk container ini
        $existingInstruction = ShippingInstruction::where('container_id', $this->container_id)->first();
        if ($existingInstruction) {
            $this->addError('container_id', 'Shipping instruction already exists for this container.');
            return;
        }

        try {
            // Generate SATU instructions_id untuk seluruh container dalam order ini
            $instructionsId = $this->generateInstructionId();
            $createdCount = 0;
            $quantity = $container->quantity;

            for ($i = 0; $i < $quantity; $i++) {
                // Pastikan data ada di index ini
                if (!isset($this->container_numbers[$i]) || empty($this->container_numbers[$i])) {
                    continue;
                }

                $containerNumber = $this->container_numbers[$i];
                $sealNumber = $this->seal_numbers[$i] ?? '';
                $note = $this->container_notes[$i] ?? null;

                ShippingInstruction::create([
                    'instructions_id' => $instructionsId,
                    'user_id' => $this->user->id,
                    'shipment_id' => $this->shipment_id,
                    'container_id' => $this->container_id,
                    'consignee_id' => $this->consignee_id,
                    'no_container' => $containerNumber,
                    'no_seal' => $sealNumber,
                    'note' => $note,
                    'status' => 'Requested'
                ]);

                $createdCount++;
            }

            if ($createdCount === 0) {
                session()->flash('error', 'No shipping instructions were created. Please fill in container numbers.');
                return;
            }

            $this->loadAvailableShipments();

            $this->reset([
                'shipment_id',
                'container_id',
                'consignee_id',
                'container_numbers',
                'seal_numbers',
                'container_notes'
            ]);

            session()->flash('success', "Shipping instructions created successfully with ID: $instructionsId ($createdCount records created)");
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create shipping instructions: ' . $e->getMessage());
        }

        return redirect()->route('shipping-instruction');
    }

    public function render()
    {
        return view('livewire.shipping-instruction-data');
    }
}
