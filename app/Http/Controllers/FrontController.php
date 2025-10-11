<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Member;
use Midtrans\Notification;
use Illuminate\Support\Str;
use App\Models\Member_paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

class FrontController extends Controller
{
    /* public function index()
    {
        $pakets = Paket::all();
        return view('front.views.index',compact('pakets'));
    } */
    public function index(Request $request)
    {
        $me = Auth::user()->member;  // Ambil data member yang login
        $pakets = Paket::all();
        // Cek apakah member memiliki paket aktif
        $hasPackage = Member_paket::query()
            ->where('member_id', $me->id)
            ->where('status', 'paid')
            ->whereDate('tanggalmulai', '<=', now())
            ->whereDate('tanggalakhir', '>=', now())
            ->exists();  // Jika member punya paket aktif

        // Jika belum membeli paket, kirim flash message
    /*     if (!$hasPackage) {
            session()->flash('message', 'Anda harus membeli paket sebelum melihat profile member');
            session()->flash('message_type', 'info'); // Bisa gunakan 'info', 'success', 'danger', etc.
        } */

          // Periksa jika datang dari wishlist (via parameter)
        if ($request->has('from_wishlist') && !$hasPackage) {
            // Kirim flash message hanya jika member belum membeli paket
            session()->flash('message', 'Anda harus membeli paket sebelum melihat profile member');
            session()->flash('message_type', 'info');
        }
        
        return view('front.views.index',compact('pakets'));
    }


