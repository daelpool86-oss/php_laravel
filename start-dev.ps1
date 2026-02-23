# Start the Laravel dev server and the SayHello background job

Write-Host "Starting Laravel dev server..."
Start-Process -FilePath 'php' -ArgumentList 'artisan','serve' -NoNewWindow

Start-Sleep -Seconds 2

Write-Host "Starting SayHello background job (logs -> sayhello.log)..."
Start-Job -ScriptBlock { php artisan say:hello > sayhello.log 2>&1 }

Write-Host "Done. Visit http://127.0.0.1:8000/"
Write-Host "Check sayhello.log for output." 
