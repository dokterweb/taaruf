<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Paket;
use App\Models\Member;
use Midtrans\Notification;
use Illuminate\Support\Str;
use App\Models\Member_paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class FrontController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
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
        return view('front.views.profile');
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
        // Log request untuk debug
        \Log::info("Received order ID: $orderId with status: " . $request->status);
    
        // Cari order berdasarkan ID
        $order = Member_paket::where('order_id', $orderId)->first();  // Menggunakan 'order_id' untuk mencari transaksi
    
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan']);
        }
    
        // Update status menjadi 'paid'
        $order->status = $request->status;  // Ambil status dari request
        $order->save();
    
        // Log setelah update
        \Log::info("Updated order ID: $orderId to status: " . $order->status);
    
        // Mengembalikan respons sukses
        return response()->json(['success' => true, 'message' => 'Status pembayaran berhasil diperbarui']);
    }
    
    
    

}
