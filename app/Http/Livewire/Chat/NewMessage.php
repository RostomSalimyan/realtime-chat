<?php

namespace App\Http\Livewire\Chat;

use App\Room;
use Livewire\Component;
use App\Events\Chat\MessageAdded;

class NewMessage extends Component
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    public $room;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public $body = '';

    /**
     * Undocumented function
     *
     * @param Room $room
     * @return void
     */
    public function mount(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function send()
    {
        $message = $this->room->messages()->create([
            'body' => $this->body,
            'user_id' => auth()->user()->id
        ]);

        $this->emit('message.added', $message->id);

        //dd($message);


        broadcast(new MessageAdded($this->room, $message))->toOthers();

        $this->body = '';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.chat.new-message');
    }
}



//
//namespace App\Http\Livewire\Chat;
//
//use App\Events\Chat\MessageAdded;
//use App\Room;
//use Livewire\Component;
//
//class NewMessage extends Component
//{
//    public $room;
//
//    public $body = '';
//
//    public function mount(Room $room)
//    {
//        $this->room = $room;
//    }
//
//    public function send()
//    {
//        $message = $this->room->messages()->create([
//            'body' => $this->body,
//            'user_id' => auth()->user()->id
//        ]);
//
//        $this->emit('message.added', $message->id);
//
//        broadcast(new MessageAdded($this->room, $message))->toOthers();
//
//        $this->body = '';
//    }
//    public function render()
//    {
//        return view('livewire.chat.new-message');
//    }
//}
