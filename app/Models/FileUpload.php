<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Storage;

class FileUpload extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function upload(UploadedFile $file, $folder = 'uploads') {
        if($file->isValid()) {
            $path = Storage::disk('public')->put($folder, $file);

            $fileDetails = [
                "name" => $file->getClientOriginalName(),
                "extension" => $file->getClientOriginalExtension(),
                "size" => $file->getSize(),
                "path" => $path,
            ];

            return FileUpload::create($fileDetails);
        }

        return null;
    }

    public function replace(UploadedFile $file, $folder = 'uploads') {
        if($file->isValid()) {
            $path = Storage::disk('public')->put($folder, $file);

            $fileDetails = [
                "name" => $file->getClientOriginalName(),
                "extension" => $file->getClientOriginalExtension(),
                "size" => $file->getSize(),
                "path" => $path,
            ];

            Storage::disk('public')->delete($this->path);
            return $this->update($fileDetails);
        }

        return null;
    }

    public static function retrieveFile($file) {
        return Storage::url($file);
    }
}
