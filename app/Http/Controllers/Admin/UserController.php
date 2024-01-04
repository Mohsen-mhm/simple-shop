<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|RedirectResponse|ApplicationAlias
    {
        if (!Gate::allows(User::USER_INDEX)) {
            return redirect()->route('admin.index');
        }

        $users = User::query()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows(User::USER_CREATE)) {
            return redirect()->route('admin.users.index');
        }

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows(User::USER_CREATE)) {
            return redirect()->route('admin.users.index');
        }

        $validData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:150'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string'],
            'confirm_password' => ['required', 'same:password'],
            'role' => ['required', 'string'],
        ], [
            'name.required' => 'نام باید حتما وارد شده باشد.',
            'name.string' => 'نام باید حتما کارکتر باشد.',
            'name.min' => 'نام باید حداقل :min کارکتر باشد.',
            'name.max' => 'نام باید حداکثر :max کارکتر باشد.',

            'email.required' => 'ایمیل باید حتما وارد شده باشد.',
            'email.email' => 'فرمت ایمیل صحیح نیست.',
            'email.unique' => 'ایمیل تکراری است',

            'password.string' => 'رمز عبور باید حتما کارکتر باشد.',

            'confirm_password.same' => 'تکرار رمز عبور باید با رمز عبور برابر باشد.',

            'role.required' => 'انتخاب نقش ضروری است.',
            'role.string' => 'نقش باید حتما کارکتر باشد.',
        ]);

        try {
            $role = Role::query()->whereName(strtoupper($validData['role']))->first();
            unset($validData['role'], $validData['confirm_password']);
            $validData['password'] = Hash::make($validData['password']);

            $user = User::query()->create($validData);
            if ($role) {
                $user->roles->attach($role->pluck('id'));
            }

            return redirect()->route('admin.users.index');
        } catch (\Exception) {
            return back()->withErrors('خطای سرور');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Application|Factory|RedirectResponse|ApplicationAlias
    {
        if (!Gate::allows(User::USER_EDIT)) {
            return redirect()->route('admin.users.index');
        }

        $user = User::query()->findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        if (!Gate::allows(User::USER_EDIT)) {
            return redirect()->route('admin.users.index');
        }

        $validData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:150'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => ['nullable', 'string'],
            'confirm_password' => ['nullable', 'same:password'],
            'role' => ['required', 'string'],
        ], [
            'name.required' => 'نام باید حتما وارد شده باشد.',
            'name.string' => 'نام باید حتما کارکتر باشد.',
            'name.min' => 'نام باید حداقل :min کارکتر باشد.',
            'name.max' => 'نام باید حداکثر :max کارکتر باشد.',

            'email.required' => 'ایمیل باید حتما وارد شده باشد.',
            'email.email' => 'فرمت ایمیل صحیح نیست.',
            'email.unique' => 'ایمیل تکراری است',

            'password.string' => 'رمز عبور باید حتما کارکتر باشد.',

            'confirm_password.same' => 'تکرار رمز عبور باید با رمز عبور برابر باشد.',

            'role.required' => 'انتخاب نقش ضروری است.',
            'role.string' => 'نقش باید حتما کارکتر باشد.',
        ]);

        try {
            if (!is_null($validData['password']) && !is_null($validData['confirm_password'])) {
                $validData['password'] = Hash::make($validData['password']);
                unset($validData['confirm_password']);
            } else {
                unset($validData['password'], $validData['confirm_password']);
            }

            $role = Role::query()->whereName(strtoupper($validData['role']))->first();
            unset($validData['role']);

            $user = User::query()->findOrFail($id);
            if (!$role) { // Select user
                if ($user->roles->count()) {
                    $user->roles()->detach(Role::query()->whereName(Role::ADMIN_ROLE)->first()->id);
                }
            } else { // Select Admin
                if (!$user->roles->count()) {
                    $user->roles()->attach(Role::query()->whereName(Role::ADMIN_ROLE)->first()->id);
                }
            }

            $user->update($validData);

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return back()->withErrors('خطای سرور');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function toggleBlock(string $id): RedirectResponse
    {
        $user = User::query()->findOrFail($id);

        if ($user->blocked) {
            $user->update(['blocked' => 0]);
        } else {
            $user->update(['blocked' => 1]);
        }

        return back();
    }
}
