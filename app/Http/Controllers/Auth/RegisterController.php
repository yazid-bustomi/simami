<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AkademikProfile;
use App\Models\JurusanKampus;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

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


    protected $redirectTo = RouteServiceProvider::HOME;


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
        return Validator::make($data, [
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'kampus' => ['required', 'integer'],
            'jurusan' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'nama_depan' => $data['nama_depan'],
            'nama_belakang' => $data['nama_belakang'],
            'email' => $data['email'],
            'role' => 'mahasiswa',
            'password' => Hash::make($data['password']),
        ]);

          AkademikProfile::create([
            'user_id' => $user->id,
            'jurusan_id' => $data['jurusan'],
            'admin_kampus_id' => $data['kampus'],
        ]);
        Auth::logout();
        return $user;
    }

    public function showRegistrationForm()
    {
        // mengambil semua tabel user beserta relasi ke jurusan yang hanya memiliki role kampus
        $kampus = User::with('jurusanKampus')->where('role', 'kampus')->get();
        // dd($jurusan->toArray());
        return view('auth.register', compact('kampus'));
    }

    public function getJurusan($kampusId)
    {
        $jurusan = JurusanKampus::where('user_id', $kampusId)->get(['id', 'nama_jurusan']);
        return response()->json($jurusan);
    }
}
