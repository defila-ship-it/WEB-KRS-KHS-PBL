<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect($this->redirectPath(Auth::user()->role));
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'nim' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', Rule::in(['admin', 'dosen', 'mahasiswa'])],
        ]);

        $login = $data['nim'];
        $user = User::query()
            ->where('role', $data['role'])
            ->where(function ($query) use ($login) {
                $query->where('email', $login)
                    ->orWhere('identifier', $login);
            })
            ->first();

        if (! $user && in_array($data['role'], ['dosen', 'mahasiswa'], true)) {
            $user = $this->createLoginUserFromAcademicData($login, $data['role']);
        }

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return back()
                ->withErrors(['nim' => 'NIM/NIDN/email, password, atau role tidak sesuai.'])
                ->withInput($request->only('nim', 'role'));
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath($user->role));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->student) {
            $user->student->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);
        }

        if ($user->lecturer) {
            $user->lecturer->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (! Hash::check($data['current_password'], $request->user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $request->user()->update(['password' => $data['password']]);

        return back()->with('success', 'Password berhasil diubah.');
    }

    private function redirectPath(string $role): string
    {
        return match ($role) {
            'admin' => route('dashboard'),
            'dosen' => route('dosen.dashboard'),
            'mahasiswa' => route('mahasiswa.dashboard'),
            default => route('login'),
        };
    }

    private function createLoginUserFromAcademicData(string $login, string $role): ?User
    {
        if ($role === 'mahasiswa') {
            $student = Student::query()
                ->where('nim', $login)
                ->orWhere('email', $login)
                ->first();

            if (! $student) {
                return null;
            }

            $user = User::create([
                'name' => $student->name,
                'email' => $student->email,
                'identifier' => $student->nim,
                'role' => 'mahasiswa',
                'password' => $student->nim,
            ]);

            $student->update(['user_id' => $user->id]);

            return $user;
        }

        $lecturer = Lecturer::query()
            ->where('nidn', $login)
            ->orWhere('email', $login)
            ->first();

        if (! $lecturer) {
            return null;
        }

        $user = User::create([
            'name' => $lecturer->name,
            'email' => $lecturer->email,
            'identifier' => $lecturer->nidn,
            'role' => 'dosen',
            'password' => $lecturer->nidn,
        ]);

        $lecturer->update(['user_id' => $user->id]);

        return $user;
    }
}
