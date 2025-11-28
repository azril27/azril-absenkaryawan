# 🎯 UML & Architecture Diagram

## Application Architecture

Sistem Absensi Karyawan mengikuti **MVC (Model-View-Controller)** architecture pattern dengan struktur berlapis yang jelas.

## Architecture Layers

```
┌─────────────────────────────────────────────────────────────┐
│                      USER INTERFACE                          │
│  (HTML/Blade Templates, Bootstrap 5, Bootstrap Icons)       │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                      ROUTE LAYER                             │
│  (routes/web.php - URL Routing & Request Dispatch)          │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                   CONTROLLER LAYER                           │
│  (Handles HTTP Requests & Business Logic)                   │
│                                                              │
│  - EmployeeController     - PositionController              │
│  - UserController         - AttendanceController            │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                    MODEL LAYER                               │
│  (Eloquent ORM - Database Abstraction)                      │
│                                                              │
│  - User        - Employee        - Position                 │
│  - Attendance                                                │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                  DATABASE LAYER                              │
│  (MySQL - Data Persistence)                                 │
│                                                              │
│  Tables: users, employees, positions, attendances           │
└─────────────────────────────────────────────────────────────┘
```

## Class Diagram

```
┌─────────────────────────────┐
│        Model: User          │
├─────────────────────────────┤
│ Properties:                 │
│ - id: int                   │
│ - name: string              │
│ - email: string             │
│ - password: string          │
│ - created_at: timestamp     │
│ - updated_at: timestamp     │
├─────────────────────────────┤
│ Methods:                    │
│ + toArray(): array          │
│ + getRouteKeyName(): string │
└─────────────────────────────┘
           △                        
           │ extends               
           │                        
┌─────────────────────────────┐
│   Eloquent Model Base       │
│   (Illuminate\Database)     │
└─────────────────────────────┘


┌────────────────────────────────────────────────────────────────┐
│            Model: Position                                      │
├────────────────────────────────────────────────────────────────┤
│ Properties:                                                    │
│ - id: int (Primary Key)                                        │
│ - name: string (UNIQUE)                                        │
│ - description: text                                            │
│ - created_at: timestamp                                        │
│ - updated_at: timestamp                                        │
├────────────────────────────────────────────────────────────────┤
│ Methods:                                                       │
│ + employees(): HasMany                                         │
│ + create(array): Position                                      │
│ + update(array): bool                                          │
│ + delete(): bool                                               │
├────────────────────────────────────────────────────────────────┤
│ Relationships:                                                 │
│ • One-to-Many: 1 Position → Many Employees                     │
└────────────────────────────────────────────────────────────────┘
        ↑
        │ 1:N
        │
        │ hasMany
        │
        ↓
┌────────────────────────────────────────────────────────────────┐
│            Model: Employee                                      │
├────────────────────────────────────────────────────────────────┤
│ Properties:                                                    │
│ - id: int (Primary Key)                                        │
│ - name: string                                                 │
│ - email: string (UNIQUE)                                       │
│ - phone: string                                                │
│ - position: string (legacy)                                    │
│ - position_id: int (Foreign Key)                               │
│ - created_at: timestamp                                        │
│ - updated_at: timestamp                                        │
├────────────────────────────────────────────────────────────────┤
│ Methods:                                                       │
│ + positionRelation(): BelongsTo                                │
│ + attendances(): HasMany                                       │
│ + create(array): Employee                                      │
│ + update(array): bool                                          │
│ + delete(): bool                                               │
│ + getInitials(): string                                        │
├────────────────────────────────────────────────────────────────┤
│ Relationships:                                                 │
│ • Many-to-One: Many Employees → 1 Position                     │
│ • One-to-Many: 1 Employee → Many Attendances                   │
└────────────────────────────────────────────────────────────────┘
        ↑
        │ 1:N
        │
        │ hasMany
        │
        ↓
┌────────────────────────────────────────────────────────────────┐
│           Model: Attendance                                     │
├────────────────────────────────────────────────────────────────┤
│ Properties:                                                    │
│ - id: int (Primary Key)                                        │
│ - employee_id: int (Foreign Key)                               │
│ - attendance_date: date                                        │
│ - check_in_time: time (nullable)                               │
│ - check_out_time: time (nullable)                              │
│ - status: enum (hadir|sakit|izin|alfa)                         │
│ - notes: text (nullable)                                       │
│ - created_at: timestamp                                        │
│ - updated_at: timestamp                                        │
├────────────────────────────────────────────────────────────────┤
│ Methods:                                                       │
│ + employee(): BelongsTo                                        │
│ + isCheckedIn(): bool                                          │
│ + isCheckedOut(): bool                                         │
│ + getStatus(): string                                          │
│ + create(array): Attendance                                    │
│ + update(array): bool                                          │
│ + delete(): bool                                               │
├────────────────────────────────────────────────────────────────┤
│ Relationships:                                                 │
│ • Many-to-One: Many Attendances → 1 Employee                   │
│ • Casts: attendance_date as date                               │
│          check_in_time as time                                 │
│          check_out_time as time                                │
└────────────────────────────────────────────────────────────────┘
```

