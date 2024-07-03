<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // 验证上传文件
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png'
        ]);

        // 处理文件上传
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/uploads');

            // 获取文件路径和文件名
            $filePath = Storage::url($path);
            $fileName = $file->getClientOriginalName();

            // 保存记录到数据库
            UploadedFile::create([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'uploaded_at' => now()
            ]);

            return response()->json(['message' => 'File uploaded successfully', 'file_path' => $filePath], 200);
        }

        return response()->json(['message' => 'File upload failed'], 500);
    }
}
