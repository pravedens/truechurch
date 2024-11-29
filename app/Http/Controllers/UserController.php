<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::when($request->search, function($query) use($request){
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orWhere('church', 'like', '%'.$request->search. '%')
                ->orWhere('city', 'like', '%'.$request->search. '%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('users.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create User';
        $roles = Role::all();

        return view('users.formUser', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $imageName = null;

        if ($request->photo) {
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->photo->storeAs('public/images', $imageName);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'church' => $request->church,
            'city' => $request->city,
            'photo_profile' => $imageName,
        ]);

        $user->assignRole($request->roles);

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
        $roles = Role::all();
        $dataRoles = $user->roles->pluck('name')->toArray();

        return view('users.editUser', compact('user', 'title', 'roles', 'dataRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $request->validated();

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

        $user->syncRoles($request->roles);

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
