<template>
    <div class="row">
               <div class="col-lg-12">
                   <!-- Left sidebar -->
                   <div class="email-leftbar card"  style="height: 90%;
overflow-y: scroll;">


                       <users :admin="admin" @userselected="selecteduser"   ></users>



                   </div>
                   <!-- End Left sidebar -->


                   <!-- Right Sidebar -->
                   <div class="email-rightbar mb-3">

                       <div class="card">


                           <message :user="user" :admin="admin" @markasread="MarkAsRead"></message>



                       </div> <!-- card -->



                   </div> <!-- end Col-9 -->

               </div>


     </div>

   </template>


   <script>


  import users from './users.vue';
  import message from './message.vue';

   export default {
       name:'chat',
       props:['admin'],
       components:{
        users:users,
        message:message
       },
       data() {
           return {
            user:{
                id:'',
                name:'',
            }
           }

       },
       mounted(){


       },
       methods:{

        selecteduser(user){
           this.user=user
        },
        MarkAsRead(){
            this.user={
                id:'',
                name:'',
                last_sent_message:{},
            }

            this.$children[0].getUsers()


        }
       },
       watch:{

       }

   }


   </script>


   <style>
   .swal-button--danger{
       margin: 0 auto !important;
   }
   .swal-footer{
       text-align: center !important;
   }

   </style>
