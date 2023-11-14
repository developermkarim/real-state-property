<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;

class AgentController extends Controller
{
    public function AgentDashboard(){

        return view('agent.agent_dashboard');

    } // End Method

    public function AdminLogout(Request $req)
    {
        Storage::delete(['file', 'otherFile']);
    }
}
/*  */
