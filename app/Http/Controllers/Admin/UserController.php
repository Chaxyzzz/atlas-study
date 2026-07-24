<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Build filtered and sorted query.
     */
    private function buildFilteredQuery(Request $request)
    {
        $query = User::query();

        // Search by Name, Username, Email, Phone Number, Google ID
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('google_id', 'like', "%{$search}%");
            });
        }

        // Filter by Provider
        if ($request->filled('provider')) {
            $provider = strtolower($request->input('provider'));
            if ($provider === 'google') {
                $query->where(function ($q) {
                    $q->where('provider', 'google')->orWhereNotNull('google_id');
                });
            } elseif ($provider === 'phone') {
                $query->where(function ($q) {
                    $q->where('provider', 'phone')
                      ->orWhere(function ($sub) {
                          $sub->whereNotNull('phone')->where('email', 'like', '%@atlasstudy.internal');
                      });
                });
            } elseif ($provider === 'local') {
                $query->where(function ($q) {
                    $q->where('provider', 'local')
                      ->orWhere(function ($sub) {
                          $sub->whereNull('google_id')
                              ->where('email', 'not like', '%@atlasstudy.internal');
                      });
                });
            } else {
                $query->where('provider', $provider);
            }
        }

        // Filter by Role
        if ($request->filled('role')) {
            $role = strtolower($request->input('role'));
            if ($role === 'admin' || $role === 'administrator') {
                $query->where(function ($q) {
                    $q->where('is_admin', true)->orWhere('role', 'admin');
                });
            } elseif ($role === 'super_admin') {
                $query->where('role', 'super_admin');
            } elseif ($role === 'teacher') {
                $query->where('role', 'teacher');
            } elseif ($role === 'guest') {
                $query->where('role', 'guest');
            } elseif ($role === 'student') {
                $query->where(function ($q) {
                    $q->where('role', 'student')
                      ->orWhere(function ($sub) {
                          $sub->where('is_admin', false)
                              ->whereNotIn('role', ['super_admin', 'admin', 'teacher', 'guest']);
                      });
                });
            }
        }

        // Filter by Status
        if ($request->filled('status')) {
            $status = strtolower($request->input('status'));
            if ($status === 'active') {
                $query->where(function ($q) {
                    $q->where('status', 'active')->orWhereNull('status');
                });
            } else {
                $query->where('status', $status);
            }
        }

        // Filter by Language
        if ($request->filled('language')) {
            $lang = strtolower($request->input('language'));
            $query->where(function ($q) use ($lang) {
                if ($lang === 'id') {
                    $q->where('preferred_language', 'id')->orWhereNull('preferred_language');
                } else {
                    $q->where('preferred_language', $lang);
                }
            });
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = strtolower($request->input('sort_order', 'desc')) === 'asc' ? 'asc' : 'desc';

        $allowedSorts = ['name', 'created_at', 'last_login_at', 'role', 'status', 'preferred_language'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->latest();
        }

        return $query;
    }

    /**
     * Display a listing of users with statistics, search, sorting, and multi-filtering.
     */
    public function index(Request $request)
    {
        $query = $this->buildFilteredQuery($request);
        $users = $query->paginate(15)->appends($request->all());

        // Dynamic 8 summary cards
        $stats = [
            'total_users' => User::count(),
            'google_users' => User::where('provider', 'google')->orWhereNotNull('google_id')->count(),
            'phone_users' => User::where('provider', 'phone')->orWhere(function ($q) {
                $q->whereNotNull('phone')->where('email', 'like', '%@atlasstudy.internal');
            })->count(),
            'admins' => User::where('is_admin', true)->orWhereIn('role', ['super_admin', 'admin'])->count(),
            'teachers' => User::where('role', 'teacher')->count(),
            'students' => User::where(function ($q) {
                $q->where('is_admin', false)->whereNotIn('role', ['super_admin', 'admin', 'teacher', 'guest']);
            })->orWhere('role', 'student')->count(),
            'today_registrations' => User::whereDate('created_at', today())->count(),
            'active_today' => User::whereDate('last_login_at', today())->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * Display detailed user profile JSON.
     */
    public function show(User $user)
    {
        $roleLabels = [
            'super_admin' => 'Super Administrator',
            'admin' => 'Administrator',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'guest' => 'Guest',
        ];

        $statusLabels = [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'suspended' => 'Suspended',
            'verified' => 'Verified',
            'pending' => 'Pending',
        ];

        $effectiveRole = $user->role ?: ($user->is_admin ? 'admin' : 'student');
        $effectiveStatus = $user->status ?: 'active';

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username ? '@' . ltrim($user->username, '@') : '-',
            'email' => $user->email,
            'email_verified' => $user->email_verified_at ? 'Terverifikasi (' . $user->email_verified_at->format('d M Y') . ')' : 'Belum Verifikasi',
            'phone' => $user->phone ?: '-',
            'avatar' => $user->avatar_url,
            'google_id' => $user->google_id ?: '-',
            'provider' => ucfirst($user->effective_provider),
            'role_key' => $effectiveRole,
            'role' => $roleLabels[$effectiveRole] ?? ucfirst($effectiveRole),
            'preferred_language' => ($user->preferred_language === 'en') ? 'English' : 'Bahasa Indonesia',
            'status_key' => $effectiveStatus,
            'status' => $statusLabels[$effectiveStatus] ?? ucfirst($effectiveStatus),
            'registered_date' => $user->created_at ? $user->created_at->format('d F Y, H:i') . ' WIB' : '-',
            'last_login_at' => $user->last_login_at ? $user->last_login_at->format('d F Y, H:i') . ' WIB' : 'Never',
            'last_login_ip' => $user->last_login_ip ?: '-',
            'device' => $user->device ?: 'Desktop',
            'browser' => $user->browser ?: 'Chrome 139',
            'operating_system' => $user->operating_system ?: 'Windows 11',
        ]);
    }

    /**
     * Update user details with role-based security checks.
     */
    public function update(Request $request, User $user)
    {
        $currentUser = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:30',
            'role' => 'required|in:super_admin,admin,teacher,student,guest',
            'status' => 'required|in:active,inactive,suspended,verified,pending',
            'preferred_language' => 'required|in:id,en',
        ]);

        // Security check: Only Super Admin can change Roles
        if ($validated['role'] !== ($user->role ?: ($user->is_admin ? 'admin' : 'student'))) {
            if (!$currentUser->isSuperAdmin()) {
                return back()->with('error', 'Hanya Super Administrator yang berhak mengubah Role pengguna.');
            }
        }

        // Security check: Only Super Admin can modify a Super Admin user
        if ($user->isSuperAdmin() && !$currentUser->isSuperAdmin()) {
            return back()->with('error', 'Hanya Super Administrator yang berhak mengubah akun Super Administrator.');
        }

        $validated['is_admin'] = in_array($validated['role'], ['super_admin', 'admin']);

        $user->update($validated);

        return back()->with('success', "Pengguna {$user->name} berhasil diperbarui.");
    }

    /**
     * Toggle user status (Activate / Deactivate).
     */
    public function toggleStatus(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat mengubah status akun Anda sendiri.');
        }

        $newStatus = ($user->status === 'inactive') ? 'active' : 'inactive';
        $user->update(['status' => $newStatus]);

        $label = ($newStatus === 'active') ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun {$user->name} berhasil {$label}.");
    }

    /**
     * Suspend user account (Only Super Admin).
     */
    public function suspend(User $user)
    {
        $currentUser = auth()->user();

        if (!$currentUser->isSuperAdmin()) {
            return back()->with('error', 'Hanya Super Administrator yang berhak menangguhkan (suspend) akun pengguna.');
        }

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'Anda tidak dapat menangguhkan akun Anda sendiri.');
        }

        $user->update(['status' => 'suspended']);

        return back()->with('success', "Akun {$user->name} berhasil ditangguhkan (Suspended).");
    }

    /**
     * Reset user session / remember token.
     */
    public function resetSession(User $user)
    {
        $user->update([
            'remember_token' => Str::random(60),
        ]);

        return back()->with('success', "Sesi pengguna {$user->name} berhasil direset.");
    }

    /**
     * Delete user account (Only Super Admin).
     */
    public function destroy(User $user)
    {
        $currentUser = auth()->user();

        if (!$currentUser->isSuperAdmin()) {
            return back()->with('error', 'Hanya Super Administrator yang berhak menghapus akun pengguna.');
        }

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "Pengguna {$name} berhasil dihapus.");
    }

    /**
     * Export filtered users to CSV file.
     */
    public function exportCsv(Request $request)
    {
        $users = $this->buildFilteredQuery($request)->get();

        $filename = 'atlas_users_export_' . date('Y_m_d_His') . '.csv';

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');
            // BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'ID', 'Full Name', 'Username', 'Email', 'Phone', 'Provider', 
                'Role', 'Language', 'Status', 'Registration Date', 
                'Last Login Time', 'Last Login IP', 'Browser', 'Operating System', 'Device'
            ]);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->username ? '@' . ltrim($user->username, '@') : '',
                    $user->email,
                    $user->phone,
                    strtoupper($user->effective_provider),
                    strtoupper($user->role ?: ($user->is_admin ? 'admin' : 'student')),
                    strtoupper($user->preferred_language ?: 'id'),
                    strtoupper($user->status ?: 'active'),
                    $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '',
                    $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : '',
                    $user->last_login_ip,
                    $user->browser,
                    $user->operating_system,
                    $user->device
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export filtered users to Excel XML format.
     */
    public function exportExcel(Request $request)
    {
        $users = $this->buildFilteredQuery($request)->get();
        $filename = 'atlas_users_export_' . date('Y_m_d_His') . '.xls';

        $headers = [
            "Content-type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Expires" => "0"
        ];

        return response()->view('admin.users.export_excel', compact('users'), 200, $headers);
    }

    /**
     * Export filtered users to printable PDF layout.
     */
    public function exportPdf(Request $request)
    {
        $users = $this->buildFilteredQuery($request)->get();
        return view('admin.users.export_pdf', compact('users'));
    }
}