## Controller Classes

```
┌────────────────────────────────────────────────────────────────┐
│         EmployeeController (app/Http/Controllers)              │
├────────────────────────────────────────────────────────────────┤
│ Constructor:                                                   │
│ + __construct()                                                │
├────────────────────────────────────────────────────────────────┤
│ Public Methods (RESTful):                                      │
│ + home(): View                         [GET /]                │
│ + index(): View                        [GET /employees]       │
│ + create(): View                       [GET /employees/create]│
│ + store(Request): RedirectResponse     [POST /employees]      │
│ + edit(int id): View                   [GET /employees/id/ed] │
│ + update(Request, int): RedirectResp   [PUT /employees/id]    │
│ + destroy(int): RedirectResponse       [DEL /employees/id]    │
│ + exportCsv(): StreamedResponse        [GET /export/csv]      │
│ + exportJson(): JsonResponse           [GET /export/json]     │
├────────────────────────────────────────────────────────────────┤
│ Private Methods:                                               │
│ - validateEmployee(array): array       [Validation logic]     │
│ - formatEmployeeData(array): array     [Data formatting]      │
└────────────────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────────────────┐
│         PositionController (app/Http/Controllers)              │
├────────────────────────────────────────────────────────────────┤
│ Public Methods (RESTful):                                      │
│ + index(): View                        [GET /positions]       │
│ + create(): View                       [GET /positions/create]│
│ + store(Request): RedirectResponse     [POST /positions]      │
│ + edit(int id): View                   [GET /positions/id/ed] │
│ + update(Request, int): RedirectResp   [PUT /positions/id]    │
│ + destroy(int): RedirectResponse       [DEL /positions/id]    │
└────────────────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────────────────┐
│           UserController (app/Http/Controllers)                │
├────────────────────────────────────────────────────────────────┤
│ Public Methods (RESTful):                                      │
│ + index(): View                        [GET /users]           │
│ + create(): View                       [GET /users/create]    │
│ + store(Request): RedirectResponse     [POST /users]          │
│ + edit(int id): View                   [GET /users/id/edit]   │
│ + update(Request, int): RedirectResp   [PUT /users/id]        │
│ + destroy(int): RedirectResponse       [DEL /users/id]        │
└────────────────────────────────────────────────────────────────┘

┌────────────────────────────────────────────────────────────────┐
│        AttendanceController (app/Http/Controllers)             │
├────────────────────────────────────────────────────────────────┤
│ User Methods:                                                  │
│ + checkIn(): View                      [GET /attendance/...] │
│ + doCheckIn(Request): RedirectResponse [POST /attendance/...] │
│ + doCheckOut(Request): RedirectResponse[POST /attendance/...] │
│                                                               │
│ Admin Methods:                                                 │
│ + adminDashboard(Request): View        [GET /admin/attenda...] │
│ + adminIndex(Request): View            [GET /admin/attenda...] │
│ + adminEdit(int): View                 [GET /admin/attenda...] │
│ + adminUpdate(Request, int): Redirect  [PUT /admin/attenda...] │
│ + adminDestroy(int): RedirectResponse  [DEL /admin/attenda...] │
├────────────────────────────────────────────────────────────────┤
│ Private Methods:                                               │
│ - getTodayAttendance(int): ?Attendance                         │
│ - getDashboardStats(date): array                              │
│ - formatAttendanceData(array): array                           │
└────────────────────────────────────────────────────────────────┘
```

## Request-Response Flow Diagram

