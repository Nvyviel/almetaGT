<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Rules\ChronologicalDates;

class ShipmentController extends Controller
{
    public function create()
    {
        return view('admin.creators.create-shipment');
    }

    public function addschedule(Request $request)
    {
        return view("admin.landings.dashboard-admin");
    }


    // app/Http/Controllers/ShipmentController.php

    public function edit(Shipment $shipment)
    {
        $cities = [
            'surabaya' => 'Surabaya',
            'pontianak' => 'Pontianak',
            'semarang' => 'Semarang',
            'banjarmasin' => 'Banjarmasin',
            'sampit' => 'Sampit',
            'jakarta' => 'Jakarta',
            'kumai' => 'Kumai',
            'samarinda' => 'Samarinda',
            'balikpapan' => 'Balikpapan',
            'berau' => 'Berau',
            'palu' => 'Palu',
            'bitung' => 'Bitung',
            'gorontalo' => 'Gorontalo',
            'ambon' => 'Ambon',
            'makassar' => 'Makassar',
            'morowali' => 'Morowali',
            'kendari' => 'Kendari',
            'pomala' => 'Pomala',
            'ternate' => 'Ternate',
            'jayapura' => 'Jayapura',
            'kupang' => 'Kupang',
            'sorong' => 'Sorong',
            'manokwari' => 'Manokwari',
            'merauke' => 'Merauke',
            'bau-bau' => 'Bau-Bau',
            'maumere' => 'Maumere',
            'tual' => 'Tual',
            'fak-fak' => 'Fak-Fak',
            'bintuni' => 'Bintuni',
            'nabire' => 'Nabire',
            'serui' => 'Serui'
        ];

        return view('admin.edits.edit-shipment', compact('shipment', 'cities'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        try {
            $dates = [
                'open_stack' => $request->open_stack,
                'closing_cargo' => $request->closing_cargo,
                'etd' => $request->etd,
                'eta' => $request->eta
            ];
            
            $request->validate([
                'from_city' => 'required|in:surabaya,pontianak,semarang,banjarmasin,sampit,jakarta,kumai,samarinda,balikpapan,berau,palu,bitung,gorontalo,ambon,makassar,morowali,kendari,pomala,ternate,jayapura,kupang,sorong,manokwari,merauke,bau-bau,maumere,tual,fak-fak,bintuni,nabire,serui',
                'to_city' => 'required|in:surabaya,pontianak,semarang,banjarmasin,sampit,jakarta,kumai,samarinda,balikpapan,berau,palu,bitung,gorontalo,ambon,makassar,morowali,kendari,pomala,ternate,jayapura,kupang,sorong,manokwari,merauke,bau-bau,maumere,tual,fak-fak,bintuni,nabire,serui',
                'vessel_name' => 'required|string',
                'open_stack' => ['required', 'date', new ChronologicalDates($dates)],
                'closing_cargo' => ['required', 'date', new ChronologicalDates($dates)],
                'etd' => ['required', 'date', new ChronologicalDates($dates)],
                'eta' => ['required', 'date', new ChronologicalDates($dates)],
                'freight_20' => 'required|numeric|min:0',
                'freight_40' => 'required|numeric|min:0'
            ]);
            
            // Get validated data and ensure we only use the correct field names
            $updateData = [
                'from_city' => $request->input('from_city'),
                'to_city' => $request->input('to_city'),
                'vessel_name' => strtoupper($request->input('vessel_name')),
                'closing_cargo' => $request->input('closing_cargo'),
                'open_stack' => $request->input('open_stack'),
                'etd' => $request->input('etd'),
                'eta' => $request->input('eta'),
                'freight_20' => (int) str_replace('.', '', $request->input('freight_20')), // Remove thousand separators
                'freight_40' => (int) str_replace('.', '', $request->input('freight_40')), // Remove thousand separators
            ];
            
            // Update using specific data array instead of request to avoid extra fields
            $shipment->update($updateData);

            return redirect()->route('create-shipment')
                ->with('success', 'Data shipment berhasil diperbarui');
                
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error updating shipment: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan database. Silakan coba lagi.')
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating shipment: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function filtering(Request $request)
    {
        $pod = $request->input('pod');
        $pol = $request->input('pol');

        if (empty($pod) || empty($pol)) {
            return view('user.dashboard', ['shipments' => collect()]);
        }

        $shipments = Shipment::where('to_city', $pod)
            ->where('from_city', $pol)
            ->get();

        return view('user.dashboard', compact('shipments'));
    }

    public function guestFiltering(Request $request)
    {
        $pod = $request->input('pod');
        $pol = $request->input('pol');

        // Get cities for dropdown
        $fromCities = $this->getFromCities();

        // Get saved search data from session
        $savedSearchData = [
            'pol' => session('last_search_pol'),
            'pod' => session('last_search_pod'),
            'timestamp' => session('last_search_timestamp')
        ];

        if (empty($pod) || empty($pol)) {
            return view('user.landings.index', [
                'shipments' => collect(),
                'fromCities' => $fromCities,
                'savedSearchData' => $savedSearchData
            ]);
        }

        // Check if POD and POL are the same
        if ($pod === $pol) {
            return view('user.landings.index', [
                'shipments' => collect(),
                'error' => 'Port of Loading (POL) and Port of Discharge (POD) cannot be the same location. Please select different ports.',
                'old_pod' => $pod,
                'old_pol' => $pol,
                'fromCities' => $fromCities,
                'savedSearchData' => $savedSearchData
            ]);
        }

        // Only get shipments that are not soft deleted
        $shipments = Shipment::where('to_city', $pod)
            ->where('from_city', $pol)
            ->whereNull('deleted_at')  // Exclude soft deleted shipments
            ->get();

        return view('user.landings.index', compact('shipments', 'fromCities', 'savedSearchData'));
    }

    public function dashboardFiltering(Request $request)
    {
        $pod = $request->input('pod');
        $pol = $request->input('pol');

        // Get cities for dropdown
        $fromCities = $this->getFromCities();

        // Get saved search data from session
        $savedSearchData = [
            'pol' => session('last_search_pol'),
            'pod' => session('last_search_pod'),
            'timestamp' => session('last_search_timestamp')
        ];

        if (empty($pod) || empty($pol)) {
            return view('user.landings.dashboard', [
                'shipments' => collect(),
                'fromCities' => $fromCities,
                'savedSearchData' => $savedSearchData
            ]);
        }

        // Check if POD and POL are the same
        if ($pod === $pol) {
            return view('user.landings.dashboard', [
                'shipments' => collect(),
                'error' => 'Port of Loading (POL) and Port of Discharge (POD) cannot be the same location. Please select different ports.',
                'old_pod' => $pod,
                'old_pol' => $pol,
                'fromCities' => $fromCities,
                'savedSearchData' => $savedSearchData
            ]);
        }

        // Only get shipments that are not soft deleted
        $shipments = Shipment::where('to_city', $pod)
            ->where('from_city', $pol)
            ->whereNull('deleted_at')  // Exclude soft deleted shipments
            ->get();

        return view('user.landings.dashboard', compact('shipments', 'fromCities', 'savedSearchData'));
    }

    private function getFromCities()
    {
        return Shipment::select('from_city')
            ->distinct()
            ->orderBy('from_city')
            ->pluck('from_city')
            ->filter()
            ->values();
    }

    public function approvalRo(Request $request)
    {
        // Ambil filter dari request
        $selectedVessel = $request->query('selectedVessel');
        $search = $request->query('search');
        $orderId = $request->query('order_id');

        // Query awal
        $name_ship = Container::with([
            'shipment_container',
            'user:id,company_name',
        ]);

        // Filter berdasarkan kapal yang dipilih
        if ($selectedVessel) {
            $name_ship->whereHas('shipment_container', function ($query) use ($selectedVessel) {
                $query->where('vessel_name', $selectedVessel);
            });
        }

        // Filter berdasarkan pencarian (commodity atau company_name)
        if ($search) {
            $name_ship->where(function ($query) use ($search) {
                $query->where('commodity', 'LIKE', "%$search%")
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('company_name', 'LIKE', "%$search%");
                    });
            });
        }

        if ($orderId) {
            $name_ship->where('id_order', 'LIKE', "%$orderId%");
        }

        // Eksekusi query
        $name_ship = $name_ship->get();

        $availableVessel = Shipment::pluck('vessel_name');

        return view('admin.approvals.approval-ro', compact('name_ship', 'availableVessel'));
    }

    public function uploadRoPdf(Request $request, $id)
    {
        $request->validate([
            'pdf_ro' => 'required|mimes:pdf|max:2048' // Validates that the file is a PDF and not larger than 2MB
        ]);

        $container = Container::findOrFail($id);

        if ($request->hasFile('pdf_ro')) {
            // Generate unique filename
            $filename = 'ro_' . $container->id_order . '_' . time() . '.pdf';

            // Store the file
            $path = $request->file('pdf_ro')->storeAs('release-orders', $filename, 'public');

            // Update container record
            $container->update([
                'pdf_ro' => $path
            ]);

            return redirect()->back()->with('success', 'Release Order PDF has been uploaded successfully');
        }

        return redirect()->back()->with('error', 'No file was uploaded');
    }

    public function approve($id)
    {
        $container = Container::findOrFail($id);

        request()->validate([
            'pdf_ro' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        if (request()->hasFile('pdf_ro')) {
            // Generate unique filename
            $filename = 'ro_' . $container->id_order . '_' . time() . '.pdf';

            // Store the file
            $path = request()->file('pdf_ro')->storeAs('release-orders', $filename, 'public');

            // Update container with file path and status
            $container->update([
                'pdf_ro' => $path,
                'status' => 'Approved'
            ]);

            return redirect()->back()->with('success', 'Release Order has been approved and document uploaded successfully');
        }

        return redirect()->back()->with('error', 'Please upload the Release Order PDF before approving');
    }

    public function cancel($id)
    {
        $container = Container::findOrFail($id);

        $container->update([
            'status' => 'Canceled'
        ]);

        return redirect()->back()->with('success', 'Container has been canceled successfully');
    }

    public function saveSearchData(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'pol' => 'nullable|string|max:255',
                'pod' => 'nullable|string|max:255',
                'timestamp' => 'nullable|integer'
            ]);

            // Save to session for persistence across requests
            session([
                'last_search_pol' => $request->pol,
                'last_search_pod' => $request->pod,
                'last_search_timestamp' => $request->timestamp ?? now()->timestamp
            ]);

            // If user is logged in, we can also save to user preferences/database
            if (Auth::check()) {
                // You can extend this to save to a user_preferences table if needed
                Log::info('Search data saved for user: ' . Auth::id(), [
                    'pol' => $request->pol,
                    'pod' => $request->pod
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Search data saved successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving search data: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error saving search data'
            ], 500);
        }
    }
}
