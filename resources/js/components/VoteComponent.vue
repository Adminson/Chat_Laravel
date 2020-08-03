<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Pls vote for : {{this.counter}}
                    </div>
                    <div v-if="voteStatus == '1'"><h1 class="text-center">Polling start</h1>

                        
                        <div v-for="(data, index) in voteData" :key="index">
                            <div class="card">
                                <div class="card-body" v-bind:class="data.answer">
                                    <h5 class="card-title">Resolution : {{data.reso_no}}</h5>
                                    <p class="card-text">{{ data.resolution }}</p>
                                
                                    <div class="d-flex justify-content-center">
                                        <template v-if="!data.voted">
                                            <div>
                                                <button v-on:click="userAnswer(index,'for')" type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></i></button>
                                                <p class="text-center">For</p>
                                            </div>
                                            <div>
                                                <button v-on:click="userAnswer(index,'abstain')" type="button" class="btn btn-warning btn-circle"><i class="fa fa-commenting-o"></i></button>
                                                <p class="text-center">Abstain</p>
                                            </div>
                                            <div>
                                                <button v-on:click="userAnswer(index,'against')" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
                                                <p class="text-center">Against</p>
                                            </div>
                                        </template>
                                        <template v-if="data.voted">
                                            <div>
                                                <button v-on:click="editAnswer(index,'edit')" type="button" class="btn btn-light btn-circle"><i class="fa fa-pencil-square-o"></i></button>
                                                <p class="text-center">Edit Voting</p>
                                            </div>
                                        </template>
                                    </div>
                        
                                </div>
                            </div>
                            <br/>
                            <br/>
                        </div>

                    </div>
                    <h1 v-if="voteStatus == '0'">-</h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['counter'],
        data() {
            return {
                voteStatus:2,
                message:'',
                voteData: [
                    {
                        reso_no:1,
                        resolution: 'This company best',
                        answer:0,
                        voted:false
                    },
                    {
                        reso_no:2,
                        resolution: 'This company at Malaysia',
                        answer:0,
                        voted:false
                    },
                    {
                        reso_no:3,
                        resolution: 'This company 50 year old',
                        answer:0,
                        voted:false
                    },
                ]
            };
        },
        mounted() {
            Echo.private('vote.'+this.counter)
    	    .listen('AdminVoteEvent', (e) => {
               
                console.log(e);
                this.voteStatus = e.status;
    	    })
        },
        methods: {
            userAnswer: function (index,answer) {
                // alert(answer)
                this.voteData[index].answer = answer;
                this.voteData[index].voted = true;
                console.table('voteData',JSON.stringify(this.voteData));
            },
            editAnswer: function (index,answer) {
                // alert(answer)
                this.voteData[index].answer = '';
                this.voteData[index].voted = false;
                console.table('voteData',JSON.stringify(this.voteData));
            }
        }
    }
    
</script>

<style scoped>
.btn-circle{
    width: 70px;
    height: 70px;
    border-radius: 50%;
    margin: 0px 10px;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 2rem;
}
.for{
    background: lightblue;
}
.abstain{
    background: lightyellow;
}
.against{
    background: lightcoral;
}
</style>