### Employee CRUD Flow
```
User Request (HTTP)
    ↓
Route::resource('employees', EmployeeController)
    ↓
    ├─→ GET /employees
    │   └─→ EmployeeController@index()
    │       └─→ Employee::all()
    │           └─→ View: employees.index (table of employees)
    │
    ├─→ GET /employees/create
    │   └─→ EmployeeController@create()
    │       └─→ View: employees.create (form)
    │
    ├─→ POST /employees
    │   └─→ EmployeeController@store(Request $request)
    │       ├─→ $request->validate()
    │       ├─→ Employee::create($data)
    │       └─→ Redirect with success message
    │
    ├─→ GET /employees/{id}/edit
    │   └─→ EmployeeController@edit($id)
    │       └─→ View: employees.edit (form with data)
    │
    ├─→ PUT /employees/{id}
    │   └─→ EmployeeController@update(Request $request, $id)
    │       ├─→ $employee = Employee::find($id)
    │       ├─→ $employee->update($data)
    │       └─→ Redirect with success message
    │
    └─→ DELETE /employees/{id}
        └─→ EmployeeController@destroy($id)
            ├─→ $employee = Employee::find($id)
            ├─→ $employee->delete()
            └─→ Redirect with success message
```

### Attendance Check-In Flow
```
Employee Access: http://localhost:8000/attendance/check-in
    ↓
GET /attendance/check-in
    ↓
AttendanceController@checkIn()
    ├─→ $today = Carbon::today()
    ├─→ $attendance = Attendance::where('employee_id', $id)
    │                           ->where('attendance_date', $today)
    │                           ->first()
    └─→ View: attendance.check-in (with current status)
    
User Clicks "Check-In" Button
    ↓
POST /attendance/check-in
    ↓
AttendanceController@doCheckIn(Request $request)
    ├─→ $employeeId = Auth::id() or $request->employee_id
    ├─→ $today = Carbon::today()
    ├─→ $attendance = Attendance::firstOrCreate(
    │       ['employee_id' => $employeeId, 'attendance_date' => $today],
    │       ['check_in_time' => now(), 'status' => 'hadir']
    │   )
    ├─→ $attendance->update(['check_in_time' => now()])
    └─→ Redirect back with success message

User Clicks "Check-Out" Button (Later)
    ↓
POST /attendance/check-out
    ↓
AttendanceController@doCheckOut(Request $request)
    ├─→ $employeeId = Auth::id() or $request->employee_id
    ├─→ $today = Carbon::today()
    ├─→ $attendance = Attendance::where('employee_id', $employeeId)
    │                           ->where('attendance_date', $today)
    │                           ->firstOrFail()
    ├─→ $attendance->update(['check_out_time' => now()])
    └─→ Redirect with success message
```

### Admin Dashboard Flow
```
Admin Access: http://localhost:8000/admin/attendance
    ↓
GET /admin/attendance
    ↓
AttendanceController@adminDashboard(Request $request)
    ├─→ $date = $request->date ?? Carbon::today()
    ├─→ $stats = [
    │       'total' => Employee::count(),
    │       'hadir' => Attendance::where('attendance_date', $date)
    │                            ->where('status', 'hadir')->count(),
    │       'alfa' => Attendance::where('attendance_date', $date)
    │                           ->where('status', 'alfa')->count(),
    │       'sakit_izin' => Attendance::where('attendance_date', $date)
    │                                  ->whereIn('status', ['sakit','izin'])
    │                                  ->count()
    │   ]
    ├─→ $attendances = Attendance::with('employee')
    │                             ->where('attendance_date', $date)
    │                             ->paginate(20)
    └─→ View: admin.attendance.dashboard (with stats + table)
```

## Data Validation Rules

```php
// Employee Validation
[
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:employees|max:255',
    'phone' => 'required|string|max:20',
    'position' => 'nullable|string|max:100',
    'position_id' => 'nullable|exists:positions,id',
]

// Position Validation
[
    'name' => 'required|string|unique:positions|max:255',
    'description' => 'nullable|string|max:1000',
]

// Attendance Validation
[
    'employee_id' => 'required|exists:employees,id',
    'attendance_date' => 'required|date',
    'check_in_time' => 'nullable|date_format:H:i:s',
    'check_out_time' => 'nullable|date_format:H:i:s',
    'status' => 'required|in:hadir,sakit,izin,alfa',
    'notes' => 'nullable|string|max:500',
]
```

## Design Patterns Used

### 1. MVC (Model-View-Controller)
- **Model:** Eloquent models (User, Employee, Position, Attendance)
- **View:** Blade templates untuk rendering HTML
- **Controller:** Business logic dan HTTP request handling

