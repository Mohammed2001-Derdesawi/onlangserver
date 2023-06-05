<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\MessageRequest;
use Modules\User\Http\Requests\UserMessageRequest;
use Modules\User\Repositories\Interfaces\MessageInterface;

class MessageController extends Controller
{
    protected $messageinterface;
    public function __construct(MessageInterface $interface)
    {
        $this->messageinterface=$interface;
    }
    public function messagesPage(){
       list($messages,$user)=$this->messageinterface->userMessages();
      return view('user::User.message.index',['messages'=>$messages,"user"=>$user]);
    }
    public function sendMessageToAdmin(UserMessageRequest $request){
      $message=$this->messageinterface->sendMessageToAdmin($request);
      return response()->json([
        'message'=>$message
      ]);
    }
}
