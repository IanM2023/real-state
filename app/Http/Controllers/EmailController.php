<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\ComposeEmailMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email_compose()
    {
        $data['getEmail'] = User::whereIn('role', ['agent', 'user'])->get();
        return view('admin.email.compose', $data);
    }

    public function email_compose_post(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'cc_email' => 'nullable|email',
                'subject' => 'required|string|max:255',
                'descriptions' => 'required|string',
            ]);
    
            $save = new ComposeEmail;
            $save->user_id = $validated['user_id'];
            $save->cc_email = trim($validated['cc_email']) ?? null;
            $save->subject = trim($validated['subject']);
            $save->descriptions = trim($validated['descriptions']);
            $save->save();

            $getUserEmail = User::where('id', '=' , $request->user_id)->first();
            Mail::to($getUserEmail->email)->cc($request->cc_email)->send(new ComposeEmailMail($save));
    
            DB::commit();
            return redirect()->back()->with('success', 'Email saved successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please check your input.');
        }
    }

    public function email_sent(Request $request)
    {
        $data['getRecord'] = ComposeEmail::get();
        return view('admin.email.sent', $data);
    }

    public function read_email($id, Request $request)
    {
        $data['getRecord'] = ComposeEmail::findOrFail($id);
        return view('admin.email.read', $data);
    }
    

    public function delete_email_sent(Request $request)
    {
        try {
            DB::beginTransaction();
            if(!empty($request->id))
            {
                $option = array_filter(explode(',', $request->id)); // Removes empty strings

                foreach($option as $id)
                {
                    if(!empty($id))
                    {
                        $getRecord = ComposeEmail::findOrFail($id);
                        $getRecord->delete();

                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Email saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. cannot delete an email.');
        }
    }
}
