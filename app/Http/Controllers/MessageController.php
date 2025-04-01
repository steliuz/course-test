<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index()
    {
        return view('message');
    }

    public function store(MessageRequest $request)
    {
        $this->messageService->createMessage($request->validated());
        return redirect()->route('messages.index')->with('success', 'Message created successfully.');
    }
}
