<template>
<div>

    <h6 class="mt-4">المجموعات <span class="ms-1 float-end" @click="showgroupmodal=true" style="cursor:pointer"> <i class="fas fa-plus"></i>  </span></h6>

<div class="mail-list mt-1">
<a href="#" v-for="group in groups"  :key="group.id">{{ group.title }}
    <span  class="fas fa-trash text-info float-end text-danger" @click.prevent="deleteGroup(group)" style="margin:0 4px;">
    </span>

    <span  class="fas fa-edit text-info float-end text-primary ml-2" @click.prevent="editGroup(group)" style="margin:0 4px;">
    </span>

    <span  class="mdi mdi-circle-outline text-info float-end" @click.prevent="getusers(group)" :class="{'mdi-circle-slice-8':selectedgroupid==group.id,'mdi-circle-outline':selectedgroupid!=group.id}">
    </span>


</a>
   </div>


            <b-modal v-model="showgroupmodal"  no-fade
      no-enforce-focus   @click="showgroupmodal=true"  id="message-modal" centered size="md" title="إنشاء مجموعة">
                <template #modal-header>
                 <h5 class="modal-title">{{ selectedgroup.id==''?'إنشاء':'تعديل' }} مجموعة</h5>
                </template>
                <form>


                            <div class="mb-3">
                                <input type="text" class="form-control" v-model="selectedgroup.title" placeholder="اسم المجموعة">
                            </div>



                        </form>

                        <template #modal-footer>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showgroupmodal=false">Close</button>
                        <button type="button" class="btn btn-primary" @click="selectedgroup.id==''?createGroup():updateGroup()" >Send<i class="fab fa-telegram-plane ms-1"></i></button>
                    </div>

                       </template>
            </b-modal>


</div>
</template>

<script>
import swal from 'sweetalert';

export default {
    data() {
      return {
        groups:[],
        selectedgroup:{
            id:'',
            title:'',
        },
        selectedgroupid:'',
        showgroupmodal:false,
      }
    },
    mounted(){
        this.getGroups();

    },
    methods:{
        getGroups(){
               axios.get('/api/admin/messages/groups').then((res)=>{
                   this.groups=res.data.data
             }).catch((err)=>{
                console.log(err)
             })

            setTimeout(() => {

                this.$emit("getgroups",this.groups);
            }, 5000);
        },
        getusers(group)
        {
            if(this.selectedgroupid==group.id)
            this.selectedgroupid='';
            else
            this.selectedgroupid=group.id;

            console.log(group)
            this.$emit('selectgroup',group)

        },
        createGroup(){
           if(this.selectedgroup.title!='')
           {
            var data={
                title:this.selectedgroup.title
            }
            axios.post('/api/admin/messages/groups/store',data).then((res)=>{

                this.getGroups();
                swal({
        title:res.data.message.title,
        text: res.data.message.text,
        icon: 'success',
        button: 'OK'
      });
           this.showgroupmodal=false;

            }).catch((err)=>{

            })

           }
           else{
            swal({
          title: 'يرجى التأكد من إدخال عنوان المجموعة ',
            text:'حقل العنوان مطلوب',
          icon: 'warning',
           dangerMode: true,
           buttonsStyling: false,
  confirmButtonClass: 'btn btn-warning btn-block',
           })
           }
        },

        deleteGroup(group){

            swal({
  title: "هل أنت متأكد من حذف هذه المجموعة؟",
  text: "سوف يتم حذفها ولا يمكنك إرجاعها",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  confirmButtonText: "نعم متأكد",
  cancelButtonText: "لا",
}).then((result) => {

  if (result) {
    axios.post(`/api/admin/messages/groups/delete/${group.id}`).then((res)=>{
        swal({
        title:res.data.message.title,
        text: res.data.message.text,
        icon: 'success',
        button: 'OK'
      });
      this.getGroups()


    }).catch((err)=>{
        console.error(err);
    })
    }
})
        },
        editGroup(group){
          this.showgroupmodal=true;
          this.selectedgroup=group;
        },
        updateGroup(){


           if(this.selectedgroup.title!='')
           {
            var data={
                title:this.selectedgroup.title
            }
            axios.post(`/api/admin/messages/groups/update/${this.selectedgroup.id}`,data).then((res)=>{

                this.getGroups();
                swal({
        title:res.data.message.title,
        text: res.data.message.text,
        icon: 'success',
        button: 'OK'
      });
           this.showgroupmodal=false;

            }).catch((err)=>{

            })

           }
           else{
            swal({
          title: 'يرجى التأكد من إدخال عنوان المجموعة ',
            text:'حقل العنوان مطلوب',
          icon: 'warning',
           dangerMode: true,
           buttonsStyling: false,
  confirmButtonClass: 'btn btn-warning btn-block',
           })
           }
        },
    }
}
</script>
