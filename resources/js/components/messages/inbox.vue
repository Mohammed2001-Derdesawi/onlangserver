<template>
    <div class="row">
               <div class="col-lg-12">
                   <!-- Left sidebar -->
                   <div class="email-leftbar card">
                       <div class="d-grid">
                           <button type="button" class="btn btn-danger waves-effect waves-light" @click="showmessagemodal=true">
                               إرسال رسالة
                           </button>
                       </div>
                       <div class="mail-list mt-4">
                           <a href="#" class="active"><i class="mdi mdi-email-outline me-2"></i> الرسائل الواردة <span class="ms-1 float-end">({{ recieved_messages }})</span></a>
                           <a href="#"><i class="mdi mdi-account-multiple me-2"></i>الطلاب</a>
                       </div>
   
   
                       <group @selectgroup="groupselected" @getgroups="loadedgroups" ></group>
   
   
   
                   </div>
                   <!-- End Left sidebar -->
   
   
                   <!-- Right Sidebar -->
                   <div class="email-rightbar mb-3">
   
                       <div class="card">
                           <div class="btn-toolbar p-3" role="toolbar">
   
   
   
   
   
   
   
   
   
   
                               <div class="row">
               <div class="col-xl-12">
                   <div class="card">
                       <div class="card-body">
   
                           <form>
                               <div class="row">
   
                                   <div class="col-lg-12 mt-2 mb-4">
                                       <div class="form-group">
                                           <input type="checkbox" v-on:click="checkAll" v-model="selectall" id="check_all" class="form-check-input"  style="width:1.9em;height:1.9em;">
   
   
                                       <label style="margin:0 10px">اختيار جميع الطلاب</label>
   
                                     <input type="checkbox"  v-model="alluserschecks" id="check_all" class="form-check-input"  style="width:1.9em;height:1.9em;">
   
                                   <div v-if="usersids.length>0" class="mt-2 mb-4">
                                   <button type="button" class="btn btn-primary waves-light waves-effect" @click="triggergroupmodal('delete')"><i class="far fa-trash-alt"></i></button>
                                   <button type="button"  class="btn btn-primary waves-light waves-effect" @click="triggergroupmodal('add')"><i class="fas fa-plus"></i></button>
   
                                   </div>
   
   
                               </div>
                               </div>
   
   
   
   
   
                                 <div class="col-lg-4">
                                     <div class="form-group">
                                         <label for="">من</label>
                                         <input class="form-control" v-model="from" name="from" id="" type="date">
                                     </div>
   
                                 </div>
                                 <div class="col-lg-4">
                                     <div class="form-group">
                                         <label for="">إلى</label>
                                         <input class="form-control" v-model="to" name="to" id="" type="date">
                                     </div>
   
                                 </div>
   
                                <div class="col-lg-4">
                                   <label class="custom-control-label" for="customRadioInline1">المشتركين في الكورسات</label>
                                   <select name="typeofusers" v-model="course" class="form-control" id="" >
                                       <option value="all">جميع الطلاب</option>
                                       <option value="unsubscribe">غير مشتركين</option>
                                   </select>
                                </div>
                                <div class="col-lg-4 mt-4 mb-2">
                                   <button class="btn btn-primary" @click.prevent="SearchUsers">بحث</button>
                                 </div>
   
   
   
                               </div>
   
                               <div class="row">
                                   <div class="col-lg-4 mt-2">
   
                               <input class="form-control" type="text" v-model="search" placeholder="بحث...">
   
                                    </div>
                               </div>
                             </form>
                       </div>
                   </div>
            </div>
   </div>
   
   
   
   
   
   
                           </div>
                           <ul class="message-list">
   
                             <li v-for="(user, index) in users" :key="user.id">
                               <div class="col-mail col-mail-1">
                                   <div class="checkbox-wrapper-mail">
                                       <input type="checkbox" :value="user.id" v-model="usersids"  name="stdids[]"  :id="'chk'+ (index+1)">
                                       <label class="form-label" :for="'chk'+ (index+1)"></label>
                                   </div>
                                   <a href="#" class="title">{{ user.name }}</a>
                               </div>
                               <div class="col-mail col-mail-2">
                                   <a href="#" class="subject">الإيميل:{{ user.email }}<span class="teaser"></span>
                                   </a>
                               </div>
                           </li>
   
   
   
   
                           </ul>
   
                       </div> <!-- card -->
   
                       <div class="row">
                           <div class="col-7">
                               عرض <span id="stdshow">{{ users.length }}</span>  من <span id="stdtotal">{{ countinpage==0?0:countall }}</span>
                           </div>
                           <div class="col-5">
                               <div class="btn-group float-end" v-if="hasmorepages">
                                   <button type="button" @click="getUsers"  class="btn btn-sm btn-success waves-effect">عرض المزيد</button>
                               </div>
                           </div>
                       </div>
   
                   </div> <!-- end Col-9 -->
   
               </div>
               <!-- groups modal -->
               <b-modal v-model="showgroupmodal"  no-fade
         no-enforce-focus    id="group-modal" centered size="md" title="المجموعات">
                   <template #modal-header>
                    <h5 class="modal-title">المجموعات</h5>
                   </template>
                   <form>
   
                                <div class="row">
                                   <div class="col-lg-4" v-for="group in groups" :key="group.id">
                                       <div class="mb-3" >
                                 <div class="form-group">
                                   <label class="form-label" for="group">{{ group.title }}</label>
                                   <input type="checkbox" id="group" name="selectedgroups[]"  class="form-control form-check-input  form-label" :value="group.id"  v-model="selectedgroups">
                                 </div>
   
                               </div>
   
                                   </div>
                                </div>
   
   
   
                           </form>
   
                           <template #modal-footer>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="triggergroupmodal()">Close</button>
                           <button type="button" class="btn btn-primary" @click="groupoperation=='add'?addUsersTogroup():removeUsersFromGroup()" >Send<i class="fab fa-telegram-plane ms-1"></i></button>
                       </div>
   
                          </template>
               </b-modal>
   
               <!-- end group modal -->
   
   
               <!--  create a new message modal -->
               <b-modal v-model="showmessagemodal"  no-fade
         no-enforce-focus   @click="showmessagemodal=true"  id="message-modal" centered size="lg" title="إنشاء رسالة">
                   <template #modal-header>
                    <h5 class="modal-title">إنشاء رسالة (العدد: {{usersids.length}}) </h5>
   
                   </template>
                   <form>
   
   
                               <div class="mb-3">
                                   <input type="text" class="form-control" v-model="message.subject" placeholder="Subject">
                               </div>
   
   
   
   
                         <textareavue  @message-change="message_change" ></textareavue>
   
   
                           </form>
                           <div class="mb-3">
                                   <label for="type">إرسال الرسالة عن طريق:</label>
                                   <div class="row">
                                       <div class="col-lg-4" id="type">
                                           <label for="type">الإيميل:</label>
                                           <input type="radio" class="form-check-input" name="type" v-model="message.type" value="email"  >
   
                                       </div>
                                       <div class="col-lg-4" id="type">
                                           <label for="type">الموقع:</label>
                                           <input type="radio" class="form-check-input" name="type" v-model="message.type" value="website"  >
                                       </div>
                                       <div class="col-lg-4" id="type">
                                           <label for="type">الإيميل والموقع:</label>
                                           <input type="radio" class="form-check-input" name="type" v-model="message.type" value="both"  >
                                       </div>
   
                                       <div class="col-lg-4" id="type" v-if="message.type=='email' || message.type=='both'">
                                           <label for="type">المرسل:</label>
                                           <input type="email" class="form-control" name="sennder_email" v-model="message.sender_email"   >
                                       </div>
                                   </div>
                               </div>
                           <template #modal-footer>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showmessagemodal=false">Close</button>
                           <button type="button" class="btn btn-primary" @click="SendMessageTo" >Send<i class="fab fa-telegram-plane ms-1"></i></button>
                       </div>
   
                          </template>
               </b-modal>
                           <!-- end create a new message modal -->
   
     </div>
   
   </template>
   
   
   <script>
   
   import swal from 'sweetalert';
   import group from './group.vue';
   // import tinymce from 'tinymce/tinymce';
   // import 'tinymce/plugins/lists';
   // import 'tinymce/plugins/link';
   // import 'tinymce/plugins/image';
   // import 'tinymce/plugins/code';
   export default {
       name:'inbox',
       components:{
           group:group,
   
   
       },
       props:['admin','recieved_messages'],
   
       data() {
           return {
               users:[],
               usersids:[],
               selectall:false,
               search:'',
               countall:0,
               countinpage:0,
               page:1,
               showmessagemodal:false,
               message:{
                subject:'',
                content:'',
                type:'email',
                sender_email:''
               },
               course:'all',
               alluserschecks:false,
               from:null,
               to:null,
                 hasmorepages:true,
                 selectgroup:{
                   id:'',
                   title:'',
                 },
                 groups:{},
                 selectedgroups:[],
                 showgroupmodal:false,
                 groupoperation:'',
   
   
   
   
   
           }
   
       },
       mounted(){
          this.getUsers()
   
       },
       methods:{
           getUsers(){
               if(this.hasmorepages || this.selectgroup.id!='')
               {
                   axios.get("/api/admin/messages/get/users?search="+this.search+"&page="+this.page+"&group="+this.selectgroup.id+"&typeusers="+this.course+"&from="+this.from+"&to="+this.to).then((response)=>{
               this.countall=response.data.data.countall
                 this.users=response.data.data.users
                 this.countinpage=response.data.meta.total
                 this.hasmorepages=response.data.data.has_more
                 this.page=response.data.data.next_page
   
             })
             if(this.selectgroup.id==''){
                   this.selectall=false;
               }
   
   
               }
   
           },
           checkAll(){
               this.selectall=!this.selectall
                if(this.selectall)
                {
   
                   for( let user of this.users)
                   {
   
                       if(!this.usersids.find((e)=>e==user.id))
                       this.usersids.push(user.id)
                   }
                }
                else
                {
                   if(this.selectgroup.id=='')
                   this.usersids=[]
                   else{
                       for( let user of this.users)
                   {
                       let index=this.usersids.indexOf(user.id);
   
                       if(index>-1)
                        this.usersids.splice(index,1);
   
                   }
   
                   }
   
                }
   
           },
           SendMessageTo(){
               if(((this.usersids.length || this.alluserschecks)|| this.alluserschecks) > 0 && this.message.subject && this.message.type && this.message.content!='')
               {
                   var data={
                       users:this.usersids,
                       subject:this.message.subject,
                       type:this.message.type,
                       message:this.message.content,
                       sender:this.message.sender_email,
                       sender_id:this.admin,
                       sendToAllusers:this.alluserschecks
                   }
   
                   axios.post('/api/admin/messages/users/send/messages',data).then((res)=>{
                   this.usersids=[]
                   this.message={subject:'',content:'',type:this.message.type}
                   this.selectall=false;
   
                   swal({
           title:res.data.message.title,
           text: res.data.message.text,
           icon: 'success',
           button: 'OK'
         });
               }).catch((err)=>{
                 console.error(err)
               })
               }
   
               else
               swal({
             title: 'يرجى التأكد من إدخال عناصر الرسالة',
               text:'عناصر الرسالة:اختيار الطلاب-إدخال موضوع الرسالة-إدخال الرسالة',
             icon: 'warning',
              dangerMode: true,
              buttonsStyling: false,
     confirmButtonClass: 'btn btn-warning btn-block',
              })
   
   
           },
           groupselected(group){
   
                 if(this.selectgroup.id==group.id){
                     this.selectgroup={
                       id:'',
                       title:''
                     };
   
                   this.hasmorepages=true;
                 }
                 else
                 {
                   this.selectgroup=group
   
                   this.selectall=false;
   
   
                 }
   
                 this.getUsers()
           },
           loadedgroups(groups){
   
               this.groups=groups
           },
           addUsersTogroup(){
                if(this.selectedgroups.length>0 && this.usersids.length>0){
                   let data={
                        groups:this.selectedgroups,
                        users:this.usersids
                   }
                   axios.post('/api/admin/messages/groups/users/add',data).then((res)=>{
                       this.usersids=[]
                       this.selectedgroups=[]
                       this.showgroupmodal=false;
                       this.selectall=false;
   
                       swal({
           title:res.data.message.title,
           text: res.data.message.text,
           icon: 'success',
           button: 'OK'
         });
         this.getUsers()
                   }).catch((err)=>{
                       console.log(err)
                   })
                }
                else
                {
                   swal({
             title: 'يرجى التأكد من إختيار الطلاب والمجموعات',
               text:'حاول مرة أخرى بعد التأكد شكرا لك ',
             icon: 'warning',
              dangerMode: true,
              buttonsStyling: false,
            confirmButtonClass: 'btn btn-warning btn-block',
              })
   
                }
           },
           removeUsersFromGroup(){
                if(this.selectedgroups.length>0 && this.usersids.length>0){
                   let data={
                        groups:this.selectedgroups,
                        users:this.usersids
                   }
                   axios.post('/api/admin/messages/groups/users/delete',data).then((res)=>{
                       this.usersids=[]
                       this.selectedgroups=[]
                       this.showgroupmodal=false;
                       this.selectall=false
                       swal({
           title:res.data.message.title,
           text: res.data.message.text,
           icon: 'success',
           button: 'OK'
         });
         this.getUsers()
                   }).catch((err)=>{
                       console.log(err)
                   })
                }
                else
                {
                   swal({
             title: 'يرجى التأكد من إختيار الطلاب والمجموعات',
               text:'حاول مرة أخرى بعد التأكد شكرا لك ',
             icon: 'warning',
              dangerMode: true,
              buttonsStyling: false,
            confirmButtonClass: 'btn btn-warning btn-block',
              })
   
                }
           },
           triggergroupmodal(operation=''){
               this.showgroupmodal=!this.showgroupmodal;
               this.groupoperation=operation;
               if(!this.showgroupmodal){
                   this.selectedgroups=[]
               }
   
           },
           message_change(message){
                  this.message.content=message
           },
           SearchUsers(){
               this.hasmorepages=true
   
               this.getUsers()
           }
   
   
   
   
   
   
   
   
   
       },
       watch:{
           search(newSearch)
           {
               if(newSearch.length > 3 || newSearch.length=='')
               {
                   this.page=1
                   this.hasmorepages=true
                   this.getUsers()
               }
   
           }
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