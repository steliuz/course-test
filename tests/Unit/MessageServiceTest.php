<?php

namespace Tests\Unit;

use App\Models\Message;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Student;
use App\Services\MessageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class MessageServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_message()
    {
        $service = new MessageService();
        $data = [
            'title' => 'Test Message',
            'content' => 'This is a test message.',
            'type' => 'Todos',
        ];

        $message = $service->createMessage($data);

        $this->assertDatabaseHas('message', [
            'title' => 'Test Message',
            'content' => 'This is a test message.',
        ]);
    }

    public function test_get_all_messages()
    {
        $service = new MessageService();

        Message::factory()->count(3)->create();

        $messages = $service->getAllMessages();

        $this->assertCount(3, $messages);
    }

    public function test_get_user_messages()
    {
        $service = new MessageService();
        $user = User::factory()->create(['role' => 'father']);
        $message = Message::factory()->create();

        $message->users()->attach($user->id, [
            'type' => 'Todos',
            'course_id' => null,
            'age' => null,
        ]);

        $userMessages = $service->getUserMessages($user);

        $this->assertCount(1, $userMessages);
        $this->assertEquals($message->id, $userMessages->first()->id);
    }

    public function test_resend_message()
    {
        $service = new MessageService();
        $message = Message::factory()->create();
        $user = User::factory()->create(['role' => 'father']);

        $message->users()->attach($user->id, [
            'type' => 'Todos',
            'course_id' => null,
            'age' => null,
        ]);

        Log::shouldReceive('info')->twice();

        $resendMessage = $service->resendMessage($message->id);

        $this->assertDatabaseHas('message_user', [
            'message_id' => $message->id,
            'user_id' => $user->id,
        ]);
    }
}
