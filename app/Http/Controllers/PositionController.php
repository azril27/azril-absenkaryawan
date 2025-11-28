<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:positions',
            'description' => 'nullable|string',
        ]);

        Position::create($request->all());
        return redirect('/positions')->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:positions,name,' . $id,
            'description' => 'nullable|string',
        ]);

        Position::findOrFail($id)->update($request->all());
        return redirect('/positions')->with('success', 'Jabatan berhasil diubah');
    }

    public function destroy($id)
    {
        Position::findOrFail($id)->delete();
        return redirect('/positions')->with('success', 'Jabatan berhasil dihapus');
    }
}
