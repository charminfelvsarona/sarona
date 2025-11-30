<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'action', 'ip_address', 'mac_address', 'created_at'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    // 🛑 Disable auto timestamps if your table has no updated_at column
    
}
