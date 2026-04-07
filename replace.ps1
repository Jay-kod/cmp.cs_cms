$content = Get-Content 'resources/views/layouts/admin.blade.php' -Raw
$replacement = Get-Content 'nav_replacement.txt' -Raw
$newContent = [regex]::replace($content, '(?s)<nav.*?</nav>', $replacement)
Set-Content -Path 'resources/views/layouts/admin.blade.php' -Value $newContent -NoNewline
