<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;

class ContainerController extends Controller
{
    public function booking(Request $request)
    {
        $shipmentId = $request->input('shipment_id');
        return view('user.shipments.booking', compact('shipmentId'));
    }

    public function createNew(Request $request)
    {
        return view('user.shipments.booking');
    }


    public function showDetail($id_order)
    {
        $user = Auth::user();

        if ($user->is_admin) {
            $container = Container::where('id_order', $id_order)->firstOrFail();
        } else {
            $container = Container::where('user_id', $user->id)
                                 ->where('id_order', $id_order)
                                 ->firstOrFail();
        }

        return view('user.shipments.show-release-order', compact('container'));
    }


    public function releaseOrder(Request $request)
    {
        $user = Auth::user();
        
        // Get all containers for statistics (no filter applied)
        $allContainers = Container::where('user_id', $user->id)->get();
        
        // Calculate statistics from all data
        $totalOrders = $allContainers->count();
        $approvedCount = $allContainers->where('status', 'Approved')->count();
        $pendingCount = $allContainers->where('status', 'Requested')->count();
        $canceledCount = $allContainers->where('status', 'Canceled')->count();
        
        // Build query for filtered results
        $query = Container::where('user_id', $user->id)
                         ->with('shipment_container')
                         ->orderBy('created_at', 'desc');
        
        // Apply filter for display if specified
        if ($request->has('filter') && $request->filter !== 'all') {
            $query->where('status', $request->filter);
        }

        $container = $query->get();
        
        return view('user.shipments.release-order', compact(
            'container', 
            'totalOrders', 
            'approvedCount', 
            'pendingCount', 
            'canceledCount'
        ));
    }



    public function historyRo()
    {
        $containers = Container::all();

        return view('admin.histories.history-ro', compact('containers'));
    }
}
