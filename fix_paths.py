import os
import re

count = 0
for root, dirs, files in os.walk('resources/views'):
    for file in files:
        if file.endswith('.blade.php'):
            path = os.path.join(root, file)
            with open(path, 'r', encoding='utf-8') as f:
                content = f.read()

            # Find single quotes or double quotes href that starts with / and doesn't have { immediately
            # We want to match: href="/path" or href="/page/{{ $slug }}"
            # We DONT want to match: href="{{ url('/path') }}"
            def replacer(match):
                # match.group(1) is the quote ' or "
                # match.group(2) is the path inside: e.g. /about or /page/{{ $var }}
                inner_path = match.group(2)
                # If it's already using {{, we might be inside a blade directive, let's just make sure it's wrapped
                new_href = f'href="{match.group(1)}{{{{ url(\'{inner_path}\') }}}}{match.group(1)}"'
                return new_href

            # Match href="/something" but negative lookahead for spaces or braces right at the start if that helps... actually wait.
            # \s*href\s*=\s*(["'])(/[^"']*)\1
            
            new_content = content
            for match in re.finditer(r'href\s*=\s*(["\'])(/[^"\']*)\1', content):
                quote = match.group(1)
                full_path = match.group(2)
                # Avoid if it is literally just href="/" (already fine to replace as url('/'))
                repl = f'href={quote}{{{{ url(\'{full_path}\') }}}}{quote}'
                new_content = new_content.replace(match.group(0), repl)

            if content != new_content:
                with open(path, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"Updated {path}")
                count += 1

print(f"Total updated: {count}")
