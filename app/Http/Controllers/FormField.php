<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormField extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        // on success, go to home page
        return redirect('/');
    }
}