    public function register()
    {
        return view('front.views.register');
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email',
            'password'      => 'required|string|min:8', // Set password minimum 8 karakter
            'no_hp'         => 'required|string|max:100',
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'kelamin'       => 'required|string|in:pria,wanita',
        ]);

        // return $credential;
         // Buat user baru
         $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'avatar'    => 'images/default-avatar.png', // Jika tidak ada avatar, nilainya null
            'password'  => Hash::make($validated['password']),
        ]);
        Auth::login($user);
        event(new Registered($user));

        $member = Member::create([
            'user_id'       => $user->id,
            'kelamin'       => $validated['kelamin'],
            'tempat_lahir'  => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_hp'         => $validated['no_hp'],
            'is_active'     => '1',
        ]);

        return redirect('/profile');
    }

    public function profile()
    {
        $user   = Auth::user();
        $member = $user->member;

        $age = null;
        if ($member && $member->tanggal_lahir) {
            $age = Carbon::parse($member->tanggal_lahir)->age;
        }
        // daftar field yang dianggap wajib untuk progress
        $fields = [
            $user->name,
            $user->email,
            $member->tempat_lahir ?? null,
            $member->tanggal_lahir ?? null,
            $member->kelamin ?? null,
            $member->no_hp ?? null,
            $member->tempat_tinggal ?? null,
            $member->pendidikan ?? null,
            $member->karakter ?? null,
            $member->karakter_pasangan ?? null,
            $member->hafalan_surat ?? null,
        ];

        $totalFields = count($fields);
        $filledFields = collect($fields)->filter(fn($val) => !empty($val))->count();

        $percentage = $totalFields > 0 ? round(($filledFields / $totalFields) * 100) : 0;

        return view('front.views.profile', compact('member','user','percentage','age'));
    }



    public function updateProfile(Request $request)
    {
        // dd($request->all());

        $user   = Auth::user();
        $member = $user->member ?? $user->member()->create(['kelamin' => 'pria', 'is_active' => '1']);

        // VALIDASI
        $validatedMember = $request->validate([
            'tempat_lahir'      => 'nullable|string|max:255',
            'tanggal_lahir'     => 'nullable|date',
            'kelamin'           => 'required|in:pria,wanita',
            'no_hp'             => 'nullable|string|max:255',
            'tempat_tinggal'    => 'nullable|string|max:255',
            'pendidikan'        => 'nullable|string|max:255',
            'karakter'          => 'nullable|string|max:255',
            'karakter_pasangan' => 'nullable|string|max:255',
            'hafalan_surat'     => 'nullable|string|max:255',
        ]);

        // Validasi user (email & password)
        $validatedUser = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'password' => ['nullable','string','min:8','confirmed'], // butuh field password_confirmation
            // 'current_password' => ['required_with:password','current_password'], // opsional keamanan ekstra
        ]);

        DB::beginTransaction();
        try {
            // Update member
            $member->update($validatedMember);

            // (Opsional) sinkron avatar saat kelamin berubah
            $expectedAvatar = $validatedMember['kelamin'] === 'pria'
                ? 'avatars/listman.jpg'
                : 'avatars/listwoman.jpg';

            $user->name   = $validatedUser['name']; // <--- tambahkan
            $user->email  = $validatedUser['email'];
            $user->avatar = $expectedAvatar;

            if (!empty($validatedUser['password'])) {
                $user->password = Hash::make($validatedUser['password']);
            }

            $user->save();

            DB::commit();

            return back()->with('success', 'Profil berhasil diperbarui.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['general' => 'Gagal memperbarui profil: '.$e->getMessage()])
                        ->withInput();
        }
    }

    public function homelist()
    {
        return view('front.views.homelist');
    }
    
    public function paket()
    {
        $pakets = Paket::all();
        return view('front.views.paket',compact('pakets'));
    }

    public function wishlist()
    {
        return view('front.views.wishlist');
    }


     public function pay(Request $request, $paketId)
     {
         // Simpan paket_id yang dipilih ke session
         session(['paket_id' => $paketId]);
     
         // Ambil paket yang dipilih
         $paket = Paket::findOrFail($paketId);  // Pastikan paket ada
     
         // Buat order_id yang unik untuk transaksi
         $orderId = 'ORD-' . now()->format('YmdHis') . '-' . strtoupper(uniqid());
     
         // Insert ke tabel member_pakets dengan status 'pending'
         try {
             $order = new Member_paket([
                 'member_id' => auth()->user()->member->id, // Mengambil member_id dari user yang sedang login
                 'paket_id'  => $paket->id,
                 'status'    => 'pending', // Status transaksi masih pending
                 'order_id'  => $orderId,  // Order ID yang unik
             ]);
             $order->save();  // Menyimpan order ke database
         } catch (\Exception $e) {
             Log::error('Gagal menyimpan order ke tabel member_pakets: ' . $e->getMessage());
             return response()->json(['error' => 'Gagal menyimpan transaksi ke database'], 500);
         }
     
         // Lakukan pemrosesan pembayaran dengan Midtrans
         // Misalnya, ambil snapToken dari Midtrans dan kirim ke front-end
         $snapToken = $this->getMidtransSnapToken($paketId, $orderId);  // Sertakan orderId
         Log::info("SnapToken: ", [$snapToken]);

          // Pastikan snapToken ada
        if (!$snapToken) {
            return response()->json(['error' => 'Gagal mendapatkan Snap Token'], 500);
        }
        
         // Kembalikan snapToken dan orderId ke front-end
         return response()->json(['snapToken' => $snapToken, 'orderId' => $orderId]);
     }
     

     private function getMidtransSnapToken($paketId, $orderId)
     {
         // Ambil paket berdasarkan paketId
         $paket = Paket::find($paketId);
     
         // Konfigurasi untuk transaksi Midtrans
         $params = [
             'transaction_details' => [
                 'order_id'     => $orderId,  // Gunakan order_id yang unik
                 'gross_amount' => $paket->biaya,  // Biaya dari paket
             ],
             'customer_details' => [
                 'first_name' => auth()->user()->name,
                 'email'      => auth()->user()->email,
             ],
         ];
     
         // Ambil snapToken dari Midtrans
         try {
             $snapToken = Snap::getSnapToken($params);
             return $snapToken;
         } catch (\Exception $e) {
             Log::error('Error saat mengambil SnapToken: ' . $e->getMessage());
             return response()->json(['error' => 'Gagal mendapatkan Snap Token'], 500);
         }
     }
    

     public function checkout($orderId)
     {
         $order = Member_paket::where('order_id', $orderId)->first();
     
         if (!$order) {
             return redirect()->route('front.home')->with('error', 'Transaksi tidak ditemukan.');
         }
     
         $paket = Paket::find($order->paket_id);
     
         if (!$paket) {
             return redirect()->route('front.home')->with('error', 'Paket tidak ditemukan.');
         }
     
         // Ambil snapToken dari Midtrans
         $snapToken = $this->getMidtransSnapToken($paket->id, $order->order_id);
     
         // Pastikan snapToken ada
         if (!$snapToken) {
             return redirect()->route('front.home')->with('error', 'Gagal mendapatkan Snap Token.');
         }
     
         return view('front.views.checkout', compact('paket', 'snapToken', 'order','orderId'));
     }
     

     
     

     public function updateStatus(Request $request, $orderId)
     {
        \Log::info("Received order ID: $orderId payload:", $request->all());
    
        $order = Member_paket::where('order_id', $orderId)->first();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan']);
        }
    
        // Ambil status dari Midtrans (lebih akurat daripada field 'status' custom)
        $trxStatus  = $request->input('transaction_status'); // e.g. 'settlement', 'capture', 'pending', 'deny', 'expire', 'cancel'
        $fraud      = $request->input('fraud_status');       // e.g. 'accept'
        $paidOK     = in_array($trxStatus, ['settlement', 'capture']) && ($fraud === null || $fraud === 'accept');
    
        // Selalu simpan status terakhir dari Midtrans ke kolom status kamu
        $order->status = $trxStatus ?: $request->input('status', $order->status);
    
        // Jika sudah paid dan tanggal belum pernah diisi, hitung tanggalmulai & tanggalakhir
        if ($paidOK && is_null($order->tanggalmulai) && is_null($order->tanggalakhir)) {
            $paket = Paket::findOrFail($order->paket_id);
    
            // Ambil waktu pembayaran: prefer settlement_time, fallback transaction_time, terakhir now()
            $timeStr = $request->input('settlement_time') ?? $request->input('transaction_time') ?? now()->toDateTimeString();
    
            // Midtrans time biasanya Asia/Jakarta. Simpan sebagai DATE (tanpa jam) sesuai ERD.
            $start = Carbon::parse($timeStr, 'Asia/Jakarta')->startOfDay();
            $end   = (clone $start)->addMonths($paket->durasi)->subDay(); // durasi bulan, habis di H-1
    
            $order->tanggalmulai = $start->toDateString();
            $order->tanggalakhir = $end->toDateString();
        }
    
        $order->save();
    
        \Log::info("Updated order {$order->order_id}: status={$order->status}, mulai={$order->tanggalmulai}, akhir={$order->tanggalakhir}");
    
        return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
    }
    
    

}
