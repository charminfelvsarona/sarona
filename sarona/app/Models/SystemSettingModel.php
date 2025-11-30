<?php namespace App\Models;

use CodeIgniter\Model;

class SystemSettingModel extends Model
{
    protected $table = 'system_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['system_mode', 'updated_at'];
}
