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


/**
 * Set the value to make hidden documents appear or not for the auth user session
 */
function setHidden(): void
{
    $value = showHidden();
    session()->put('show_hidden', !$value);
}

/**
 * Check if hidden documents can be show or not in the app for the auth user session
 * @return bool
 */
function showHidden(): bool
{
    return session()->has('show_hidden') && session()->get('show_hidden');
}

/**
 * Excerpt
 * @param $html
 * @param $limit
 * @param $prefix
 */
if (! function_exists('excerpt')) {
    function excerpt($html, $limit, $prefix = ' ...') {
        if (strlen($html) > $limit) {
            return substr($html, 0, $limit) . $prefix;
        }

        return $html;
    }
}
