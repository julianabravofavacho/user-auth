<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        // Atualiza nome e email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Se houver imagem nova
        if ($request->hasFile('profile_image')) {
            // Remove imagem anterior, se existir
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Armazena nova imagem
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
    }
}
