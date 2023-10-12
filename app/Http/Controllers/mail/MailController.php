<?php

namespace App\Http\Controllers\mail;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\MailResource;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class MailController extends Controller
{
    use ApiResponder;

    public function get(Request $request) {
        $user = $request->user();
        $orders = $user->orders()->with('company', 'files')->get();
        return $this->apiResponse(MailResource::collection($orders));
    }

    public function download(File $file) {
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        // Create a temporary ZIP file
        $zipFile = storage_path('app/temp/' . uniqid() . '.zip');

        // Initialize the ZipArchive
        $zip = new ZipArchive;

        if ($zip->open($zipFile, ZipArchive::CREATE) === true) {
            // Loop through each file to add it to the ZIP
            foreach ($file->path as $filePath) {
                $fileContent = Storage::disk('Wasabi')->get($filePath);
                $zip->addFromString(basename($filePath), $fileContent);
            }
    
            $zip->close();
        } else {
            return response()->json(['error' => 'Could not create ZIP file.']);
        }

        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
}
