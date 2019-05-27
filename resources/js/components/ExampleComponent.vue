<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Contact form</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <form action="" @submit.prevent="addPost">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" v-model="loginField.username" name="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" v-model="loginField.password" name="password"  placeholder="********"> 
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-sig-in"></i> Login</button>
                                    </div>
                                </form>
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
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return{
                loginField : {
                    username : '',
                    password : ''
                }
            }
        },
        methods : {
            addPost(){
                // let vm = this
                // console.log(this.loginField)
                // vm.loginField.username = ''
                // vm.loginField.password = ''
            }
        }
    }
</script>
