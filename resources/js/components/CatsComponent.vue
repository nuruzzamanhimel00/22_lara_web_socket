<template>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card">
                <div class="card-header">
                    <h3>
                        Messages
                    </h3>
                </div>
                <div class="card-body">
                   <ul class="list-styled" style="height: 300px;overflow-y: scroll;">
                        <li class="p-2" v-for="(msg, index) in messages" :key="index">
                            <strong>{{msg.user.name}}</strong>
                            {{ msg.message }}
                        </li>
                   </ul>
                </div>
                <input
                @keyup.enter="onSendMessage()"
                v-model="newMessage"
                type="text"
                name="message"
                placeholder="enter your message"
                class="form-control"
                >
                <span class="text-muted p-2"><i>user is typing....</i></span>
           </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card card-default">
                        <div class="card-header">
                            <b>USER ONLINE</b>
                        </div>
                        <div class="card-bod">
                            <ul class="left-ul">
                                <li>
                                    user name
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name:'CatsComponent',
        props:['user'],
        data(){
           return {
             messages: [],
             newMessage:''
           }
        },
        mounted(){
            this.fetchMessages();
        },
        methods:{
            fetchMessages(){
                axios.get('/messages')
                .then((res)=>{
                    // console.log(res.data.data.length);
                    if(res.data.status == 'success' && res.data.data.length > 0){
                        this.messages = res.data.data;
                    }
                    // console.log(res.data);
                });
            },
            onSendMessage(){
                if(this.newMessage == ""){
                    return false;
                }
                axios.post('/messages',{
                    'user_id' : this.user.id,
                    'message' : this.newMessage
                }).then((res)=>{
                    if(res.data.status == "success"){
                        this.messages.unshift(res.data.data);
                    }
                    console.log(res);
                });
            }
        }
    }
</script>
<style scoped>

</style>
