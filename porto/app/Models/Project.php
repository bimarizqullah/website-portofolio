<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Project extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Project')
            ->logOnly(['title', 'description', 'project_link', 'tech_stack']) // kolom yang ingin dilog
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }    protected $fillable = [
        'users_id',
        'title',
        'description',
        'project_link',
        'tech_stack'
    ];

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function project() {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }
}
