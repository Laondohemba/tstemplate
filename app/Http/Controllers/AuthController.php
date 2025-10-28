<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //display form to create account
    public function create(Request $request)
    {
        $preSelectedRole = $request->get('role', 'buyer');
        return view('user.create', compact('preSelectedRole'));
    }

    // collect user data and store in db
    public function store(Request $request)
    {
        $role = $request->input('role');
        if ($role === 'buyer') {
            $validated = $request->validate([
                'buyer_name' => 'required|string|max:255',
                'buyer_email'    => 'required|email|unique:users,email',
                'buyer_phone'    => 'required',
                'buyer_password' => 'required|min:8|confirmed',
                'buyer_location' => 'required|string|max:255',
            ]);

            // create buyer
            $user = User::create([
                'slug'     => substr(md5(uniqid(time(), true)), 0, 32),
                'name'     => $validated['buyer_name'],
                'email'    => $validated['buyer_email'],
                'phone'    => $validated['buyer_phone'],
                'password' => bcrypt($validated['buyer_password']),
                'role'     => 'buyer',
                'location' => $validated['buyer_location'],
            ]);
        } elseif ($role === 'vendor') {
            $validated = $request->validate([
                'business_name'      => 'required|string|max:255',
                'contactPersonName' => 'required|string|max:255',
                'vendor_email'             => 'required|email|unique:users,email',
                'vendor_phone'             => 'required',
                'vendor_password'          => 'required|min:8|confirmed', // use password_confirmation
                'vendor_location'          => 'required|string|max:255',
            ]);

            $user = User::create([
                'slug'     => substr(md5(uniqid(time(), true)), 0, 32),
                'business_name' => $validated['business_name'],
                'name'  => $validated['contactPersonName'],
                'email'         => $validated['vendor_email'],
                'phone'         => $validated['vendor_phone'],
                'password'      => bcrypt($validated['vendor_password']),
                'role'          => 'vendor',
                'location'      => $validated['vendor_location'],
            ]);
        } elseif ($role === 'service_provider') {
            $validated = $request->validate([
                'sp_company_name'      => 'required|string|max:255',
                'sp_contact_person_name' => 'required|string|max:255',
                'sp_email'             => 'required|email|unique:users,email',
                'sp_phone'             => 'required',
                'sp_password'          => 'required|min:8|confirmed',
                'sp_location'          => 'required|string|max:255',
                'sp_service_category'  => 'required|exists:service_categories,id',
            ]);

            $user = User::create([
                'slug'     => substr(md5(uniqid(time(), true)), 0, 32),
                'business_name' => $validated['sp_company_name'],
                'name'  => $validated['sp_contact_person_name'],
                'email'         => $validated['sp_email'],
                'phone'         => $validated['sp_phone'],
                'password'      => bcrypt($validated['sp_password']),
                'role'          => 'service_provider',
                'location'      => $validated['sp_location'],
                'service_category_id' => $validated['sp_service_category'],
            ]);
        }

        // log them in or redirect as needed
        Auth::login($user);
        return redirect()->route('user.dashboard')->with('success', 'Account created successfully');
    }

    // display login form
    public function loginForm()
    {
        return view('user.login');
    }

    // login user
    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($user, $request->remember)) {
            return redirect()->intended('dashboard')->with('success', 'Login successful');;
        } else {
            return back()->withErrors([
                'loginfailed' => 'Invalid email or password! Note that passwords are case sensitive.'
            ]);
        }
    }

    // logout user
    public function logout()
    {
        $user = request()->user();
        Auth::logout($user);

        return redirect()->route('login')->with('success', 'Logout successful');;
    }
}
