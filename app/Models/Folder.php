<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Folder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public static function boot() {
        parent::boot();

        static::deleting(function($folder) {
            $folder->documents()->delete();
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
        return $this->hasMany(self::class);
    }

    public function superFolder(): BelongsTo
    {
        return $this->belongsTo(self::class, 'folder_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
