<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filterPosition = $request->get('position');

        $employees = Employee::query();

        if ($search) {
            $employees->where('name', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%')
                     ->orWhere('phone', 'like', '%' . $search . '%');
        }

        if ($filterPosition) {
            $employees->where('position', $filterPosition);
        }

        $employees = $employees->get();

        $positions = Position::all();
        $statistics = [
            'total_employees' => Employee::count(),
            'total_positions' => Position::count(),
            'employees_by_position' => Employee::selectRaw('position, count(*) as count')
                                                ->groupBy('position')
                                                ->get(),
        ];

        return view('dashboard.index', compact('employees', 'positions', 'statistics', 'search', 'filterPosition'));
    }
}
