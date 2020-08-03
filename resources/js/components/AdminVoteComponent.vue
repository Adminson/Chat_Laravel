<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component. {{this.counter}}
                        <div id="example">
                            <button v-on:click="start">Start</button>
                            <button v-on:click="stop">Stop</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['counter'],
        mounted() {
            Echo.private('vote.'+ this.counter)
    	    .listen('AdminVoteEvent', (e) => {
               
    	        console.log(e);
    	    })
        },
         methods: {
            start: function (event) {
              axios.post('/vote', {
                        counter : this.counter,
                        status : '1',
                    })
                    .then(response => {
                        console.log(response);
                        this.message = ''
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            stop: function (event) {
              axios.post('/vote', {
                        counter : this.counter,
                        status : '0',
                    })
                    .then(response => {
                        console.log(response);
                        this.message = ''
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
