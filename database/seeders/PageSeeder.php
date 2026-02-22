<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title'     => 'Privacy Policy',
                'slug'      => 'privacy-policy',
                'icon'      => 'fa-solid fa-shield-halved',
                'is_system' => true,
                'is_active' => true,
                'content'   => '<h2>Privacy Policy</h2>
<p><strong>Effective Date:</strong> January 1, 2026</p>

<p>The Department of Computer Science, Nasarawa State University Keffi ("we", "us", or "our") is committed to protecting the privacy of all visitors, students, staff, and stakeholders who access our website and online services.</p>

<h3>1. Information We Collect</h3>
<p>We may collect the following types of information when you interact with our website:</p>
<ul>
    <li><strong>Personal Information:</strong> Name, email address, phone number, and other details you voluntarily submit through contact forms, application portals, or alumni registration.</li>
    <li><strong>Academic Information:</strong> Student ID, programme details, course enrolment, and academic records where applicable.</li>
    <li><strong>Technical Data:</strong> IP address, browser type, device information, and browsing patterns collected automatically via cookies and server logs.</li>
</ul>

<h3>2. How We Use Your Information</h3>
<ul>
    <li>Processing enquiries and application submissions</li>
    <li>Sending departmental announcements, event notifications, and academic updates</li>
    <li>Improving website functionality and user experience</li>
    <li>Maintaining accurate academic and alumni records</li>
    <li>Complying with regulatory and institutional requirements</li>
</ul>

<h3>3. Data Protection</h3>
<p>We implement industry-standard security measures including encryption, access controls, and regular audits to safeguard your personal data against unauthorised access, disclosure, or misuse.</p>

<h3>4. Third-Party Sharing</h3>
<p>Your personal data will not be sold or shared with third parties except when required by law, university policy, or with your explicit consent.</p>

<h3>5. Cookies</h3>
<p>Our website uses cookies to enhance your browsing experience. You may disable cookies in your browser settings, though some features may be affected.</p>

<h3>6. Your Rights</h3>
<p>You have the right to request access to, correction of, or deletion of your personal data. Contact us at <a href="mailto:info@dcms.nsuk.edu.ng">info@dcms.nsuk.edu.ng</a> for any data-related enquiries.</p>

<h3>7. Updates to This Policy</h3>
<p>We may update this privacy policy periodically. Changes will be posted on this page with an updated effective date.</p>',
            ],
            [
                'title'     => 'Terms of Use',
                'slug'      => 'terms-of-use',
                'icon'      => 'fa-solid fa-file-contract',
                'is_system' => true,
                'is_active' => true,
                'content'   => '<h2>Terms of Use</h2>
<p><strong>Last Updated:</strong> January 1, 2026</p>

<p>By accessing and using the Department of Computer Science, Nasarawa State University Keffi website, you agree to be bound by the following terms and conditions.</p>

<h3>1. Acceptance of Terms</h3>
<p>By using this website, you acknowledge that you have read, understood, and agree to these Terms of Use. If you do not agree, please discontinue use immediately.</p>

<h3>2. Intellectual Property</h3>
<p>All content on this website, including text, images, graphics, logos, and software, is the property of the Department of Computer Science, NSUK, and is protected under Nigerian copyright and intellectual property laws. Unauthorised reproduction or distribution is prohibited.</p>

<h3>3. Acceptable Use</h3>
<p>You agree not to:</p>
<ul>
    <li>Use the website for any unlawful, fraudulent, or harmful purpose</li>
    <li>Attempt to gain unauthorised access to any part of the website or its systems</li>
    <li>Upload or transmit viruses, malware, or any harmful code</li>
    <li>Reproduce, modify, or distribute website content without prior written permission</li>
    <li>Impersonate any person or misrepresent your affiliation with any entity</li>
</ul>

<h3>4. Academic Information</h3>
<p>While we strive to ensure accuracy, academic information (programmes, courses, requirements, deadlines) published on this website is subject to change. Official confirmation should always be sought from the department or university registry.</p>

<h3>5. External Links</h3>
<p>This website may contain links to external websites. We are not responsible for the content, privacy practices, or availability of external sites.</p>

<h3>6. Limitation of Liability</h3>
<p>The Department of Computer Science, NSUK, shall not be liable for any direct, indirect, incidental, or consequential damages arising from your use of this website.</p>

<h3>7. Governing Law</h3>
<p>These terms are governed by the laws of the Federal Republic of Nigeria. Any disputes shall be subject to the jurisdiction of Nigerian courts.</p>

<h3>8. Changes to Terms</h3>
<p>We reserve the right to modify these terms at any time. Continued use of the website after changes constitutes acceptance of the revised terms.</p>',
            ],
            [
                'title'     => 'Sitemap',
                'slug'      => 'sitemap',
                'icon'      => 'fa-solid fa-sitemap',
                'is_system' => true,
                'is_active' => true,
                'content'   => '<h2>Sitemap</h2>
<p>Navigate through all the sections of our website using the links below.</p>

<h3><i class="fa-solid fa-house"></i> Main Pages</h3>
<ul>
    <li><a href="/">Home</a> — Welcome page with latest updates and department overview</li>
    <li><a href="/about">About Us</a> — Department history, vision, mission, and facilities</li>
    <li><a href="/academics">Academics</a> — Programme categories, courses, and academic structure</li>
    <li><a href="/people">Faculty</a> — Academic and non-academic staff directory</li>
    <li><a href="/research-news">Blog</a> — News, events, and research publications</li>
    <li><a href="/contact">Contact</a> — Get in touch with the department</li>
</ul>

<h3><i class="fa-solid fa-graduation-cap"></i> Academic Programmes</h3>
<ul>
    <li><a href="/academics#undergraduate-full-time">Undergraduate (Full-Time)</a></li>
    <li><a href="/academics#undergraduate-part-time">Undergraduate (Part-Time)</a></li>
    <li><a href="/academics#masters">Masters</a></li>
    <li><a href="/academics#phd">PhD</a></li>
    <li><a href="/academics#doctorate">Doctorate</a></li>
    <li><a href="/academics#course-structure">Course Structure</a></li>
</ul>

<h3><i class="fa-solid fa-info-circle"></i> About</h3>
<ul>
    <li><a href="/about#our-story">Our Story</a></li>
    <li><a href="/about#vision-mission">Vision & Mission</a></li>
    <li><a href="/about#core-values">Core Values</a></li>
    <li><a href="/about#facilities">Facilities & Labs</a></li>
    <li><a href="/about#our-faculty">Our Faculty</a></li>
</ul>

<h3><i class="fa-solid fa-file-alt"></i> Legal</h3>
<ul>
    <li><a href="/page/privacy-policy">Privacy Policy</a></li>
    <li><a href="/page/terms-of-use">Terms of Use</a></li>
    <li><a href="/page/sitemap">Sitemap</a> (this page)</li>
</ul>',
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
