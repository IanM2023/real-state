<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\WeekTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserTimeController extends Controller
{
    
    public function week_list(Request $request)
    {
        $data['getRecord'] = Week::get();
        return view('admin.week.list', $data);
    }

    public function week_add(Request $request)
    {
        return view('admin.week.add');
    }

    public function week_store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'week_name' => [
                    'required',
                    'string',
                    'regex:/^[a-zA-Z]+$/',
                    'unique:weeks,week_name',
                ],
            ]);
        
            $saveWeek = new Week;
            $saveWeek->week_name = strtolower(trim($request->week_name));
            $saveWeek->save();

            DB::commit();
        
            return redirect('admin/week')->with('success', 'New Week added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. check the input.');
        }
    }

    public function week_edit($id)
    {
        $data['getRecord'] = Week::findOrFail($id);
        return view('admin.week.edit', $data);
    }

    public function week_update_id(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'week_name' => [
                    'required',
                    'string',
                    'regex:/^[a-zA-Z]+$/',
                    'unique:weeks,week_name',
                ],
            ]);
        
            $saveWeek = Week::findOrFail($id);
            $saveWeek->week_name = strtolower(trim($request->week_name));
            $saveWeek->save();

            DB::commit();
            return redirect('admin/week')->with('success', 'Week updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. check the input.');
        }
    }

    public function week_delete_id($id)
    {
        try {
            DB::beginTransaction();
            $saveWeek = Week::findOrFail($id);
            $saveWeek->delete();

            DB::commit();
            return redirect('admin/week')->with('success', 'Week deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Can\'t delete the week');
        }
    }

    public function week_time_list(Request $request)
    {
        $data['getRecord'] = WeekTime::get();
        return view('admin.week_time.list', $data);
    }

    public function week_add_time(Request $request)
    {

        return view('admin.week_time.add');
    }

    public function week_add_time_store(Request $request)
    {
        try {
            DB::beginTransaction();

            $save = new WeekTime;
            $save->week_time = $request->week_name_time;
            $save->time_format = $request->timeFormat;
            $save->save();

            DB::commit();
            return redirect('admin/week_time')->with('success', 'New Week time Successfully Added');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Check your week time');
        }
    }

    public function week_time_edit($id)
    {
        $data['getRecord'] = WeekTime::findOrFail($id);
        return view('admin.week_time.edit', $data);
    }
    

    public function week_time_update_id(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $saveWeektime = WeekTime::findOrFail($id);
            $saveWeektime->week_time = trim($request->week_name_time);
            $saveWeektime->time_format = trim($request->timeFormat);
            $saveWeektime->save();

            DB::commit();
            return redirect('admin/week_time')->with('success', 'Week Time updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Check your week time');
        }
    }

    public function week_time_delete_id($id)
    {
        try {
            DB::beginTransaction();
            $deleteWeekTime = WeekTime::findOrFail($id);
            $deleteWeekTime->delete();

            DB::commit();
            return redirect('admin/week_time')->with('success', 'Week Time deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Can\'t delete the week time');
        }
    }
}
