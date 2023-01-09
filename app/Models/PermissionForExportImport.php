<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionForExportImport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = "permission_for_export_import";

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
