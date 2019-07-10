<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\UserVerificationEmail;
use App\Models\Post;
use App\Notifications\NotifyAdmin;
use App\Notifications\VerifyEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Image;

class FrontendController extends Controller
{
    public function index()
    {
//        dd(cache('articles'));
        $data['articles'] = cache('articles', function () {
            return Post::with('category', 'user')
                ->orderByDesc('created_at')
                ->take(100)->get();
        });
        return view('index', $data);
    }

    public function showRegistrationForm()
    {
        return view('registration');
    }

    public function registration(Request $request)
    {
//        try {
//            User::create($data);
//            Mail::to();
//            session()->flash('message', 'Registration Successfully');
//            session()->flash('type', 'success');
//            return redirect()->route('login');
//        } catch (\Exception $e) {
//            session()->flash('message', $e->getMessage());
//            session()->flash('type', 'danger');
//            return redirect()->back();
//        }
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'username' => 'required|min:6',
            'phone_number' => 'required|min:11',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('photo');
        $image_name = rand(11111, 99999) . '_' . $image->getClientOriginalName();
        $photo_image = 'user_image/';
        Image::make($image)->save($photo_image . $image_name);

        $user = User::create([
            'name' => $request->input('full_name'),
            'username' => trim($request->input('username')),
            'phone_number' => trim($request->input('phone_number')),
            'email' => strtolower(trim($request->input('email'))),
            'password' => Hash::make($request->input('password')),
            'photo' => $photo_image . $image_name,
            'email_verified_token' => str_random(32),
        ]);

//        Mail::to($user->email)->queue(new UserVerificationEmail($user));
        $user->notify(new VerifyEmail($user));

        $admin = User::find(28);
        $admin->notify(new NotifyAdmin($user));

        session()->flash('message', 'Registration Successfully');
        session()->flash('type', 'success');
        return redirect()->route('login');
    }

    public function verifyEmail($token)
    {
        if ($token == null) {
            session()->flash('message', 'Invalid token');
            session()->flash('type', 'warning');
            return redirect()->route('login');
        }

        $user = User::where('email_verified_token', $token)->first();
        if ($user == null) {
            session()->flash('message', 'Invalid token');
            session()->flash('type', 'warning');
            return redirect()->route('login');
        }

        $user->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verified_token' => '',
        ]);
        session()->flash('message', 'Yout account is active Successfully.You can login now');
        session()->flash('type', 'success');
        return redirect()->route('login');

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $login_data = $request->except(['_token']);
        if (auth()->attempt($login_data)) {
            $user = auth()->user();
            if ($user->email_verified == 0) {
                session()->flash('message', 'Please verify your account');
                session()->flash('type', 'danger');
                auth()->logout();
                return redirect()->route('login');
            }
            return redirect()->route('dashboard');
        } else {
            session()->flash('message', 'Invalid Username or Password');
            session()->flash('type', 'danger');
            return redirect()->back();
        }

    }

    public function dashboard()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('dashboard', compact('user'));
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function logout()
    {
        auth()->logout();
        session()->flash('message', 'User Logout Successfully');
        session()->flash('type', 'success');
        return redirect()->route('login');
    }
}
