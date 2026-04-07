<!-- SUB-DEPARTMENTS OVERVIEW -->
<section data-aos="fade-up" style="padding: 6rem 0; background-color: #F0F9F3; position: relative;">
    <div class="container" data-aos="fade-up">
        <div class="" style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_subdepts_badge','Overview') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_subdepts_title','Our Departments') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gs('home_subdepts_subtitle','The faculty incorporates three dynamic departments offering specialized programmes.') }}</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Dept 1 -->
            <div style="background: white; border-radius: 16px; padding: 2.5rem; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s; cursor:pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'" onclick="window.location.href='{{ route('department.show', 'computer-science') }}'">
                <div style="width: 70px; height: 70px; margin: 0 auto 1.5rem; background: rgba(22,163,74,0.1); color: var(--color-primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    <i class="{{ $gs('home_subdept_1_icon','fa-solid fa-laptop-code') }}"></i>
                </div>
                <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_subdept_1_title','Computer Science') }}</h3>
                <p style="color: #64748b; line-height: 1.6; margin-bottom: 0;">{{ $gs('home_subdept_1_desc','Focuses on software engineering, artificial intelligence, algorithms, and computing theories.') }}</p>
            </div>
            
            <!-- Dept 2 -->
            <div style="background: white; border-radius: 16px; padding: 2.5rem; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s; cursor:pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'" onclick="window.location.href='{{ route('department.show', 'cyber-security') }}'">
                <div style="width: 70px; height: 70px; margin: 0 auto 1.5rem; background: rgba(22,163,74,0.1); color: var(--color-primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    <i class="{{ $gs('home_subdept_2_icon','fa-solid fa-shield-halved') }}"></i>
                </div>
                <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_subdept_2_title','Cyber Security') }}</h3>
                <p style="color: #64748b; line-height: 1.6; margin-bottom: 0;">{{ $gs('home_subdept_2_desc','Specialized training in network security, ethical hacking, digital forensics, and data protection.') }}</p>
            </div>
            
            <!-- Dept 3 -->
            <div style="background: white; border-radius: 16px; padding: 2.5rem; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s; cursor:pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'" onclick="window.location.href='{{ route('department.show', 'data-science') }}'">
                <div style="width: 70px; height: 70px; margin: 0 auto 1.5rem; background: rgba(22,163,74,0.1); color: var(--color-primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    <i class="{{ $gs('home_subdept_3_icon','fa-solid fa-database') }}"></i>
                </div>
                <h3 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_subdept_3_title','Data Science') }}</h3>
                <p style="color: #64748b; line-height: 1.6; margin-bottom: 0;">{{ $gs('home_subdept_3_desc','Advanced studies in big data analytics, machine learning, and statistical modeling for complex problems.') }}</p>
            </div>
        </div>
    </div>
</section>
