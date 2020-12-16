<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;

class DynamizerController extends Controller
{
    public function index(User $users): View
    {
        $headings = $this->setDataTableHeading();
        $data = $this->setDataTableRows($users);

        return view('admin.dynamizers.index', compact('headings', 'data'));
    }

    public function create(): View
    {
        return view('admin.dynamizers.edit');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $fieldsValidated = $request->validated();
        $fieldsValidated['password'] = bcrypt('secret');

        User::create($fieldsValidated);

        return redirect()->route('dynamizers.index')->with('message', 'Nuevo dinamizador creado.');
    }

    public function edit(User $dynamizer): View
    {
        return view('admin.dynamizers.edit', compact('dynamizer'));
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $dynamizer = User::findOrFail($id);

        $dynamizer->update($request->validated());

        return redirect()->route('dynamizers.index')->with('message', 'Dinamizador editado.');
    }

    public function destroy($id): RedirectResponse
    {
        $dynamizer = User::findOrFail($id);
        $dynamizer->delete();

        return redirect()->route('dynamizers.index');
    }

    private function setDataTableHeading(): array
    {
        return [
            'ID', 'Nombre', '¿ Activo ?', 'Último acceso', 'Acciones'
        ];
    }

    private function setDataTableRows($users): Collection
    {
        return $users
            ->select('id', 'name', 'is_enabled', 'last_login_at')
            ->get()
            ->map(function ($item) {
                $item->is_enabled = $item->is_enabled ? 'SI' : 'NO';
                $item->last_login_at = Carbon::parse($item->last_login_at)->format("d/m/Y H:i");
                $item->actions = '
                <div class="flex">
                    <button type="button" class="btn ml-2" onclick="editItem('.$item->id.');" title="Editar">
                        <i class="fa fa-pen"></i>
                    </button>
                    <button type="button" class="btn btn-danger ml-2" onclick="deleteItem('.$item->id.', \''.$item->name.'\');" title="Eliminar">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                ';

                return $item;
            });
    }
}
