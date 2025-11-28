<?php
namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
public function index(Request $request)
{
$query = Employee::query();

// Search functionality
if ($request->has('search') && $request->search) {
    $search = $request->search;
    $query->where('name', 'like', "%$search%")
          ->orWhere('email', 'like', "%$search%")
          ->orWhere('phone', 'like', "%$search%")
          ->orWhere('position', 'like', "%$search%");
}

// Filter by position
if ($request->has('position') && $request->position) {
    $query->where('position', $request->position);
}

// Sort
$sortBy = $request->get('sort', 'name');
$sortOrder = $request->get('order', 'asc');
$query->orderBy($sortBy, $sortOrder);

$employees = $query->get();
$positions = Employee::select('position')->distinct()->pluck('position');

return view('employees.index', compact('employees', 'positions'));
}


public function create()
{
return view('employees.create');
}


public function store(Request $request)
{
$request->validate([
'name' => 'required',
'email' => 'required|email|unique:employees',
'phone' => 'required',
'position' => 'required'
]);


Employee::create($request->all());
return redirect('/employees')->with('success', 'Employee added');
}


public function edit($id)
{
$employee = Employee::findOrFail($id);
return view('employees.edit', compact('employee'));
}


public function update(Request $request, $id)
{
$request->validate([
'name' => 'required',
'email' => 'required|email',
'phone' => 'required',
'position' => 'required'
]);


Employee::findOrFail($id)->update($request->all());
return redirect('/employees')->with('success', 'Updated successfully');
}


public function destroy($id)
{
Employee::findOrFail($id)->delete();
return redirect('/employees')->with('success', 'Deleted successfully');
}
public function home()
{
    $employees = Employee::all();
    $stats = [
        'total_employees' => $employees->count(),
        'total_positions' => $employees->pluck('position')->unique()->count(),
    ];
    return view('employees.home', compact('employees', 'stats'));
}

public function exportCsv()
{
    $employees = Employee::all();
    
    $filename = 'employees_' . date('Y-m-d') . '.csv';
    $handle = fopen('php://memory', 'w');
    
    // Header
    fputcsv($handle, ['ID', 'Nama', 'Email', 'Telepon', 'Posisi', 'Dibuat Pada']);
    
    // Data
    foreach ($employees as $employee) {
        fputcsv($handle, [
            $employee->id,
            $employee->name,
            $employee->email,
            $employee->phone,
            $employee->position,
            $employee->created_at->format('Y-m-d H:i:s'),
        ]);
    }
    
    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);
    
    return response($csv)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', "attachment; filename=$filename");
}

public function exportJson()
{
    $employees = Employee::all();
    $filename = 'employees_' . date('Y-m-d') . '.json';
    
    return response()->json($employees)
        ->header('Content-Disposition', "attachment; filename=$filename");
}

}
?>