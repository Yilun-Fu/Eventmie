<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketFileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'ticket_file' => 'required|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt|max:2048',
        ]);

        if ($request->file('ticket_file')->isValid()) {
            $path = $request->file('ticket_file')->store('ticket_uploads');
            return back()->with('success', '文件上传成功。')->with('file', $path);
        }

        return back()->withErrors(['ticket_file' => '文件上传失败。']);
    }
}
