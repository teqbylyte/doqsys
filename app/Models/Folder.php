<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function boot() {
        parent::boot();

        static::deleting(function($folder) {
            $folder->documents()->delete();
            if ($folder->subFolders()->exists()) {
                foreach ($folder->subFolders()->get() as $folder) {
                    FileHelper::deleteFolder($folder->slug);
                    $folder->delete();
                }
            }
            $folder->subFolders()->delete();
        });
    }

    //    Query scopes

    public function scopeSlug($query, string|null $value)
    {
        return $query->where('slug', $value);
    }


//    Relationships

    public function subFolders(): HasMany
    {
        return $this->hasMany(self::class)->latest();
    }

    public function superFolder(): BelongsTo
    {
        return $this->belongsTo(self::class, 'folder_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class)->latest()->visible();
    }
}
