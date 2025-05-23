<?php

namespace App\Http\Controllers;

use App\Models\ClinicAnnouncement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClinicAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = ClinicAnnouncement::latest()->get();
        return response()->json($announcements);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'closure_start_date' => 'nullable|date',
            'closure_end_date' => 'nullable|date|after_or_equal:closure_start_date',
            'is_active' => 'boolean'
        ]);
        
        // Check if an announcement with the same title and message already exists
        $existing = ClinicAnnouncement::where('title', $validated['title'])
            ->where('message', $validated['message'])
            ->first();
        
        if ($existing) {
            // Update the existing announcement instead of creating a new one
            if ($request->is_active) {
                ClinicAnnouncement::where('id', '!=', $existing->id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }
            
            $existing->update([
                'is_active' => $request->is_active,
                'closure_start_date' => $request->closure_start_date,
                'closure_end_date' => $request->closure_end_date
            ]);
            
            return response()->json($existing);
        }
        
        // Deactivate all other announcements if this one is active
        if ($request->is_active) {
            ClinicAnnouncement::where('is_active', true)->update(['is_active' => false]);
        }
        
        $announcement = ClinicAnnouncement::create($validated);
        
        return response()->json($announcement, 201);
    }
    
    public function show(ClinicAnnouncement $announcement)
    {
        return response()->json($announcement);
    }
    
    public function update(Request $request, ClinicAnnouncement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'closure_start_date' => 'nullable|date',
            'closure_end_date' => 'nullable|date|after_or_equal:closure_start_date',
            'is_active' => 'boolean'
        ]);
        
        // Deactivate all other announcements if this one is active
        if ($request->is_active) {
            ClinicAnnouncement::where('id', '!=', $announcement->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }
        
        $announcement->update($validated);
        
        return response()->json($announcement);
    }
    
    public function destroy(ClinicAnnouncement $announcement)
    {
        $announcement->delete();
        
        return response()->json(null, 204);
    }
    
    public function getActive()
    {
        return ClinicAnnouncement::where('is_active', true)->latest()->first();
    }
    

    public function getActiveWithClosureDates()
    {
        $today = Carbon::today();
        
        return ClinicAnnouncement::where('is_active', true)
            ->whereNotNull('closure_start_date')
            ->whereNotNull('closure_end_date')
            ->latest()
            ->get();
    }
    

    public function getUpcomingClosures()
    {
        $today = Carbon::today();
        
        return ClinicAnnouncement::where('is_active', true)
            ->whereNotNull('closure_start_date')
            ->whereNotNull('closure_end_date')
            ->where('closure_end_date', '>=', $today)
            ->orderBy('closure_start_date')
            ->get();
    }
    
    public function isClinicClosedOnDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);
        
        $date = Carbon::parse($request->date);
        
        $closures = ClinicAnnouncement::where('is_active', true)
            ->whereNotNull('closure_start_date')
            ->whereNotNull('closure_end_date')
            ->where('closure_start_date', '<=', $date)
            ->where('closure_end_date', '>=', $date)
            ->get();
        
        return response()->json([
            'date' => $date->toDateString(),
            'is_closed' => $closures->isNotEmpty(),
            'closures' => $closures
        ]);
    }
}