<?php

$file = 'resources/views/pages/event-show.blade.php';
$content = file_get_contents($file);

// Replace variables
$content = str_replace('$article', '$event', $content);
$content = str_replace("route('research-news')", "route('events.index')", $content);
$content = str_replace("route('research-news.show'", "route('events.show'", $content);
$content = str_replace('Back to News & Events', 'Back to Events', $content);
$content = str_replace('Article Details', 'Event Details', $content);
$content = str_replace('Related News', 'Upcoming Events', $content);

// In Javascript
$content = str_replace("'/reactions'", "'/events/{{ \$event->id }}/reactions'", $content);
$content = str_replace("'/comments'", "'/events/{{ \$event->id }}/comments'", $content);
$content = str_replace("'{{ \$article->id }}'", "'{{ \$event->id }}'", $content);

// Update action endpoints in Javascript
$content = preg_replace("/fetch\(`\/news\/\$\{newsId\}\/reactions`([^)]*)\)/is", "fetch(`/events/\${newsId}/reactions`$1)", $content);
$content = preg_replace("/fetch\(`\/news\/\$\{newsId\}\/comments`([^)]*)\)/is", "fetch(`/events/\${newsId}/comments`$1)", $content);

// Fix the ID naming in JS just in case we used `newsId` somewhere
$content = str_replace('const newsId = {{ $event->id }};', 'const eventId = {{ $event->id }};', $content);
$content = str_replace('${newsId}', '${eventId}', $content);

// Put the RSVP form below the event body
$rsvpForm = <<<HTML
            <!-- RSVP Section -->
            <div class="nd-engage-bar" style="margin-top: 2rem;">
                <hr class="nd-divider">
                <div class="nd-comments-header" style="margin-bottom: 1rem;">
                    <i class="fa-solid fa-calendar-check" style="color: var(--color-primary); font-size: 1.1rem;"></i>
                    <h3>Will you be attending?</h3>
                </div>
                <div class="nd-comment-form">
                    <form method="POST" action="{{ route('event.rsvp.store', \$event->id) }}">
                        @csrf
                        <div class="nd-cform-row">
                            <input type="text" name="name" placeholder="Your Name" maxlength="150" required class="nd-cform-input">
                            <input type="email" name="email" placeholder="Your Email" maxlength="150" required class="nd-cform-input">
                            <input type="text" name="phone" placeholder="Your Phone (optional)" maxlength="20" class="nd-cform-input">
                        </div>
                        <div class="nd-cform-footer" style="justify-content: flex-start; margin-top: 1rem;">
                            <button type="submit" class="nd-cform-submit">
                                <i class="fa-solid fa-check" style="font-size: 0.78rem;"></i> I'm coming! (RSVP)
                            </button>
                        </div>
                        @if(session('success'))
                            <div class="nd-cform-alert" style="display:block; background: #ecfdf5; color: #047857; margin-top:1rem;">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(\$errors->any())
                            <div class="nd-cform-alert" style="display:block; background: #fef2f2; color: #b91c1c; margin-top:1rem;">
                                {{ \$errors->first() }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>

HTML;

// Insert RSVP form right above Comments section 
$content = str_replace('<!-- Comments -->', $rsvpForm . "\n            <!-- Comments -->", $content);

// Also need to modify Sidebar for Event metadata (date, time, venue, etc)
$sidebarCardOld = <<<HTML
        <div data-aos="fade-up" class="nd-sidebar-card">
            <h4><i class="fa-solid fa-circle-info"></i> Event Details</h4>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-solid fa-tag"></i></div>
                <span>{{ \$event->category }}</span>
            </div>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-regular fa-calendar"></i></div>
                <span>{{ \$publishDate->format('F j, Y') }}</span>
            </div>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-regular fa-clock"></i></div>
                <span>{{ \$readTime }} min read</span>
            </div>
            @if(\$event->author)
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-solid fa-user-pen"></i></div>
                <span>{{ \$event->author->name }}</span>
            </div>
            @endif
        </div>
HTML;

$sidebarCardNew = <<<HTML
        <div data-aos="fade-up" class="nd-sidebar-card">
            <h4><i class="fa-solid fa-circle-info"></i> Event Details</h4>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-regular fa-calendar-days"></i></div>
                <span>{{ \Carbon\Carbon::parse(\$event->date)->format('F j, Y') }}</span>
            </div>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-regular fa-clock"></i></div>
                <span>{{ \Carbon\Carbon::parse(\$event->time)->format('h:i A') }}</span>
            </div>
            <div class="nd-detail-row">
                <div class="nd-detail-icon"><i class="fa-solid fa-location-dot"></i></div>
                <span>{{ \$event->location }}</span>
            </div>
        </div>
HTML;

$content = str_replace($sidebarCardOld, $sidebarCardNew, $content);

file_put_contents($file, $content);
echo "Updated event-show.blade.php";
