Set WshShell = CreateObject("WScript.Shell")

' 0 = Hide the CMD window
' False = Do not wait for the command to finish (run asynchronously)

' 1. Start the queue worker to process heavy image compressions and background jobs silently
WshShell.Run "cmd /c php artisan queue:work --tries=3", 0, False

' 2. (Optional) Start the Laravel task scheduler if you want to set up recurring background reloads in the future
WshShell.Run "cmd /c php artisan schedule:work", 0, False
