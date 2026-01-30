<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
  public function showRegister(){
  return view("auth.register");
   }

   public function showLogin(){
    return view("auth.login");
   }

 


    public function register(Request $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => 'member', 
        ]);

         
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Compte créé avec success! 👋');
    }
 
    public function login(Request $request)
    { 
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();  
            return redirect()->intended('/')->with('success', 'Mre7ba bik tani! 👋');
        }
 
        return back()->withErrors([
            'email' => 'email ou password invalide.',
        ])->onlyInput('email');
    }

     
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


