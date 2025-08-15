<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Week;
use App\Models\WeekTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function admin_schedule_list(Request $request)
    {
        $data['week'] = Week::get();
        $data['week_time'] = WeekTime::get();

        $data['getRecord'] = Schedule::get();
        return view('admin.schedule.list', $data);
    }

    public function admin_schedule_update(Request $request)
    {
        $userId = Auth::id();
    
        // 1. Get all existing schedule week_ids for the user
        $existingSchedules = Schedule::where('user_id', $userId)->pluck('week_id')->toArray();
    
        // 2. Keep track of week_ids from form submission
        $submittedWeekIds = [];
    
        if (!empty($request->week)) {
            foreach ($request->week as $value) {
                $weekId = trim($value['week_id']);
                $submittedWeekIds[] = $weekId;
    
                if (!empty($value['status'])) {
                    // Validate times
                    if (empty($value['start_time']) || empty($value['end_time'])) {
                        return redirect()->back()
                            ->with('error', 'Start time and end time are required when the status is checked.');
                    }
    
                    // Create or update record
                    Schedule::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'week_id' => $weekId,
                        ],
                        [
                            'status'     => '1',
                            'start_time' => trim($value['start_time']),
                            'end_time'   => trim($value['end_time']),
                        ]
                    );
                } else {
                    // If unchecked, delete the record if it exists
                    Schedule::where('user_id', $userId)
                            ->where('week_id', $weekId)
                            ->delete();
                }
            }
        }
    
        return redirect('admin/schedule')->with('success', 'Schedule updated successfully');
    }
    
    
    
}
