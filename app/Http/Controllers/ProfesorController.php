<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfesorController extends Controller
{
    public function index(): View
    {
        $profesores = Profesor::all();

        return view('profesor.index', compact('profesores'));
    }

    public function create(): View
    {
        return view('profesor.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:100'],
            'apellidos' => ['required', 'string', 'min:3', 'max:130'],
            'especialidad' => ['required', 'string', 'max:120'],
            'fecha_alta' => ['required', 'date', 'before_or_equal:today'],
            'salario' => ['required', 'numeric', 'min:0', 'max:99999999.99', 'decimal:0,2'],
        ]);

        Profesor::create($datos);

        return redirect()
            ->route('profesor.index')
            ->with('success', 'Profesor creado correctamente.');
    }

    public function show(Profesor $profesor): View
    {
        return view('profesor.show', compact('profesor'));
    }

    public function edit(Profesor $profesor): View
    {
        return view('profesor.edit', compact('profesor'));
    }

    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'min:2', 'max:100'],
            'apellidos' => ['required', 'string', 'min:3', 'max:130'],
            'especialidad' => ['required', 'string', 'max:120'],
            'fecha_alta' => ['required', 'date', 'before_or_equal:today'],
            'salario' => ['required', 'numeric', 'min:0', 'max:99999999.99', 'decimal:0,2'],
        ]);

        $profesor->update($datos);

        return redirect()
            ->route('profesor.index')
            ->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(Profesor $profesor): RedirectResponse
    {
        $profesor->delete();

        return redirect()
            ->route('profesor.index')
            ->with('success', 'Profesor eliminado correctamente.');
    }
}
