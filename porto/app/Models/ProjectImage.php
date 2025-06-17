<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class ProjectImage extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Image-Project')
            ->logOnly(['project_id', 'image_path']) 
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = ['users_id','project_id','image_path'];

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
