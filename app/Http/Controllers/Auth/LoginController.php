<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->hasRole('owner')) {
                return redirect()->route('dashboard');
            }

            if ($user->hasRole('member')) {
                if ($user->hasVerifiedEmail()) {
                    return redirect()->route('front.home');
                } else {
                    Auth::logout();
                    return redirect()->route('verification.notice')
                        ->withErrors(['email' => 'Silakan verifikasi email terlebih dahulu.']);
                }
            }

            Auth::logout();
            return redirect()->route('login')->withErrors([
                'role' => 'Role tidak dikenali.',
            ]);
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function createMember(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:8',
            'no_hp'         => 'required|string|max:100',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelamin'       => 'required|string|in:pria,wanita',
        ]);
    
          // Tentukan avatar berdasarkan kelamin
        $avatar = match ($validated['kelamin']) {
            'pria'   => 'avatars/listman.png',
            'wanita' => 'avatars/listwoman.png',
        };
        
        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'avatar'    => $avatar,
            'password'  => Hash::make($validated['password']),
        ]);
    
        // kirim email verifikasi
        event(new Registered($user));
        Auth::login($user);
        $user->assignRole('member');
    
        Member::create([
            'user_id'       => $user->id,
            'kelamin'       => $validated['kelamin'],
            'tempat_lahir'  => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_hp'         => $validated['no_hp'],
            'is_active'     => '1',
        ]);
    
        // jangan langsung login, tunggu email verifikasi
        return redirect()->route('verification.notice')
            ->with('message', 'Silakan cek email untuk verifikasi akun Anda.');
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
