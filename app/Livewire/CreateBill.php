<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Shipment;
use App\Models\Container;
use App\Models\Bill;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CreateBill extends Component
{
    use WithFileUploads;

    public $user_id;
    public $shipment_id;
    public $container_id;
    public $shipping_instruction_id;
    public $payment_term = 'Port To Port';
    public $status = 'Unpaid';
    
    // Fee properties
    public $thc_lolo = 0;
    public $freight_surcharge = 0;
    public $bl_do_fee = 0;
    public $apbs_fee = 0;
    public $trucking_buruh_fee = 0;
    public $dooring_fee = 0;
    public $seal_fee = 0;
    public $operational_fee = 0;
    public $refund_fee = 0;
    public $ppn = 0;
    public $others = 0;
    public $grand_total = 0;
    
    public $uploadFile;
    public $selectedData = null;
    
    // Collections
    public $users = [];
    public $shipments = [];
    public $containers = [];

    public function mount()
    {
        Log::info('CreateBill component mounted by user: Nvyviel');
        $this->loadUsers();
        $this->calculateGrandTotal();
    }

    public function loadUsers()
    {
        $this->users = User::select('id', 'company_name')->get();
        Log::info('Users loaded', ['count' => $this->users->count()]);
    }

    public function updatedUserId($userId)
    {
        Log::info('User ID updated', ['user_id' => $userId]);
        
        $this->reset([
            'shipment_id',
            'container_id',
            'shipping_instruction_id', // TAMBAH
            'selectedData',
            'shipments',
            'containers'
        ]);

        if ($userId) {
            $this->shipments = Shipment::whereHas('containers', function($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('status', 'Approved');
            })->select('id', 'vessel_name', 'from_city', 'to_city', 'freight_20', 'freight_40')->get();
            
            Log::info('Shipments loaded for user', [
                'user_id' => $userId,
                'shipments_count' => $this->shipments->count(),
                'shipments' => $this->shipments->toArray()
            ]);
        } else {
            $this->shipments = collect();
        }
    }

    public function updatedShipmentId($shipmentId)
    {
        Log::info('Shipment ID updated', [
            'shipment_id' => $shipmentId,
            'user_id' => $this->user_id
        ]);
        
        $this->reset([
            'container_id',
            'shipping_instruction_id', // TAMBAH
            'selectedData',
            'containers'
        ]);

        if ($shipmentId && $this->user_id) {
            $this->containers = Container::where('user_id', $this->user_id)
                ->where('shipment_id', $shipmentId)
                ->where('status', 'Approved')
                ->whereNotExists(function($query) {
                    $query->select(DB::raw(1))
                          ->from('bills')
                          ->whereRaw('bills.container_id = containers.id');
                })
                ->select('id', 'id_order', 'container_type', 'quantity', 'weight')
                ->get();
                
            Log::info('Containers loaded for shipment', [
                'shipment_id' => $shipmentId,
                'user_id' => $this->user_id,
                'containers_count' => $this->containers->count(),
                'containers' => $this->containers->toArray()
            ]);
        } else {
            $this->containers = collect();
        }
    }

    public function updatedContainerId($containerId)
    {
        Log::info('Container ID updated', [
            'container_id' => $containerId,
            'shipment_id' => $this->shipment_id
        ]);
        
        if ($containerId && $this->shipment_id) {
            $shipment = Shipment::findOrFail($this->shipment_id);
            $container = Container::findOrFail($containerId);
            
            // TAMBAH: Cari shipping_instruction_id yang sesuai
            $shippingInstruction = \App\Models\ShippingInstruction::where('container_id', $containerId)
                ->where('shipment_id', $this->shipment_id)
                ->where('status', 'Approved')
                ->first();
                
            if ($shippingInstruction) {
                $this->shipping_instruction_id = $shippingInstruction->id;
                Log::info('Shipping instruction found', ['shipping_instruction_id' => $this->shipping_instruction_id]);
            } else {
                Log::warning('No shipping instruction found for container', [
                    'container_id' => $containerId,
                    'shipment_id' => $this->shipment_id
                ]);
            }
            
            $this->selectedData = [
                'vessel_name' => $shipment->vessel_name,
                'route' => $shipment->from_city . ' - ' . $shipment->to_city,
                'id_order' => $container->id_order,
                'container_type' => $container->container_type,
                'quantity' => $container->quantity,
                'weight' => $container->weight,
                'freight_20' => $shipment->freight_20,
                'freight_40' => $shipment->freight_40,
            ];

            Log::info('Selected data prepared', ['selected_data' => $this->selectedData]);
            $this->autoCalculateFees($shipment, $container);
        }
    }

    public function autoCalculateFees($shipment, $container)
    {
        $containerSize = $this->getContainerSize($container->container_type);
        $freight_rate = $containerSize == '20' ? $shipment->freight_20 : $shipment->freight_40;
        
        $this->thc_lolo = $containerSize == '20' ? 500000 : 750000;
        $this->freight_surcharge = $freight_rate * $container->quantity;
        $this->bl_do_fee = 250000;
        $this->apbs_fee = 150000;
        $this->trucking_buruh_fee = $container->quantity * 100000;
        $this->dooring_fee = $this->payment_term !== 'Port To Port' ? 300000 : 0;
        $this->others = 0;
        $this->seal_fee = 0;
        $this->operational_fee = 0;
        $this->refund_fee = 0;
        $this->ppn = 0;
        
        Log::info('Fees auto-calculated', [
            'container_size' => $containerSize,
            'freight_rate' => $freight_rate,
            'calculated_fees' => [
                'thc_lolo' => $this->thc_lolo,
                'freight_surcharge' => $this->freight_surcharge,
                'bl_do_fee' => $this->bl_do_fee,
                'apbs_fee' => $this->apbs_fee,
                'trucking_buruh_fee' => $this->trucking_buruh_fee,
                'dooring_fee' => $this->dooring_fee,
            ]
        ]);
        
        $this->calculateGrandTotal();
    }

    private function getContainerSize($containerType)
    {
        if (strpos($containerType, '20') !== false) {
            return '20';
        } elseif (strpos($containerType, '40') !== false || strpos($containerType, '45') !== false) {
            return '40';
        }
        return '20';
    }

    public function updatedPaymentTerm($value)
    {
        Log::info('Payment term updated', ['payment_term' => $value]);
        
        if ($this->container_id) {
            $this->dooring_fee = $value !== 'Port To Port' ? 300000 : 0;
            Log::info('Dooring fee updated based on payment term', ['dooring_fee' => $this->dooring_fee]);
            $this->calculateGrandTotal();
        }
    }

    private function convertToNumeric($value)
    {
        if (is_string($value)) {
            return (int) str_replace('.', '', $value);
        }
        return (int) $value;
    }

    // Update methods untuk handle string input
    public function updatedThcLolo($value) 
    { 
        $this->thc_lolo = $this->convertToNumeric($value);
        Log::info('THC LOLO updated', ['original' => $value, 'converted' => $this->thc_lolo]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedFreightSurcharge($value) 
    { 
        $this->freight_surcharge = $this->convertToNumeric($value);
        Log::info('Freight Surcharge updated', ['original' => $value, 'converted' => $this->freight_surcharge]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedBlDoFee($value) 
    { 
        $this->bl_do_fee = $this->convertToNumeric($value);
        Log::info('BL/DO Fee updated', ['original' => $value, 'converted' => $this->bl_do_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedApbsFee($value) 
    { 
        $this->apbs_fee = $this->convertToNumeric($value);
        Log::info('APBS Fee updated', ['original' => $value, 'converted' => $this->apbs_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedTruckingBuruhFee($value) 
    { 
        $this->trucking_buruh_fee = $this->convertToNumeric($value);
        Log::info('Trucking Buruh Fee updated', ['original' => $value, 'converted' => $this->trucking_buruh_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedDooringFee($value) 
    { 
        $this->dooring_fee = $this->convertToNumeric($value);
        Log::info('Dooring Fee updated', ['original' => $value, 'converted' => $this->dooring_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedSealFee($value) 
    { 
        $this->seal_fee = $this->convertToNumeric($value);
        Log::info('Seal Fee updated', ['original' => $value, 'converted' => $this->seal_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedOperationalFee($value) 
    { 
        $this->operational_fee = $this->convertToNumeric($value);
        Log::info('Operational Fee updated', ['original' => $value, 'converted' => $this->operational_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedRefundFee($value) 
    { 
        $this->refund_fee = $this->convertToNumeric($value);
        Log::info('Refund Fee updated', ['original' => $value, 'converted' => $this->refund_fee]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedPpn($value) 
    { 
        $this->ppn = $this->convertToNumeric($value);
        Log::info('PPN updated', ['original' => $value, 'converted' => $this->ppn]);
        $this->calculateGrandTotal(); 
    }
    
    public function updatedOthers($value) 
    { 
        $this->others = $this->convertToNumeric($value);
        Log::info('Others updated', ['original' => $value, 'converted' => $this->others]);
        $this->calculateGrandTotal(); 
    }

    public function calculateGrandTotal()
    {
        $oldTotal = $this->grand_total;
        
        $this->grand_total = $this->thc_lolo + $this->freight_surcharge + $this->bl_do_fee + 
                           $this->apbs_fee + $this->trucking_buruh_fee + $this->dooring_fee + 
                           $this->seal_fee + $this->operational_fee + $this->refund_fee + 
                           $this->ppn + $this->others;
                           
        Log::info('Grand total calculated', [
            'old_total' => $oldTotal,
            'new_total' => $this->grand_total,
            'fee_breakdown' => [
                'thc_lolo' => $this->thc_lolo,
                'freight_surcharge' => $this->freight_surcharge,
                'bl_do_fee' => $this->bl_do_fee,
                'apbs_fee' => $this->apbs_fee,
                'trucking_buruh_fee' => $this->trucking_buruh_fee,
                'dooring_fee' => $this->dooring_fee,
                'seal_fee' => $this->seal_fee,
                'operational_fee' => $this->operational_fee,
                'refund_fee' => $this->refund_fee,
                'ppn' => $this->ppn,
                'others' => $this->others,
            ]
        ]);
    }

    public function removeFile()
    {
        Log::info('File removed from upload');
        $this->uploadFile = null;
    }

    public function resetForm()
    {
        Log::info('Form reset initiated by user: Nvyviel');
        
        $this->reset([
            'user_id',
            'shipment_id', 
            'container_id',
            'shipping_instruction_id', // TAMBAH
            'payment_term',
            'status',
            'thc_lolo',
            'freight_surcharge',
            'bl_do_fee',
            'apbs_fee',
            'trucking_buruh_fee',
            'dooring_fee',
            'seal_fee',
            'operational_fee',
            'refund_fee',
            'ppn',
            'others',
            'grand_total',
            'uploadFile',
            'selectedData'
        ]);
        
        $this->payment_term = 'Port To Port';
        $this->status = 'Unpaid';
        $this->shipments = collect();
        $this->containers = collect();
        $this->calculateGrandTotal();
        
        Log::info('Form reset completed');
    }

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'shipment_id' => 'required|exists:shipments,id',
            'container_id' => 'required|exists:containers,id',
            'shipping_instruction_id' => 'required|exists:shipping_instructions,id', // TAMBAH
            'payment_term' => 'required|in:Port To Port,Door To Door,Door To Port,Port To Door',
            'status' => 'required|in:Unpaid,Under Verification,Paid,Error',
            'thc_lolo' => 'required|numeric|min:0',
            'freight_surcharge' => 'required|numeric|min:0',
            'bl_do_fee' => 'required|numeric|min:0',
            'apbs_fee' => 'required|numeric|min:0',
            'trucking_buruh_fee' => 'required|numeric|min:0',
            'dooring_fee' => 'required|numeric|min:0',
            'others' => 'required|numeric|min:0',
            'seal_fee' => 'nullable|numeric|min:0',
            'operational_fee' => 'nullable|numeric|min:0',
            'refund_fee' => 'nullable|numeric|min:0',
            'ppn' => 'nullable|numeric|min:0',
            'uploadFile' => 'required|file|mimes:pdf|max:10240',
        ];
    }

    public function createBill()
    {
        // Log form data before validation
        Log::info('Form data before validation', [
            'user_id' => $this->user_id,
            'shipment_id' => $this->shipment_id,
            'container_id' => $this->container_id,
            'shipping_instruction_id' => $this->shipping_instruction_id, // TAMBAH
            'payment_term' => $this->payment_term,
            'status' => $this->status,
            'grand_total' => $this->grand_total,
            'uploadFile' => $this->uploadFile ? $this->uploadFile->getClientOriginalName() : null,
            'fees' => [
                'thc_lolo' => $this->thc_lolo,
                'freight_surcharge' => $this->freight_surcharge,
                'bl_do_fee' => $this->bl_do_fee,
                'apbs_fee' => $this->apbs_fee,
                'trucking_buruh_fee' => $this->trucking_buruh_fee,
                'dooring_fee' => $this->dooring_fee,
                'seal_fee' => $this->seal_fee,
                'operational_fee' => $this->operational_fee,
                'refund_fee' => $this->refund_fee,
                'ppn' => $this->ppn,
                'others' => $this->others,
            ]
        ]);

        try {
            Log::info('Starting validation...');
            $this->validate();
            Log::info('Validation passed successfully');

            // Handle file upload
            $filePath = null;
            if ($this->uploadFile) {
                Log::info('Processing file upload', [
                    'filename' => $this->uploadFile->getClientOriginalName(),
                    'size' => $this->uploadFile->getSize(),
                    'mime_type' => $this->uploadFile->getMimeType()
                ]);
                
                $filePath = $this->uploadFile->store('bills', 'public');
                Log::info('File uploaded successfully', ['path' => $filePath]);
            }

            // Generate unique bill_id
            $billId = 'INV' . now()->format('Ymd') . sprintf('%04d', mt_rand(1, 9999));
            
            // Prepare data for bill creation
            $billData = [
                'bill_id' => $billId, // TAMBAH: Generate bill_id
                'user_id' => $this->user_id,
                'shipment_id' => $this->shipment_id,
                'container_id' => $this->container_id,
                'shipping_instruction_id' => $this->shipping_instruction_id, // TAMBAH
                'payment_term' => $this->payment_term,
                'status' => $this->status,
                'grand_total' => $this->grand_total,
                'upload_file' => $filePath, // UBAH: dari pdf_bill ke upload_file
                'thc_lolo' => $this->thc_lolo,
                'freight_surcharge' => $this->freight_surcharge,
                'bl_do_fee' => $this->bl_do_fee,
                'apbs_fee' => $this->apbs_fee,
                'trucking_buruh_fee' => $this->trucking_buruh_fee,
                'dooring_fee' => $this->dooring_fee,
                'seal_fee' => $this->seal_fee ?: 0, // Pastikan tidak null
                'operational_fee' => $this->operational_fee ?: 0,
                'refund_fee' => $this->refund_fee ?: 0,
                'ppn' => $this->ppn ?: 0,
                'others' => $this->others,
            ];

            Log::info('Attempting to create bill with data', ['bill_data' => $billData]);

            DB::beginTransaction();
            
            $bill = Bill::create($billData);
            
            Log::info('Bill created successfully', [
                'bill_id' => $bill->bill_id,
                'database_id' => $bill->id,
                'created_at' => $bill->created_at
            ]);

            DB::commit();

            session()->flash('success', 'Bill created successfully with ID: ' . $bill->bill_id);
            Log::info('Success message set, resetting form');
            
            $this->resetForm();
            
            Log::info('=== CREATE BILL PROCESS COMPLETED SUCCESSFULLY ===');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'messages' => $e->getMessage()
            ]);
            
            session()->flash('error', 'Validation failed: ' . implode(', ', array_flatten($e->errors())));
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('=== CREATE BILL PROCESS FAILED ===', [
                'error_message' => $e->getMessage(),
                'error_line' => $e->getLine(),
                'error_file' => $e->getFile(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'Failed to create bill: ' . $e->getMessage());
        }
    }

    public function render()
    {
        Log::info('Rendering CreateBill component', [
            'has_selected_data' => !is_null($this->selectedData),
            'grand_total' => $this->grand_total
        ]);
        
        return view('livewire.create-bill');
    }
}