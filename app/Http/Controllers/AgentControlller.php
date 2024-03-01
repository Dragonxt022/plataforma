<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentControlller extends Controller
{
    public function AgentDashboard(){

        return view('agent.agent_dashboard');
    
    } // Fim do metodo
}
