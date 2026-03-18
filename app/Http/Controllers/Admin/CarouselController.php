<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::ordered()->get();
        return view('admin.carousel.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.carousel.form', ['slide' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'overlay_color' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['overlay_color'] = $validated['overlay_color'] ?: 'rgba(0,0,0,0.5)';

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('carousel', 'public');
        }

        CarouselSlide::create($validated);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel slide added successfully.');
    }

    public function edit(CarouselSlide $carousel)
    {
        return view('admin.carousel.form', ['slide' => $carousel]);
    }

    public function update(Request $request, CarouselSlide $carousel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:1000',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'overlay_color' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['overlay_color'] = $validated['overlay_color'] ?: 'rgba(0,0,0,0.5)';

        if ($request->hasFile('image')) {
            // Delete old image
            if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
                Storage::disk('public')->delete($carousel->image);
            }
            $validated['image'] = $request->file('image')->store('carousel', 'public');
        }

        $carousel->update($validated);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel slide updated successfully.');
    }

    public function destroy(CarouselSlide $carousel)
    {
        if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
            Storage::disk('public')->delete($carousel->image);
        }

        $carousel->delete();

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel slide deleted successfully.');
    }

    /**
     * Footer background management.
     */
    public function footerBg()
    {
        $setting = \App\Models\DepartmentSetting::where('key', 'footer_bg_image')->first();
        $footerBg = $setting ? $setting->value : 'site/footer-bg.jpg';
        return view('admin.carousel.footer-bg', compact('footerBg'));
    }

    public function updateFooterBg(Request $request)
    {
        $request->validate([
            'footer_bg' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('footer_bg')) {
            $oldSetting = \App\Models\DepartmentSetting::where('key', 'footer_bg_image')->first();
            if ($oldSetting && $oldSetting->value && $oldSetting->value !== 'site/footer-bg.jpg') {
                if (Storage::disk('public')->exists($oldSetting->value)) {
                    Storage::disk('public')->delete($oldSetting->value);
                }
            }

            $path = $request->file('footer_bg')->store('site', 'public');

            \App\Models\DepartmentSetting::updateOrCreate(
                ['key' => 'footer_bg_image'],
                ['value' => $path]
            );

            return redirect()->route('admin.carousel.footer-bg')
                ->with('success', 'Footer background updated successfully.');
        }

        return redirect()->route('admin.carousel.footer-bg')
            ->with('error', 'Please select an image to upload.');
    }

    /**
     * Page Heroes management.
     */
    public function pageHeroes()
    {
        $heroes = [
            'about' => \App\Models\DepartmentSetting::where('key', 'hero_about')->first()?->value,
            'academics' => \App\Models\DepartmentSetting::where('key', 'hero_academics')->first()?->value,
            'blog' => \App\Models\DepartmentSetting::where('key', 'hero_blog')->first()?->value,
            'contact' => \App\Models\DepartmentSetting::where('key', 'hero_contact')->first()?->value,
        ];

        return view('admin.carousel.page-heroes', compact('heroes'));
    }

    public function updatePageHeroes(Request $request)
    {
        $request->validate([
            'hero_about' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hero_academics' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hero_blog' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hero_contact' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $anyFile = false;
        foreach (['about', 'academics', 'blog', 'contact'] as $page) {
            $key = "hero_{$page}";
            if ($request->hasFile($key)) {
                $anyFile = true;
                $oldSetting = \App\Models\DepartmentSetting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    if (Storage::disk('public')->exists($oldSetting->value)) {
                        Storage::disk('public')->delete($oldSetting->value);
                    }
                }

                $path = $request->file($key)->store("site/heroes", 'public');

                \App\Models\DepartmentSetting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $path]
                );
            }
        }

        if ($anyFile) {
            return redirect()->route('admin.carousel.page-heroes')
                ->with('success', 'Page heroes updated successfully.');
        }

        return redirect()->route('admin.carousel.page-heroes')
            ->with('error', 'Please select an image to upload.');
    }
}
