<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemLog;
use App\Models\User;
use Carbon\Carbon;

class SystemLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $actions = [
            'login' => 'User logged in',
            'logout' => 'User logged out',
            'created' => 'Created new record',
            'updated' => 'Updated existing record',
            'deleted' => 'Deleted a record',
            'failed_login' => 'Failed login attempt',
            'report_download' => 'Downloaded system report'
        ];
        
        $entities = ['App\Models\Staff', 'App\Models\News', 'App\Models\Course', 'App\Models\Event', null];
        $ips = ['192.168.1.1', '10.0.0.45', '127.0.0.1', '172.16.0.12', '104.28.14.8'];
        $agents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Safari/605.1.15',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1'
        ];

        for ($i = 0; $i < 150; $i++) {
            $actionKey = array_rand($actions);
            $entityType = $actionKey === 'created' || $actionKey === 'updated' || $actionKey === 'deleted' 
                ? $entities[array_rand($entities)] 
                : null;
                
            SystemLog::create([
                'user_id' => !empty($users) && rand(1, 100) > 10 ? $users[array_rand($users)] : null,
                'action' => $actionKey,
                'entity_type' => $entityType,
                'entity_id' => $entityType ? rand(1, 50) : null,
                'description' => $actions[$actionKey] . ($entityType ? ' in ' . class_basename($entityType) : ''),
                'ip_address' => $ips[array_rand($ips)],
                'user_agent' => $agents[array_rand($agents)],
                'created_at' => Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
