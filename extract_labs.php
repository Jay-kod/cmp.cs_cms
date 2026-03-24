<?php
$c = file_get_contents('resources/views/admin/page-content/about.blade.php');
$start_pos = strpos($c, '{{-- ── FACILITIES ── --}}');
$end_pos = strpos($c, '{{-- ── OUR FACULTY ── --}}');

if ($start_pos !== false && $end_pos !== false) {
    $sub = substr($c, $start_pos, $end_pos - $start_pos);

    $labs_content = "@extends(\$adminLayout ?? 'layouts.admin')\n"
        . "@section('title', 'Labs Page Content')\n"
        . "@section('header', 'Labs Page Editor')\n\n"
        . "@section('content')\n"
        . "@php\n"
        . "    \$s = fn(string \$key, string \$default = '') => \$settings[\$key] ?? \$default;\n"
        . "    \$facilities  = json_decode(\$s('about_facilities', '[]'), true) ?? [];\n"
        . "@endphp\n\n"
        . "<style>\n"
        . ".pc-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }\n"
        . ".pc-card-header { padding: 1rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none; }\n"
        . ".pc-card-header h3 { margin: 0; font-size: 1rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.6rem; }\n"
        . ".pc-card-body { padding: 1.5rem; display: block; }\n"
        . ".pc-card-body.collapsed { display: none; }\n"
        . "</style>\n\n"
        . "<form action=\"{{ route('admin.page-content.update', \$page) }}\" method=\"POST\" enctype=\"multipart/form-data\">\n"
        . "    @csrf\n    @method('PUT')\n\n"
        . "    <div class=\"pc-card\">\n"
        . "      <div class=\"pc-card-header\" onclick=\"toggleSection(this)\">\n"
        . "          <h3><i class=\"fa-solid fa-server\" style=\"color: var(--color-primary);\"></i> Labs Page Description</h3>\n"
        . "      </div>\n"
        . "      <div class=\"pc-card-body\">\n"
        . "          <div class=\"form-group\">\n"
        . "              <label>Description</label>\n"
        . "              <textarea name=\"about_facilities_desc\" rows=\"3\">{{ \$s('about_facilities_desc', 'Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.') }}</textarea>\n"
        . "          </div>\n"
        . "      </div>\n"
        . "    </div>\n\n"
        . $sub
        . "\n    <div class=\"form-actions\">\n"
        . "        <button type=\"submit\" class=\"btn btn-primary\"><i class=\"fa-solid fa-save\"></i> Save Content</button>\n"
        . "    </div>\n"
        . "</form>\n\n"
        . "<script>\n"
        . "function toggleSection(el) {\n"
        . "    el.nextElementSibling.classList.toggle('collapsed');\n"
        . "}\n\n"
        . "let facIdx = {{ count(\$facilities) }};\n"
        . "function addFacility() {\n"
        . "    const r = document.getElementById('facilitiesRepeater');\n"
        . "    const div = document.createElement('div');\n"
        . "    div.style.cssText = 'border: 1px solid #e2e8f0; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; position: relative;';\n"
        . "    div.innerHTML = `\n"
        . "        <button type=\"button\" onclick=\"this.parentElement.remove()\" style=\"position: absolute; top: 0.5rem; right: 0.5rem; background: none; border: none; color: #ef4444; cursor: pointer;\"><i class=\"fa-solid fa-trash\"></i></button>\n"
        . "        <div style=\"display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;\">\n"
        . "            <div class=\"form-group\"><label>Icon (FA Class)</label><input type=\"text\" name=\"about_facilities[\${facIdx}][icon]\" placeholder=\"fa-solid fa-desktop\"></div>\n"
        . "            <div class=\"form-group\"><label>Lab Name</label><input type=\"text\" name=\"about_facilities[\${facIdx}][name]\"></div>\n"
        . "        </div>\n"
        . "        <div class=\"form-group\"><label>Description</label><textarea name=\"about_facilities[\${facIdx}][description]\" rows=\"2\"></textarea></div>\n"
        . "    `;\n"
        . "    r.appendChild(div);\n"
        . "    facIdx++;\n"
        . "}\n"
        . "</script>\n"
        . "@endsection\n";

    file_put_contents('resources/views/admin/page-content/labs.blade.php', $labs_content);
    echo "Created labs.blade.php\n";

    // Remove from about.blade.php
    $c = substr_replace($c, '', $start_pos, $end_pos - $start_pos);

    // Remove the JS as well
    $js_start = strpos($c, 'let facIdx');
    if ($js_start !== false) {
        $js_end = strpos($c, '}', strpos($c, 'function addFacility()')) + 1;
        if ($js_end !== false) {
            $c = substr_replace($c, '', $js_start, $js_end - $js_start);
        }
    }
    
    file_put_contents('resources/views/admin/page-content/about.blade.php', $c);
    echo "Updated about.blade.php\n";
} else {
    echo "Could not find facilities block.\n";
}
