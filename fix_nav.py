import re

path = 'resources/views/components/nav/layer-2.blade.php'
with open(path, 'r', encoding='utf-8') as f:
    html = f.read()

vars_logic = '''        @php
            \ = request()->is('/');
            \ = request()->is('about*') || request()->is('nacos-presidents*');
            \ = request()->is('academics*') || request()->is('programmes*') || request()->is('pages/programmes*') || request()->is('pages/sub-departments*') || request()->is('sub-departments*') || request()->is('siwes*') || request()->is('projects*');
            \ = request()->is('people*');
            \ = request()->is('research-news*') || request()->is('events*') || request()->is('research-innovations*') || request()->is('pages/academic-calendar*');
        @endphp
        <!-- Desktop Nav -->'''

html = html.replace('        <!-- Desktop Nav -->', vars_logic, 1)

html = html.replace(\"request()->is('/')\", \"\\")
html = html.replace(\"request()->is('about*')\", \"\\")
html = html.replace(\"request()->is('academics*')\", \"\\")
html = html.replace(\"request()->is('people*')\", \"\\")
html = html.replace(\"request()->is('research-news*') || request()->is('events*')\", \"\\")

with open(path, 'w', encoding='utf-8') as f:
    f.write(html)
