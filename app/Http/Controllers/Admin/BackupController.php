<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.backup.index');
    }

    public function download()
    {
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $dbHost = config('database.connections.mysql.host');

        $fileName = 'dcms_backup_' . date('Y-m-d_H-i-s') . '.sql';
        $backupDir = storage_path('app/backups');

        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $filePath = $backupDir . '/' . $fileName;
        
        // Using XAMPP's mysqldump
        $mysqldumpPath = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

        $command = "\"$mysqldumpPath\" --host=\"$dbHost\" --user=\"$dbUser\"";
        if (!empty($dbPass)) {
            $command .= " --password=\"$dbPass\"";
        }
        $command .= " \"$dbName\" > \"$filePath\"";

        exec($command, $output, $returnVar);

        if ($returnVar === 0 && File::exists($filePath)) {
            return response()->download($filePath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Database backup failed. Please check system configurations.');
    }
}
