<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function AgentDashboard(Request $request)
    {
        return view('agent.index');
    }

    public function AgentLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function agentEmailInbox(Request $request)
    {

        $data['getRecord'] = ComposeEmail::getAgentRecord(Auth::user()->id);

        return view('agent.email.inbox', $data);
    }
}
