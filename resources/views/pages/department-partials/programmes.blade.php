<section style="padding: 6rem 0; background: #F0F9F3; position: relative;">
    <div class="container reveal reveal-up">
        <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
            <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Programmes Offered</h2>
        </div>
        <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2.5rem; border-radius: 2px;"></div>

        <div style="font-size: 1.05rem; line-height: 1.8; color: #475569; margin-bottom: 2rem;">
            {!! nl2br(e($gs("{$deptPrefix}_programmes_intro", "The department offers a variety of academic programs tailored to suit different levels of computing maturity, ranging from undergraduate degrees to advanced research programs."))) !!}
        </div>

        @php
            $programmesList = $gs("{$deptPrefix}_programmes_list", "B.Sc. in {$departmentName}\nM.Sc. in {$departmentName}\nPh.D. in {$departmentName}");
            $programmesItems = explode("\n", trim($programmesList));
        @endphp

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach($programmesItems as $item)
                @if(trim($item))
                    <div style="background: #ffffff; padding: 1.5rem 2rem; border-radius: 12px; border: 1px solid rgba(22,163,74,0.1); display: flex; align-items: center; gap: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: transform 0.3s ease;">
                        <i class="fa-solid fa-check-circle" style="color: var(--color-primary); font-size: 1.2rem;"></i>
                        <span style="font-weight: 600; color: #1e293b; font-size: 1.1rem;">{{ trim($item) }}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>