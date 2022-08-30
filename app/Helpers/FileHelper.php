<?php

namespace App\Helpers;

use App\Models\Document;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHelper
{
    /**
     * Upload the file in the specified folder in the documents directory.
     * @param UploadedFile $file
     * @param Folder|null $folder
     * @return array An array of file path, name and extension
     */
    #[ArrayShape(['path' => "string", 'extension' => "string", 'name' => "string"])]
    public static function processFileUpload(UploadedFile $file, Folder|null $folder): array
    {
        $ext = $file->getClientOriginalExtension();

//        determine directory to store file
        $dir = !is_null($folder) ? "documents/$folder->slug" : 'documents';

        $name = str_replace( ".$ext", '', $file->getClientOriginalName());
        $name = General::generateName(model: new Document(), column: 'name', value: $name, super_folder: $folder?->id);

        //Process new file
        $base_name = $name . '.' . $ext;
        $path = '/'.$dir.'/'. $base_name;
        Storage::disk('public')->putFileAs($dir, $file, $base_name);
        return [
            'path' => $path,
            'extension' => $ext,
            'name' => $name
        ];
    }

    /**
     * Delete an uploaded file from the storage if it is found.
     *
     * @param string|null $file should be the path to that file in the public disk
     */
    public static function deleteUploadedFile(string|null $file = null): void
    {
        if (!is_null($file)) {
            if(Storage::disk('public')->exists($file)){
                Storage::disk('public')->delete($file);
            }
        }
    }

    /**
     *
     * @param string $extension the client original extension from the file
     * @return string either of the DOC_TYPE values in General.php
     */
    public static function getType(string $extension): string
    {
        return match ($extension) {
            'jpeg', 'jpg', 'webp', 'png', 'svg' => 'image',
            'pdf'           => 'pdf',
            'doc', 'docx'   => 'docs',
            'zip'           => 'zip',
            default         => 'others'
        };
    }
}
