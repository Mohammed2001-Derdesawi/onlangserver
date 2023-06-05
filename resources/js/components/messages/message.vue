<template>
    <div>

      <div class="chat" v-if="user.id">
        <div class="btn-toolbar p-3" role="toolbar">
                               <div class="btn-group me-2 mb-2 mb-sm-0">
                                <img class="d-flex me-3 rounded-circle" v-if="user.image" :src="'/'+user.image.replace('\\','/')" alt="Generic placeholder image" height="40">
                                <i class="d-flex me-3 far fa-user-circle" style="font-size:30px" v-else></i>
                                <div class="flex-1 chat-user-box overflow-hidden">
                                                <p class="user-title m-0 unread">{{ user.name }}</p>
                                   </div>
                                   <div class="btn-group me-2 mb-2 mb-sm-0" style="margin: 0 30px;" v-if="!user.last_sent_message.read_at">
                                                <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    More <i class="mdi mdi-dots-vertical ms-2"></i>
                                                </button>
                                                <div class="dropdown-menu" style=""  >
                                                    <a class="dropdown-item" @click="MarkAsRead" href="#">Mark as Read</a>
                                                </div>
                                            </div>
       </div>

      </div>

     <div class="chat-container" >

            <div class="chat-body">

                 <div class="chat-message" v-for="message in messages" :key="message.id"
                  :class="{'received':message.sender_id==user.id && message.sender_type==user.last_sent_message.sender_type,'sent':message.received!=user.id && message.sender_type!=user.last_sent_message.sender_type }">
                       <p v-html="message.message"></p>

                        </div>


                            <div class="chat-footer">
                                <button @click="sendmessage">إرسال</button>
                                <input type="text" v-model="message"  placeholder="اكتب رسالة ...">
                            </div>


          </div>

    </div>
      </div>

      <div class="chat-container" v-else>
        <div class="chat-body">

            <div class="no-conversation-selected" style="padding: 80px;">
                <i class="fab fa-rocketchat"></i>
                    <p>الرجاء إختيار محادثة لعرض الرسائل.</p>
  </div>

        </div>
      </div>

</div>

</template>

<script>
export default {
    name:'message',
    props:['user','admin'],
    data() {
          return{
            messages:[],
            message:''
          }
    },
    mounted(){
    },
    methods:{
        getMessages(){
            axios.get(`/api/admin/messages/users/chat/${this.user.id}/with/admin/${this.admin}`).then((res)=>{
                this.messages=res.data.data;
            }).catch((err)=>{
                console.log(err)
            })
        },
        sendmessage(){
            if(this.message!=''){
                this.messages.push({
                    id:this.message+"sender"+this.user.id,
                    sender_id:this.admin,
                    sender_type:'',
                    received_id:this.user.id,
                    received_type:'',
                    message:this.message,

                })
                let temp_messages=this.message
                this.message=''
                let data={
                    to:this.user.id,
                    from:this.admin,
                    message:temp_messages
                }
                axios.post('/api/admin/messages/users/chat/send/to/user/from/admin',data).then((res)=>{

                   this.getMessages()

                }).catch((err)=>{
                    console.log(err)
                })


            }
        },

        MarkAsRead(){
            let data={
                    user:this.user.id,
                }
                axios.post('/api/admin/messages/users/chat/mark/as/read',data).then((res)=>{
                    this.$emit('markasread')
                }).catch((err)=>{
                    console.log(err)
                })
        }
    },
    watch:{
        user(){
            if(this.user.id)
            this.getMessages()
        }
    }
}
</script>

<style scoped>
.chat-container {
  border: 1px solid #ccc;
  border-radius: 5px;
  overflow: hidden;
}

.chat-header {
  background-color: #075e54;
  color: #fff;
  padding: 10px;
  text-align: center;
}

.chat-body {
  height: 100%;
  display: flex;
  flex-direction: column;
  overflow-y: scroll;
}

.chat-message {
  margin: 10px;
  width: 95%;
}

.chat-message p {
  padding: 10px;
  border-radius: 5px;
  max-width: 95%;
}

.sent {
    text-align: right;
  background-color: #dcf8c6;
}

.received {
  text-align: left;
  background-color: #f2f1f1;
}

.chat-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
}

.chat-footer input[type="text"] {
  flex: 1;
  padding: 10px;
  margin-right: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.chat-footer button {
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: #075e54;
  color: #fff;
  cursor: pointer;
}
.no-conversation-selected {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
}
.no-conversation-selected i {
  font-size: 86px;
  margin-bottom: 10px;
}

.no-conversation-selected p {
  font-size: 16px;
  color: #999;
  text-align: center;
  margin: 0;
}
</style>
