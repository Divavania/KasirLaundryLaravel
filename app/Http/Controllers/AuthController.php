<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if ($user) {
            $inputPassword = $credentials['password'];
            $dbPassword = $user->password;

            // Cek bcrypt
            if (Hash::check($inputPassword, $dbPassword)) {
                return $this->prosesLogin($user);
            }

            // Cek MD5 dan upgrade
            if ($dbPassword === md5($inputPassword)) {
                // Upgrade ke bcrypt
                $user->update([
                    'password' => Hash::make($inputPassword)
                ]);

                return $this->prosesLogin($user);
            }
        }

        return back()->with('error', 'Login gagal! Cek kembali username atau password.');
    }

    private function prosesLogin($user)
    {
        if ($user->status === 'nonaktif') {
            return back()->with('error', 'Akun Anda nonaktif.');
        }

        // ✅ Login manual Laravel
        Auth::guard('web')->login($user);

        // ✅ Arahkan ke dashboard sesuai role
        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}