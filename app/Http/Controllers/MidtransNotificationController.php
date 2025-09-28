<?php

namespace App\Http\Controllers;
use App\Models\Member_paket;
use Midtrans\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MidtransNotificationController extends Controller
{
    public function handleMidtransNotification(Request $request)
    {
        try {
            $notification = new Notification();
            
            // Ambil data dari Midtrans
            $orderId = $notification->order_id;
            $status = $notification->transaction_status;
            $fraud = $notification->fraud_status;
            $customerEmail = $notification->customer_email;
    
            // Log untuk debugging
            Log::info("Notifikasi diterima", [
                'orderId' => $orderId,
                'status'  => $status,
                'email'   => $customerEmail,
            ]);
    
            // Cari order yang sesuai dengan order_id
            $order = Member_paket::where('order_id', $orderId)->first();
    
            if (!$order) {
                Log::warning("Order tidak ditemukan untuk ID: " . $orderId);
                return response()->json(['message' => 'Order not found'], 404);
            }
    
            // Update status berdasarkan hasil transaksi
            if ($status == 'capture') {
                if ($fraud == 'challenge') {
                    $order->status = 'pending';
                } else {
                    $order->status = 'paid';  // Pembayaran berhasil
                }
            } elseif ($status == 'settlement') {
                $order->status = 'paid';  // Pembayaran berhasil
            } elseif ($status == 'pending') {
                $order->status = 'pending';  // Pembayaran tertunda
            } elseif ($status == 'deny' || $status == 'cancel' || $status == 'expire') {
                $order->status = 'cancel';  // Pembayaran dibatalkan
            }
    
            // Simpan perubahan status ke database
            $order->save();
    
            Log::info('Status pembayaran diperbarui', ['orderId' => $orderId, 'status' => $order->status]);
    
            return response()->json(['message' => 'OK']);
        } catch (\Exception $e) {
            Log::error('Error saat memproses notifikasi Midtrans: ' . $e->getMessage());
            return response()->json(['error' => 'Error processing notification'], 500);
        }
    }
    
}
