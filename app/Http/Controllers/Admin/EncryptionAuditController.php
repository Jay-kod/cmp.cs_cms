<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Components\EncryptionAudit\Models\EncryptionAuditLog;

class EncryptionAuditController extends Controller
{
    /**
     * Display a listing of the encryption and decryption audit logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.encryption-logs.index');
    }
}
