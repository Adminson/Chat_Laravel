<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div class="offset-4 col-4 offset-sm-1 col-sm-10">
                            <h1 v-if="statusButton == 'YES'">Voting open</h1>
                            <h1 v-if="statusButton == 'Close'">Voting Done</h1>
                            <li class="list-group-item active">Chat Room <span class="badge  badge-pill badge-danger">@{{ numberOfUsers }}</span> </li>
                            <!-- <div class="badge badge-pill badge-primary">{{ typing }}</div> -->
                            <ul class="list-group" v-chat-scroll>
                            <!-- <ul class="list-group"> -->
                            <message
                            v-for="(value,index) in chat.message"
                            :key="value.index"
                            :color= chat.color[index]
                            :user = chat.user[index]
                            :time = chat.time[index]
                            >
                                {{ value }}
                            </message>
                            </ul>
                            <input type="text" class="form-control" placeholder="Type your message here..." v-model='message' @keyup.enter='send'>
                            <br>
                            <!-- <a href='' class="btn btn-warning btn-sm" @click.prevent='deleteSession'>Delete Chats</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import message from "./message.vue";

export default {
    props: [],
    components: {
         message
    },
    created() {},
    data() {
        return {
            message:'',
            chat:{
                message:[],
                user:[],
                color:[],
                time:[]
            },
            typing:'',
            numberOfUsers:0,
            statusButton:'no'
        };
    },
    computed: {},
    methods: {
        send(){
            if (this.message.length != 0) {
                this.chat.message.push(this.message);
                this.chat.color.push('success');
                this.chat.user.push('you');
                // this.chat.time.push(this.getTime());
                axios.post('/send', {
                        message : this.message,
                        chat:this.chat
                    })
                    .then(response => {
                        console.log(response);
                        this.message = ''
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
    },
 mounted(){
        // this.getOldMessages();
    	Echo.private('chat')
    	    .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.statusButton = e.message;
    	    	this.chat.user.push(e.user);
    	    	this.chat.color.push('warning');
    	    	// this.chat.time.push(this.getTime());
                axios.post('/saveToSession',{
                    chat : this.chat
                })
                      .then(response => {
                      })
                      .catch(error => {
                        console.log(error);
                      });
    	        // console.log(e);
    	    })
    	    // .listenForWhisper('typing', (e) => {
    	    // 	if (e.name != '') {
    	    //     	this.typing = 'typing...'
    	    // 	}else{
    	    // 		this.typing = ''
    	    // 	}
    	    // })

    	    // Echo.join(`chat`)
    	    //     .here((users) => {
    	    //     	this.numberOfUsers = users.length;
    	    //     })
    	    //     .joining((user) => {
    	    //     	this.numberOfUsers += 1;
    	    //     	// console.log(user);
    	    //     	this.$toaster.success(user.name+' is joined the chat room');
    	    //     })
    	    //     .leaving((user) => {
    	    //     	this.numberOfUsers -= 1;
    	    //     	this.$toaster.warning(user.name+' is leaved the chat room');
    	    //     });
    }
};
</script>
<style scoped>
    .list-group{
        overflow-y: scroll;
        height: 200px;
    }
</style>