### 2. Repository Pattern (Implicit)
- Models act as repositories untuk database access
- Eloquent methods: all(), find(), where(), create(), update(), delete()

### 3. Factory Pattern
- UserFactory untuk generating test data
- PositionSeeder, EmployeeSeeder untuk data creation

### 4. Service Locator Pattern
- Laravel Container untuk dependency injection
- Automatic resolution dari class dependencies

### 5. Observer Pattern
- Eloquent Model Events: creating, created, updating, updated, deleting, deleted

## View Hierarchy

```
layouts/
├── app.blade.php               [Master layout - navbar, styles, footer]
│
├── employees/
│   ├── home.blade.php          [List all employees + stats]
│   ├── index.blade.php         [Employee list (extended)]
│   ├── create.blade.php        [Create employee form]
│   └── edit.blade.php          [Edit employee form]
│
├── positions/
│   ├── index.blade.php         [List positions]
│   ├── create.blade.php        [Create position form]
│   └── edit.blade.php          [Edit position form]
│
├── users/
│   ├── index.blade.php         [List users]
│   ├── create.blade.php        [Create user form]
│   └── edit.blade.php          [Edit user form]
│
└── attendance/
    ├── check-in.blade.php      [User check-in interface]
    │
    └── admin/attendance/
        ├── dashboard.blade.php [Admin dashboard + stats]
        ├── index.blade.php     [Admin list attendance]
        └── edit.blade.php      [Admin edit attendance]
```

## Error Handling Flow

```
Exception Occurs
    ↓
├─→ ModelNotFoundException → 404 Not Found
├─→ ValidationException → 422 Unprocessable Entity (dengan errors)
├─→ AuthorizationException → 403 Forbidden
├─→ QueryException → 500 Internal Server Error
└─→ Generic Exception → 500 Internal Server Error

Handling:
    ↓
Laravel\Foundation\Exceptions\Handler (app/Exceptions/Handler.php)
    ↓
    ├─→ Log error ke storage/logs/laravel.log
    ├─→ Render error view (resources/views/errors/{status}.blade.php)
    └─→ Return error response to client
```

## Caching Strategy

```
Dashboard Statistics
    ↓
    ├─→ Query dari database
    ├─→ Cache hasil untuk 1 jam
    └─→ Return cached data pada request berikutnya (sampai expired)
    
Employee List
    ↓
    ├─→ Query dari database
    └─→ No caching (data frequently updated)
```

## Security Measures

1. **CSRF Protection** - @csrf token di semua forms
2. **Input Validation** - Form request validation di controllers
3. **SQL Injection Prevention** - Parameterized queries via Eloquent
4. **XSS Prevention** - Blade template auto-escaping
5. **Password Hashing** - bcrypt hashing untuk passwords
6. **Authorization** - Middleware untuk route protection
7. **Rate Limiting** - Laravel built-in rate limiting (optional)

## Testing Structure

```
tests/
├── Feature/
│   ├── EmployeeControllerTest.php      [Integration tests]
│   ├── PositionControllerTest.php
│   ├── UserControllerTest.php
│   └── AttendanceControllerTest.php
│
└── Unit/
    ├── EmployeeModelTest.php            [Unit tests]
    ├── PositionModelTest.php
    ├── UserModelTest.php
    └── AttendanceModelTest.php
```

## Performance Optimization

### 1. Database Queries
- Eager loading dengan `->with()` untuk prevent N+1 queries
- Indexing pada FK dan frequently queried columns
- Pagination untuk large datasets

### 2. Caching
- Cache dashboard statistics
- Cache employee list (optional)

### 3. Assets
- Minify CSS/JS dengan Vite
- CDN untuk Bootstrap & Bootstrap Icons

### 4. Middleware
- Optimize middleware stack
- Avoid unnecessary computations

## Deployment Architecture

```
Development Machine
    ↓ (git push)
    ↓
GitHub Repository (azril-absenkaryawan)
    ↓ (git pull/clone)
    ↓
Production Server
    ├─→ PHP 8.2+
    ├─→ MySQL 5.7+
    ├─→ Nginx/Apache
    ├─→ Composer (installed)
    ├─→ NPM (assets compiled)
    └─→ .env configuration
    
Public Folder
    └─→ index.php (entry point)
```

---

**Version:** 1.0.0  
**Last Updated:** November 28, 2025  
**Architecture Pattern:** MVC  
**Framework:** Laravel 12
