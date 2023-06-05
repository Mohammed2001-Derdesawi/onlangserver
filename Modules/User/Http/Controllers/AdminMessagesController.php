<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\OutsideMessageSent;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\User\Repositories\Interfaces\MessageInterface;
use Modules\User\Repositories\Repositories\UserRepository;

class AdminMessagesController extends Controller
{

    protected $messageRepo;
    public function __construct(MessageInterface $interface)
    {
       $this->messageRepo=$interface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
       $admin=$this->messageRepo->getMessagesAdmin();
        return view('user::admin.message.inbox',['admin'=>$admin]);

    }
    public function chat(){
        return view('user::admin.message.chat');
    }

    public function outsideMessages(){
        return view('user::admin.message.outside');
    }
    public function outsideMessagesSent(OutsideMessageSent $request){
        $this->messageRepo->outsideMessagesSent($request);
        return redirect()->back()->with('success','تم إرسال الرسالة إلى الإيميلات الخارجية');
    }

}
