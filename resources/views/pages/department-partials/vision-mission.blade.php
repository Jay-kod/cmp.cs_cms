<section style="padding: 6rem 0; background: #FFFFFF; position: relative;">
    <div class="container reveal reveal-up">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem;">
            
            <!-- Vision -->
            <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-radius: 16px; padding: 3rem; position: relative; overflow: hidden; border: 1px solid #e2e8f0;">
                <div style="position: absolute; top: -20px; right: -20px; font-size: 8rem; color: rgba(22, 163, 74, 0.03); transform: rotate(15deg);">
                    <i class="fa-solid fa-eye"></i>
                </div>
                
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; position: relative; z-index: 2;">
                    <div style="width: 54px; height: 54px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--color-primary); box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <i class="fa-solid fa-lightbulb"></i>
                    </div>
                    <h3 style="margin: 0; font-size: 1.8rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Our Vision</h3>
                </div>
                
                <p style="margin: 0; font-size: 1.1rem; line-height: 1.7; color: #475569; position: relative; z-index: 2;">
                    {{ $gs("{$deptPrefix}_vision", "To be a leading center of excellence in computing research and education, producing top-tier graduates who innovate and lead in the global IT sector.") }}
                </p>
            </div>

            <!-- Mission -->
            <div style="background: linear-gradient(135deg, #f8fafc, #f1f5f9); border-radius: 16px; padding: 3rem; position: relative; overflow: hidden; border: 1px solid #e2e8f0;">
                <div style="position: absolute; top: -20px; right: -20px; font-size: 8rem; color: rgba(22, 163, 74, 0.03); transform: rotate(-15deg);">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; position: relative; z-index: 2;">
                    <div style="width: 54px; height: 54px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--color-accent); box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 style="margin: 0; font-size: 1.8rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Our Mission</h3>
                </div>
                
                <p style="margin: 0; font-size: 1.1rem; line-height: 1.7; color: #475569; position: relative; z-index: 2;">
                    {{ $gs("{$deptPrefix}_mission", "To provide rigorous, industry-relevant academic programs and cultivate a collaborative environment that encourages practical problem-solving and lifelong learning.") }}
                </p>
            </div>
            
        </div>
    </div>
</section>