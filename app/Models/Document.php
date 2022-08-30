<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = [
        'file_name'
    ];

    protected $with = ['folder'];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function fileName(): Attribute
    {
        return Attribute::get(
            fn($value) => $this->name . '.' . $this->extension
        );
    }
}
