<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DynamizerController extends Controller
{
    public function index(User $users): View
    {
        return view('admin.dynamizers.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return redirect()->route('dynamizers.index');
    }

    public function edit(User $dynamizer): View
    {
        return view('', compact('dynamizer'));
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $dynamizer = User::findOrFail($id);

        $dynamizer->update($request->all());
        // $dynamizer->update($request->validated());

        return redirect()->route('dynamizers.index');
    }

    public function destroy($id): RedirectResponse
    {
        $dynamizer = User::findOrFail($id);
        $dynamizer->delete();

        return redirect()->route('dynamizers.index');
    }
}
