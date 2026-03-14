<x-guest-layout>
    <div style="text-align: center; margin-bottom: 2rem;">
        <h2 style="font-size: 1.8rem; margin: 0; color: #1f2937; font-family: 'Outfit', sans-serif;">Welcome Back</h2>
        <p style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem;">Please sign in to your admin account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status style="margin-bottom: 1.5rem; color: #059669; background: #d1fae5; padding: 0.75rem; border-radius: 6px; font-size: 0.9rem; border: 1px solid #10b981;" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Dev credentials hint (remove before production) --}}
        @if(config('app.debug'))
        <div id="devCredentials" style="background: linear-gradient(135deg, #f0fdf4, #ecfdf5); border: 1px solid #86efac; border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; position: relative;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.6rem;">
                <div style="width: 22px; height: 22px; background: #16a34a; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-code" style="font-size: 0.65rem; color: white;"></i>
                </div>
                <span style="font-size: 0.8rem; font-weight: 700; color: #15803d; text-transform: uppercase; letter-spacing: 0.5px;">Dev Credentials</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.3rem; font-size: 0.82rem; font-family: 'Courier New', monospace;">
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #6b7280;">Email:</span>
                    <span style="color: #1f2937; font-weight: 600;">staff@dcms.nsuk.edu.ng</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #6b7280;">Password:</span>
                    <span style="color: #1f2937; font-weight: 600;">password</span>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('email').value='staff@dcms.nsuk.edu.ng'; document.getElementById('password').value='password';" style="margin-top: 0.75rem; width: 100%; padding: 0.45rem; background: #16a34a; color: white; border: none; border-radius: 6px; font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'"><i class="fa-solid fa-bolt" style="margin-right: 4px;"></i> Auto-fill</button>
        </div>
        @endif

        <!-- Email Address -->
        <div style="margin-bottom: 1.25rem;">
            <label for="email" style="display: block; font-weight: 500; font-size: 0.9rem; margin-bottom: 0.5rem; color: #374151;">Email Address</label>
            <div style="position: relative;">
                <div style="position: absolute; left: 14px; top: 12px; color: #9ca3af;"><i class="fa-solid fa-envelope"></i></div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    style="width: 100%; box-sizing: border-box; padding: 0.75rem 0.75rem 0.75rem 2.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.95rem; outline: none; transition: all 0.2s ease; background-color: #f9fafb;"
                    onfocus="this.style.borderColor='var(--color-primary, #16a34a)'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'; this.style.backgroundColor='#ffffff';"
                    onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'; this.style.backgroundColor='#f9fafb';">
            </div>
            <x-input-error :messages="$errors->get('email')" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.5rem; font-weight: 500;" />
        </div>

        <!-- Password -->
        <div style="margin-bottom: 1.5rem;">
            <label for="password" style="display: block; font-weight: 500; font-size: 0.9rem; margin-bottom: 0.5rem; color: #374151;">Password</label>
            <div style="position: relative;">
                <div style="position: absolute; left: 14px; top: 12px; color: #9ca3af;"><i class="fa-solid fa-lock"></i></div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    style="width: 100%; box-sizing: border-box; padding: 0.75rem 2.8rem 0.75rem 2.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.95rem; outline: none; transition: all 0.2s ease; background-color: #f9fafb;"
                    onfocus="this.style.borderColor='var(--color-primary, #16a34a)'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'; this.style.backgroundColor='#ffffff';"
                    onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'; this.style.backgroundColor='#f9fafb';">
                <div style="position: absolute; right: 14px; top: 12px; color: #9ca3af; cursor: pointer; transition: color 0.2s ease;" 
                     onmouseover="this.style.color='var(--color-primary, #16a34a)'" onmouseout="this.style.color='#9ca3af'"
                     onclick="const p = document.getElementById('password'); const i = this.querySelector('i'); if (p.type === 'password') { p.type = 'text'; i.classList.remove('fa-eye'); i.classList.add('fa-eye-slash'); } else { p.type = 'password'; i.classList.remove('fa-eye-slash'); i.classList.add('fa-eye'); }">
                     <i class="fa-solid fa-eye"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.5rem; font-weight: 500;" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <label for="remember_me" style="display: flex; align-items: center; cursor: pointer;">
                <input id="remember_me" type="checkbox" name="remember" style="width: 1rem; height: 1rem; border-radius: 4px; border: 1px solid #d1d5db; accent-color: var(--color-primary, #16a34a); margin-right: 0.5rem;">
                <span style="font-size: 0.9rem; color: #4b5563;">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a style="font-size: 0.9rem; color: var(--color-primary, #16a34a); font-weight: 500; text-decoration: none; transition: color 0.2s ease;" href="{{ route('password.request') }}" onmouseover="this.style.color='var(--color-secondary, #15803d)'" onmouseout="this.style.color='var(--color-primary, #16a34a)'">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" style="width: 100%; background: var(--color-primary, #16a34a); color: white; padding: 0.85rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(22,163,74,0.2); display: flex; align-items: center; justify-content: center; font-family: 'Outfit', sans-serif;"
                onmouseover="this.style.backgroundColor='var(--color-secondary, #15803d)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 15px rgba(22,163,74,0.3)';"
                onmouseout="this.style.backgroundColor='var(--color-primary, #16a34a)'; this.style.transform='none'; this.style.boxShadow='0 4px 10px rgba(22,163,74,0.2)';"
                onmousedown="this.style.transform='translateY(1px)'; this.style.boxShadow='0 2px 5px rgba(22,163,74,0.2)';">
            <i class="fa-solid fa-sign-in-alt" style="margin-right: 0.5rem;"></i> {{ __('Log in') }}
        </button>

        <div style="text-align: center; margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #e5e7eb;">
            <a href="{{ route('super-admin.login.form') }}" style="font-size: 0.82rem; color: #6b7280; text-decoration: none; transition: color 0.2s;"
               onmouseover="this.style.color='var(--color-primary, #16a34a)'" onmouseout="this.style.color='#6b7280'">
                <i class="fa-solid fa-shield-halved" style="margin-right: 4px;"></i> Super Admin Portal
            </a>
        </div>
    </form>
</x-guest-layout>
