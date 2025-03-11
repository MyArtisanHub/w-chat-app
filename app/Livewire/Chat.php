<?php

namespace App\Livewire;

use App\Events\MessageSentEvent;
use App\Events\UserTyping;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Reverb\Pulse\Livewire\Messages;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{
    public $user;
    public $message;
    public $senderId;
    public $receiverId;

    public $messages;
    public function mount($userId)
    {
        #livewire event to scroll the last message in bottom with the input box
        $this->dispatch('messages-updated');

        // dd($userId);
        $this->user = $this->getUser($userId);

        $this->senderId = Auth::user()->id;
        $this->receiverId = $userId;

        //get messages depending on the sender and receiver
        $this->messages = $this->getMessages();

        // Read all Messages
        $this->readAllMessages();
    }

    public function render()
    {
        // Read all Messages
        $this->readAllMessages();

        return view('livewire.chat');
    }


    /**
     * Summary of getMessages
     * @return \Illuminate\Database\Eloquent\Collection<int, Message>
     */
    public function getMessages()
    {
        return Message::with('sender:id,name', 'receiver:id,name')
            ->where(function ($query) {
                $query->where('sender_id', $this->senderId)
                    ->where('receiver_id', $this->receiverId);
            })
            ->orWhere(function ($query) {
                $query->where('sender_id', $this->receiverId)
                    ->where('receiver_id', $this->senderId);
            })->get();
    }

    /**
     * Summary of userTyping
     * @return void
     */
    public function userTyping()
    {
        broadcast(new UserTyping($this->senderId, $this->receiverId))->toOthers();
    }


    public function readAllMessages()
    {
        Message::where('sender_id', $this->receiverId)
            ->where('receiver_id', $this->senderId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    /**
     * Function: getUser
     * @param mixed $userId
     * @return \Illuminate\Database\Eloquent\Collection<int, User>
     */
    public function getUser($userId)
    {
        return User::find($userId);
    }

    /**
     * Function:sendMessage
     *
     */
    public function sendMessage()
    {
        // Save the Message
        $sentMessage = $this->saveMessage();

        // Append the latest message
        $this->messages[] = $sentMessage;

        // Broadcast The Message
        broadcast(new MessageSentEvent($sentMessage));

        // reset the input form
        $this->message = null;

        #livewire event to scroll the last message in bottom with the input box
        $this->dispatch('messages-updated');
    }

    #[On('echo-private:chat-channel.{senderId},MessageSentEvent')]
    public function listenMessage($event)
    {
        #convert new message to eloquent
        $newMessage = Message::find($event['message']['id'])->load('sender:id,name', 'receiver:id,name');
        $this->messages[] = $newMessage;
    }

    /**
     * Function: SaveMessage
     *
     */
    public function saveMessage()
    {
        return Message::create([
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
            // 'file_name',
            // 'file_original_name',
            // 'folder_path',
            'is_read' => false
        ]);
    }
}
