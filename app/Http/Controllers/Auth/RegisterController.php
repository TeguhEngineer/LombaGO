<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:100'],
                'jk' => ['required', 'in:Laki-laki,Perempuan'],
                'no_tlp' => ['required', 'regex:/^[0-9]{11,13}$/'],
                'asal_sekolah' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'jk.required' => 'Pilih jenis kelamin.',
                'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
                'no_tlp.regex' => 'Nomor telepon harus 11-13 digit.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
                'password.min' => 'Password minimal :min karakter.',
            ],
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'jk' => $data['jk'],
            'no_tlp' => $data['no_tlp'],
            'asal_sekolah' => $data['asal_sekolah'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }
}
