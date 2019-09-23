<template>
<div id="app">

    <div class="content" >
        <div v-if="loggedIn === false" class="container">
            <div class="row">
            Name
            <input type="text" v-model="name" placeholder="Name">
            Password
            <input type="password" v-model="password" placeholder="password">
            </div>
             <input type="button" class="fa fa-minus" aria-hidden="true" v-on:click="Authenticate()" value="save">
        </div>
        <div v-else>
           <router-link to="/example">
           </router-link>
        </div>
   

    </div>
</div> 
</template>

<script>
    export default {
        data(){
            return {
                    loggedIn:false,
                    name:'teste',
                    password:'teste',
                    token_type:'teste',
                    expires_in:'teste',
                    access_token:'teste',
            }
        },
        created() {
        
        },
        computed: {

        },
        methods: {
            
            Authenticate: function(ingredient){
                var self = this;
           
                axios({
                    method: 'post',
                    url: '../api/login',
                  
                    config: {
                    'username': this.name,
                    'password': this.password,

                }}
                    )
                .then(function (response) {
                    self.loggedIn = true;
               
                    })
                .catch(function (response) {
                //handle error
               console.log('yo I got an error', response);
                });
            }

        },
        
    }
</script>

<style>


</style>