<div {{ $attributes->merge(['style' => 'display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;']) }}>
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('university.short_name') }} Logo" style="max-height: 100px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));">
    <span style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; font-weight: 700; color: inherit; letter-spacing: 1px; margin-top: 10px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">{{ config('university.short_name') }}</span>
</div>
