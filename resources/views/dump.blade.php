<?

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ... (your existing methods)

    //Dekan
    public function postLoginDekan(Request $request)
    {
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'dekan') {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('dekan-search');
            } else {
                Auth::logout();
                return redirect()->route('home')->with('warning', 'Invalid user level.');
            }
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    // Sekretariat 2
    public function postLoginSekretariat2(Request $request)
    {
        $credentials = $request->validate([
            'NIP' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'sekretariat2') {
                $request->session()->regenerate();
                $request->session()->put('userLevel', $user->level);
                return redirect()->intended('sekretariat2-search');
            } else {
                Auth::logout();
                return redirect()->route('home')->with('warning', 'Invalid user level.');
            }
        }

        return back()->withErrors([
            'NIP' => 'The provided credentials do not match our records.',
        ])->onlyInput('NIP');
    }

    // ... (similar adjustments for other login methods)
}

<a href="/">Home</a>



                                <!-- Display error messages -->
                                @if($errors->any() || session('warning'))
                                    <div class="alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        @if(session('warning'))
                                            <div class="alert alert-warning">
                                                {{ session('warning') }}
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <!--FORM-->                               