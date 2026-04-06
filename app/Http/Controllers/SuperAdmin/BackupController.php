<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function index()
    {
        // Gather Database Information
        $dbName = config('database.connections.mysql.database');
        
        try {
            $pdo = DB::connection()->getPdo();
            $serverVersion = $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);
            
            // Get Table Count
            $tables = DB::select('SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ?', [$dbName]);
            $tableCount = $tables[0]->count ?? 0;
            
            // Get Database Size in MB
            $sizeQuery = DB::select('SELECT SUM(data_length + index_length) / 1024 / 1024 AS size_mb FROM information_schema.tables WHERE table_schema = ?', [$dbName]);
            $dbSizeMb = isset($sizeQuery[0]->size_mb) ? round($sizeQuery[0]->size_mb, 2) : 0;
            
            $dbStatus = 'Connected (Secure)';
            $isHealthy = true;
        } catch (\Exception $e) {
            $serverVersion = 'Unknown';
            $tableCount = 0;
            $dbSizeMb = 0;
            $dbStatus = 'Connection Failed';
            $isHealthy = false;
        }

        $dbInfo = [
            'name' => $dbName,
            'connection' => config('database.default'),
            'host' => config('database.connections.mysql.host'),
            'port' => config('database.connections.mysql.port'),
            'version' => $serverVersion,
            'tables' => $tableCount,
            'size_mb' => $dbSizeMb,
            'status' => $dbStatus,
            'is_healthy' => $isHealthy
        ];

        return view('super-admin.backup.index', compact('dbInfo'));
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
