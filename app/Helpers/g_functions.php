<?php

function getFileIcon(string $type): string
{
    return match ($type) {
        'image' => 'image',
        'pdf'   => 'picture_as_pdf',
        'docs'   => 'description',
        'zip'   => 'folder_zip',
        default => 'file_present'
    };
}

function dateFormat(\Carbon\Carbon|null $date, bool $has_time = true): string
{
    $date = $date ?? now();

    return $has_time ? $date->format('d/m/Y m:s') : $date->format('d/m/Y');
}
