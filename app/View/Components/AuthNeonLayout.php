<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AuthNeonLayout extends Component
{
    public function render(): View
    {
        return view('layouts.auth-neon');
    }
}
