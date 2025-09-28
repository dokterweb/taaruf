<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.members.index',compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit',compact('member'));
    }

    public function store(StoreMemberRequest $request)
    {
        try {
            $validated = $request->validated();
            \Log::info('Validation Passed', ['data' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Failed', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        }

        DB::beginTransaction();

        try {
            // Simpan avatar jika ada
            $avatarPath = null;
           
            if($request->hasFile('avatar')){
                // Perubahan: Tentukan lokasi folder public/avatars untuk menyimpan file
                $file = $request->file('avatar');
                $fileName = $file->getClientOriginalName();
                
                // Mengganti spasi dengan underscore atau karakter lain
                $fileName = str_replace(' ', '_', $fileName);  // Ganti spasi dengan underscore
                
                $avatarPath = 'avatars/' . $fileName;

                // Pindahkan file ke folder public/avatars
                $file->move(public_path('avatars'), $fileName);
                
            }
            
            // Buat user baru
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'avatar' => $avatarPath,  // Menyimpan path avatar di database
                'password' => Hash::make($validated['password']),
            ]);

            $user->assignRole('member');

            // Susun data member
            $memberData = [
                'user_id'         => $user->id,
                'tempat_lahir'    => $validated['tempat_lahir'] ?? null,
                'tanggal_lahir'   => $validated['tanggal_lahir'] ?? null,
                'kelamin'         => $validated['kelamin'] ?? null,
                'no_hp'           => $validated['no_hp'] ?? null,
                'is_active'       => $validated['is_active'],
            ];

            \Log::info('member Data to be Inserted', $memberData);

            Member::create($memberData);

            DB::commit();

            return redirect()->route('admin.members')->with('success', 'Data member berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('member Creation Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'member_data' => $memberData ?? null,
            ]);
            return back()->withInput()->with('error', 'Gagal menyimpan: '.$e->getMessage());
        }
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        // Data sudah divalidasi di UpdatememberRequest
        $validated = $request->validated();
    
        // Update data User terkait
        $userData = [
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ];
    
        // Cek apakah password diisi, jika iya, update password
        if ($request->filled('password')) {
            // Hanya update password jika diisi
            $userData['password'] = bcrypt($validated['password']);
        }
    
        // Cek apakah ada file avatar yang diunggah
        if ($request->hasFile('avatar')) {
            // Simpan avatar ke storage dan update path-nya
            $avatarPath = $request->file('avatar')->store('member', 'public');
            $userData['avatar'] = $avatarPath;
        }
    
        // Update data user yang terkait dengan worker
        $member->user->update($userData);
    
        // Simpan data ke tabel members
        $member->update([
            'tempat_lahir'    => $validated['tempat_lahir'] ?? null,
            'tanggal_lahir'   => $validated['tanggal_lahir'] ?? null,
            'no_hp'           => $validated['no_hp'] ?? null,
            'kelamin'         => $validated['kelamin'],
            'is_active'       => $validated['is_active'],
        ]);
    
        return redirect()->route('admin.members')->with('success', 'Data member berhasil diperbarui!');
    }
    
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('admin.members')->with('success', 'Data berhasil dihapus.');
    }
}
