@props(['sections'])

<aside class="sidebar-toc" id="sidebar-toc">
    <div class="toc-container">
        <h3><i class="fa-solid fa-list-ul"></i> On This Page</h3>
        <ul class="toc-list">
            @foreach($sections as $id => $title)
                <li><a href="#{{ $id }}">{{ $title }}</a></li>
            @endforeach
        </ul>
    </div>
</aside>

<button class="floating-toc-btn" id="floating-toc-btn">
    <i class="fa-solid fa-list-ul"></i> On This Page
</button>
