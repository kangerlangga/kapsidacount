<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $detections = Detection::latest()->get();
        $uniqueDates = $detections->pluck('created_at')
            ->map(function ($date) {
                return $date->format('Y-m-d');
            })
            ->unique()
            ->sortByDesc(function ($date) {
                return $date;
            })
            ->take(12);
        $data = [
            'judul' => 'Detection History',
            'cP' => Detection::count(),
            'cT' => $uniqueDates->count(),
            'DataD' => Detection::latest()->get(),
        ];
        return view('pages.admin.detect', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'judul' => 'New Detection',
        ];
        return view('pages.admin.detect_add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate form
        $request->validate([
            'Blitzer'       => 'required|integer|min:1',
            'Capsule'       => 'required|integer|min:0',
            'Deficiency'    => 'required|integer|min:0',
            'Status'        => 'required|max:255',
        ]);

        //create
        Detection::create([
            'id_detections'     => 'Deteksi'.now()->format('YmdHisv'),
            'blitzer'           => $request->Blitzer,
            'kapsul'            => $request->Capsule,
            'kekurangan'        => $request->Deficiency,
            'keterangan'        => $request->Status,
            'created_by'        => Auth::user()->email,
            'modified_by'       => Auth::user()->email,
        ]);

        //redirect to index
        return redirect()->route('detect.add')->with(['success' => 'Detection has been Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Detection $detection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $data = [
            'judul' => 'Edit Detection',
            'EditDetection' => Detection::findOrFail($id),
        ];
        return view('pages.admin.detect_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'Blitzer'       => 'required|integer|min:1',
            'Capsule'       => 'required|integer|min:0',
            'Deficiency'    => 'required|integer|min:0',
            'Status'        => 'required|max:255',
        ]);

        $detection = Detection::findOrFail($id);

        $detection->update([
            'blitzer'           => $request->Blitzer,
            'kapsul'            => $request->Capsule,
            'kekurangan'        => $request->Deficiency,
            'keterangan'        => $request->Status,
            'modified_by'       => Auth::user()->email,
        ]);

        return redirect()->route('detect.data')->with(['success' => 'Detect has been Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get by ID
        $detect = Detection::findOrFail($id);

        //delete
        $detect->delete();

        //redirect to index
        return redirect()->route('detect.data')->with(['success' => 'Detection has been Deleted!']);
    }

    public function getDetections()
    {
        $detectionData = Detection::latest()->take(12)->get();
        $deficiencies = $detectionData->pluck('kekurangan');
        $createdAt = $detectionData->pluck('created_at')->map(function($date) {
            return $date->format('d M Y H:i:s');
        });
        return response()->json([
            'deficiencies' => $deficiencies,
            'createdAt' => $createdAt
        ]);
    }

    public function getSummaryData()
    {
        $detectionData = Detection::select(DB::raw("DATE_FORMAT(created_at, '%d %b') as date"),
                DB::raw("SUM(CASE WHEN keterangan = 'Sempurna' THEN 1 ELSE 0 END) as perfect"),
                DB::raw("SUM(CASE WHEN keterangan = 'Cacat' THEN 1 ELSE 0 END) as defective"))
            ->groupBy('date')
            ->orderBy(DB::raw("MIN(created_at)"), 'desc')
            ->take(12)
            ->get()
            ->reverse();
        $dates = $detectionData->pluck('date');
        $perfectData = $detectionData->pluck('perfect');
        $defectiveData = $detectionData->pluck('defective');
        return response()->json([
            'dates' => $dates,
            'perfect' => $perfectData,
            'defective' => $defectiveData
        ]);
    }
}
