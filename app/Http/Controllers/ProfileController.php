<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateotherinfo(Request $request): RedirectResponse
    {
        $validated = $request->validate( [
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'phone_no' => ['required'],
            'qualification' => ['required'],
            'gender' => ['required']
        ]);

        $id = Auth::id();
        $detail = User::findOrFail($id);


        if(!empty($request->avatar)){
                 $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('avatars'), $avatarName);   
        }else{
            $avatarName = $detail->avatar;
        }

     try {

            $detail->first_name   = $request->first_name;
            $detail->last_name    = $request->last_name;
            $detail->phone_no   = $request->phone_no;
            $detail->gender    = $request->gender;
            $detail->qualification   = implode(',', (array) $request->qualification);
            $detail->avatar    = $avatarName;

            $detail->save();

        return back()->with('status', 'profile-info-updated');
          } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            
            return back();
        }
    }
}
    