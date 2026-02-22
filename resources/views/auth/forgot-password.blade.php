<x-guest-layout>
    <div style="text-align: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.6rem; margin: 0; color: #1f2937; font-family: 'Outfit', sans-serif;">Reset Password</h2>
        <p style="color: #6b7280; font-size: 0.9rem; margin-top: 0.5rem; line-height: 1.5;">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status style="margin-bottom: 1.5rem; color: #059669; background: #d1fae5; padding: 0.75rem; border-radius: 6px; font-size: 0.9rem; border: 1px solid #10b981;" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div style="margin-bottom: 2rem;">
            <label for="email" style="display: block; font-weight: 500; font-size: 0.9rem; margin-bottom: 0.5rem; color: #374151;">Email Address</label>
            <div style="position: relative;">
                <div style="position: absolute; left: 14px; top: 12px; color: #9ca3af;"><i class="fa-solid fa-envelope"></i></div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    style="width: 100%; box-sizing: border-box; padding: 0.75rem 0.75rem 0.75rem 2.8rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.95rem; outline: none; transition: all 0.2s ease; background-color: #f9fafb;"
                    onfocus="this.style.borderColor='var(--color-primary, #16a34a)'; this.style.boxShadow='0 0 0 3px rgba(22, 163, 74, 0.1)'; this.style.backgroundColor='#ffffff';"
                    onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'; this.style.backgroundColor='#f9fafb';">
            </div>
            <x-input-error :messages="$errors->get('email')" style="color: #dc2626; font-size: 0.8rem; margin-top: 0.5rem; font-weight: 500;" />
        </div>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <button type="submit" style="width: 100%; background: var(--color-primary, #16a34a); color: white; padding: 0.85rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 10px rgba(22,163,74,0.2); display: flex; align-items: center; justify-content: center; font-family: 'Outfit', sans-serif;"
                    onmouseover="this.style.backgroundColor='var(--color-secondary, #15803d)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 15px rgba(22,163,74,0.3)';"
                    onmouseout="this.style.backgroundColor='var(--color-primary, #16a34a)'; this.style.transform='none'; this.style.boxShadow='0 4px 10px rgba(22,163,74,0.2)';"
                    onmousedown="this.style.transform='translateY(1px)'; this.style.boxShadow='0 2px 5px rgba(22,163,74,0.2)';">
                <i class="fa-solid fa-paper-plane" style="margin-right: 0.5rem;"></i> {{ __('Email Password Reset Link') }}
            </button>
            <a href="{{ route('login') }}" style="text-align: center; font-size: 0.9rem; color: #6b7280; text-decoration: none; font-weight: 500;" onmouseover="this.style.color='var(--color-primary, #16a34a)'" onmouseout="this.style.color='#6b7280'">Back to login</a>
        </div>
    </form>
</x-guest-layout>
