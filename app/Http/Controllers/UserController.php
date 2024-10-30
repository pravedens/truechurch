<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create User';

        return view('users.formUser', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ]);

        $imageName = null;

        if ($request->photo) {
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->photo->storeAs('public/images', $imageName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'church' => $request->church,
            'city' => $request->city,
            'photo_profile' => $imageName,
        ]);

        return redirect()->route('users.index')->with('success', 'Пользователь добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.userShow', ['id' => $user->name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit User';

        return view('users.editUser', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        if ($request->photo) {
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->photo->storeAs('public/images', $imageName);

            //delete old photo
            $path = storage_path('app/public/images/'.$user->photo_profile);
            if (File::exists($path)) {
                File::delete($path);
            }

            $user->photo_profile = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->birthdate = $request->birthdate;
        $user->church = $request->church;
        $user->city = $request->city;

        $user->update();

        return redirect()->route('users.index')->with('success', 'Данные пользователя изменены!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            //delete old photo
            $path = storage_path('app/public/images/'.$user->photo_profile);
            if (File::exists($path)) {
                File::delete($path);
            }

            $user->deleteOrFail();

            return redirect()->route('users.index')->with('danger', 'Пользователь удален!');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
