<section style="margin-bottom: 2.5rem;">
    <div class="reveal reveal-up" style="text-align: center;">                                                                              
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 1rem; background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 20px; font-size: 0.75rem; font-weight: 700; color: #16a34a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.8rem;">      
            <i class="fa-solid fa-crosshairs" style="font-size: 0.65rem;"></i> Our Goals                                                                            
        </div>
        <h3 style="font-size: 1.8rem; color: #0f172a; margin: 0 0 0.5rem; font-family: var(--font-heading); font-weight: 800;">What We Strive to Achieve</h3>                                                                                     
        <p style="margin: 0 auto; max-width: 500px; font-size: 0.92rem; color: #64748b; line-height: 1.6;">Our department is guided by four key objectives that shape everything we do.</p>
    </div>

    @php
        $objectives = [
            ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.', 'color' => '#059669', 'light' => '#ecfdf5'],
            ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.', 'color' => '#16a34a', 'light' => '#f0fdf4'],
            ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.', 'color' => '#10b981', 'light' => '#ecfdf5'],
            ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.', 'color' => '#047857', 'light' => '#f0fdf4'],
        ];
    @endphp

    <div class="obj-timeline">
        @foreach($objectives as $i => $obj)
        <div class="obj-row {{ $i % 2 === 0 ? '' : 'obj-row-reverse' }}">                                                                                               
            <div class="obj-number-side">
                <div class="obj-big-num" style="color: {{ $obj['color'] }};">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>                                          
            </div>

            <div class="obj-connector">
                <div class="obj-dot" style="background: {{ $obj['color'] }}; box-shadow: 0 0 0 4px {{ $obj['light'] }}, 0 0 0 5px {{ $obj['color'] }}33;"></div>                                                                                          
                @if($i < count($objectives) - 1)
                <div class="obj-line"></div>
                @endif
            </div>

            <div class="obj-content-side">
                <div class="obj-content-card" style="border-left: 3px solid {{ $obj['color'] }};">
                    <div class="obj-content-header">
                        <div class="obj-icon" style="background: {{ $obj['light'] }}; color: {{ $obj['color'] }};">                                                                     
                            <i class="fa-solid {{ $obj['icon'] }}"></i>                                                                                                             
                        </div>
                        <h4 class="obj-title">{{ $obj['title'] }}</h4>                                                                                                          
                    </div>
                    <p class="obj-text">{{ $obj['text'] }}</p>    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
