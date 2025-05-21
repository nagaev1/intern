<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Services\RecordService;
use App\Http\Requests\StoreRecordRequest;

class RecordController extends Controller
{
    public function __construct(protected RecordService $recordService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = $this->recordService->all();
        return $records->toResourceCollection();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request)
    {
        try {
            $record = $this->recordService->store($request->fullName, $request->comment);
            return response()->json([
                "message" => "success",
                "record" => $record->toResource()
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();
        return response()->json([
            "message" => "success"
        ], 200);
    }
}
