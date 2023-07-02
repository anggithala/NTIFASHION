<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;

use Dipantry\Rajaongkir\Models\ROCity;
use Dipantry\Rajaongkir\Models\ROProvince;

class OwnerSettingController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $provinces = ROProvince::all();
        $currentProvince = ($user->provinces_id) ? ROProvince::find($user->provinces_id) : NULL;
        $currentCity = ($user->regencies_id) ? ROCity::find($user->regencies_id) : NULL;

        return view('pages.owner.setting.index', [
            'user' => $user,
            'provinces' => $provinces,
            'currentProvince' => $currentProvince,
            'currentCity' => $currentCity
        ]);
    }

    public function updateInformation(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'address_one' => ['required'],
            'address_two' => ['required'],
            'provinces' => ['required', 'numeric'],
            'regencies' => ['required', 'numeric'],
            'zip_code' => ['required', 'numeric'],
            'country' => ['required', 'max:255'],
            'phone_number' => ['required', 'max:255']
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address_one = $request->address_one;
        $user->address_two = $request->address_two;
        $user->provinces_id = $request->provinces;
        $user->regencies_id = $request->regencies;
        $user->zip_code = $request->zip_code;
        $user->country = $request->country;
        $user->phone_number = $request->phone_number;

        $user->save();

        return redirect()->route('owner.setting')->with('success', 'Informasi akun berhasil diubah.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_password_confirmation' => ['required', 'string', 'min:8', 'same:new_password']
        ]);

        $user = User::find(Auth::user()->id);
        $hashedPassword = Hash::make($request->new_password);

        if (!Hash::check($request->new_password, $user->password)) {
            $user->password = $hashedPassword;

            $user->save();

            return redirect()->route('owner.setting')->with('success', 'Password berhasil diubah.');
        }

        return redirect()->route('owner.setting')->with('error', 'Password tidak ada perubahan.');
    }

    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'file', 'max:256', 'mimes:png,jpg,jpeg']
        ]);

        $user = User::find(Auth::user()->id);

        $image = $request->file('avatar');

        $path = $image->storeAs('admin/profile', 'avatar_'.uniqid().'.'.$image->extension(), ['disk' => 'public']);

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = $path;

        $user->save();

        return redirect()->route('owner.setting')->with('success', 'Avatar berhasil diubah.');
    }
}
