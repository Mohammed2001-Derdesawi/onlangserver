<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    public function mynotifications(){
        $user=auth()->user()->load(['notifications'=>function($q){
            if(request('notify')=='read')
            $q->whereNotNull('read_at');
            elseif(request('notify')=='unread')
            $q->whereNull('read_at');

        }]);

        return view('user::User.Notification.notification',['notifications'=>$user->notifications]);
    }

    public function markAsRead($notify)
    {
        $notify=auth()->user()->unreadNotifications()->find($notify);
        if(!$notify)
        return redirect()->back()->with('warning','The Notification is nout found in our record');
        $notify->markAsRead();
        return redirect()->back()->with('success','The Notification is mark as read');
    }
}
