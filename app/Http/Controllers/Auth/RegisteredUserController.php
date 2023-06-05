<?php

namespace App\Http\Controllers\Auth;
use Darryldecode\Cart\Cart;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Illuminate\Validation\Rules;
use Modules\Course\Entities\Course;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Modules\User\Repositories\Repositories\UserRepository;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:35'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "uuid"=>UuidV4::uuid1()
        ]);


        event(new Registered($user));

        Auth::login($user);
        if($request->share_id && $request->camp_id)
        {
            $userRepo=new UserRepository();
            $userRepo->AssignUserToWithCamp($request->share_id,$request->camp_id);
        }
        $cart=\Cart::getcontent();
        if(count($cart) >0)
        {

           \Cart::session(Auth::id())->add($cart->toArray());

        }

return redirect()->intended(RouteServiceProvider::HOME);


}


}
