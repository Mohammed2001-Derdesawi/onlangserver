<?php
namespace Modules\User\Repositories\Interfaces;

interface MessageInterface{
    // public function getToAdmin($relations=[],$count=[],$params=['*'],$paginate=10);
    public function store($request);
    public function sendMessageByWebsite($request);
    public function sendMessagesByEmail($request);
    public function markAsRead($id);
    public function getGroups($relations=[],$params=['*'],$count=[]);
    public function storeGroup($request);
    public function addUserToGroup($request);
    public function deleteUserFromGroup($request);
    public function deleteGroup($id);
    public function updateGroup($id,$request);
    public function getMessagesAdmin();
    public function getReceivedMessagesToAdmin($id);
    public function getMessagesBetween($user,$admin);
    public function SendMessageToUser($request);
    public function outsideMessagesSent($request);
    public function userMessages();
    public function sendMessageToAdmin($request);

}
