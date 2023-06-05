<template>
<div>
    <div>
        <input  class="form-control" v-model="search" placeholder="بحث عن ..."   />
    </div>
   <div v-if="users.length>0">
    <div class="mt-4">
                <a href="#"  class="d-flex"  v-for="user in users" :key="user.id" @click="getchatTo(user)" :class="{'unread':user.last_sent_message.read_at?true:false}">
                       <img class="d-flex me-3 rounded-circle" v-if="user.image" :src="'/'+user.image" alt="Generic placeholder image" height="36">
                       <i class="d-flex me-3 far fa-user-circle" style="font-size:30px" v-else></i>
                       <div class="flex-1 chat-user-box overflow-hidden">
                         <p class="user-title m-0 unread">{{ user.name }}</p>
                         <p class="text-muted text-truncate unread">{{ user.last_sent_message.message.substr(0,10)+"..."  }}
                    <span class="text-muted text-truncate float-end unread">{{ user.last_sent_message.created_at.substr(0,10) }}</span>


                    </p>
                   </div>
                    </a>

                    <div class="mt-4" v-if="hasmore">
                       <button class="btn btn-primary" @click="getUsers">عرض المزيد</button>
                    </div>

 </div>
   </div>
 <div class="mt-4" v-else>
              <p class="text-center"  >لا يوجد رسائل واردة</p>

 </div>
</div>

</template>



<script>



export default {
    name:'users',
    props:['admin'],
    data() {
        return {
            users:[],
            user:{
                id:'',
                name:'',
                last_sent_message:{},
            },
            search:'',
            hasmore:true,
            page:1
        }

    },
    mounted(){
        this.getUsers()

    },
    methods:{
        getUsers(){

           axios.get('/api/admin/messages/users/get/to/admin/'+this.admin+'/?search='+this.search+"&page="+this.page).then((res)=>{
               if(this.hasmore){
                this.users=this.users.concat(res.data.data.users)
               }
               else
               this.users=res.data.data.users

               this.hasmore=res.data.data.has_more
               this.page=res.data.data.next_page
           })
        },
        getchatTo(user){


            if(this.user.id==user.id)
            this.user={
                id:'',
                name:'',
                last_sent_message:{},
            }
            else
            this.user=user


            this.$emit('userselected',this.user)

        }
    },
    watch:{
        search(value){
            if(this.search.length>3 || value.length==0){
                this.getUsers()
            }
        }
    }


}


</script>

<style scope>
.unread{
    background-color: #fffffff5;
font-weight: bold;
color: #000 !important;
font-size: 13px !important;
}
</style>
