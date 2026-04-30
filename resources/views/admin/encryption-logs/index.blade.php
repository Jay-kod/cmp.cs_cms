@extends($adminLayout ?? 'layouts.admin') 

@section('content')
<div class="px-4 pb-8 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-gray-900">Encryption Activity & Audits</h1>
            <p class="mt-2 text-sm text-gray-700">A detailed log of encryption, decryption, and key-rotation activities performed across your platform.</p>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="mt-6 mb-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white px-4 py-5 shadow-sm sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Encryptions</dt>
            <dd class="mt-1 text-3xl font-bold tracking-tight text-emerald-600 border-b border-emerald-100 pb-2">{{ \App\Components\EncryptionAudit\Models\EncryptionAuditLog::where('action', 'encrypted')->count() }}</dd>
            <p class="text-xs text-gray-400 mt-2">Data securely locked</p>
        </div>
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white px-4 py-5 shadow-sm sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Decryptions</dt>
            <dd class="mt-1 text-3xl font-bold tracking-tight text-yellow-600 border-b border-yellow-100 pb-2">{{ \App\Components\EncryptionAudit\Models\EncryptionAuditLog::where('action', 'decrypted')->count() }}</dd>
            <p class="text-xs text-gray-400 mt-2">Data accessed/viewed</p>
        </div>
        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white px-4 py-5 shadow-sm sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Recent Activity</dt>
            <dd class="mt-1 text-3xl font-bold tracking-tight text-blue-600 border-b border-blue-100 pb-2">{{ \App\Components\EncryptionAudit\Models\EncryptionAuditLog::where('created_at', '>=', now()->subDays(7))->count() }}</dd>
            <p class="text-xs text-gray-400 mt-2">Events in the last 7 days</p>
        </div>
    </div>

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Model</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Field</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Accessed By</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">IP Address</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @php
                                $logs = \App\Components\EncryptionAudit\Models\EncryptionAuditLog::with('accessor')->latest()->paginate(20);
                            @endphp
                            
                            @forelse($logs as $log)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $log->model }} <span class="text-gray-400 text-xs ml-1">(ID: {{ $log->record_id }})</span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">{{ $log->field }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if($log->action === 'encrypted')
                                            <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">Encrypted (Saved)</span>
                                        @elseif($log->action === 'decrypted')
                                            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">Decrypted (Viewed)</span>
                                        @else
                                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">{{ ucfirst($log->action) }}</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-600">
                                        {{ $log->accessor ? $log->accessor->name : 'System/Anonymous' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 font-mono text-xs">
                                        {{ $log->ip_address ?? 'N/A' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $log->created_at->format('M d, Y - h:i A') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-gray-500 text-sm">No encryption activity recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    @if($logs->hasPages())
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection