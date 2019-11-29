<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="row">

                    <Carousell/>

                    <vue-toastr ref="mytoast"></vue-toastr>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="container">
                            <div class="bg-primary p-2 text-center text-white">
                                Halaman Login
                            </div>
                            <form method="post" @submit.prevent="onSubmit()">
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" v-model="form.email" name="email" id="email" placeholder="masukan email"> <br>
                                    <input type="password" class="form-control" v-model="form.password" name="password" id="password" placeholder="masukan password"> <br>
                                    <button type="submit" :disabled="btnsubmit" class="btn btn-primary btn-login">Login <img v-show="showloader" src="assets/img/loader/loading_send.gif" class="img_loader" alt=""></button>
                                </div>
                                <div class="text-center">
                                    <router-link to="daftar">belum punya akun ? daftar disini lae</router-link>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Footer/>
    </div>
</template>

<script>
    import axios from 'axios'
    import Menu from '../components/Menu'
    import Carousell from './Slide'
    import VueToastr from "vue-toastr"
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components:{
            'vue-toastr':VueToastr,
            Menu, Carousell
        },
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                showloader: false,
                btnsubmit: false
            }
        },
        mounted() {
            console.log(process.env.MIX_API_URL);
        },
        methods: {
            onSubmit(){
                this.showloader = true;
                this.btnsubmit  = true;
                var formData = {
                    email: this.form.email,
                    password: this.form.password
                }
                console.log(formData);

                axios.post(process.env.MIX_API_URL+"user/login_user", formData)
                .then( response => {
                    switch (response.data.success) {
                        case false:
                            this.$refs.mytoast.Add({
                                msg: 'Perhatian',
                                title: response.data.message,
                                clickClose: true,
                                timeout: 3500,
                                position: 'toast-top-center',
                                type: 'error'
                            });

                            this.$store.dispatch('login', response.data).then(() => {
                                console.log('success is false');
                            }).catch((err)=>{
                                console.log(err);
                            })

                            this.showloader = !this.showloader;
                            this.btnsubmit  = false;
                            break;

                        case true:
                            this.showloader = !this.showloader;
                            this.btnsubmit  = false;
                            this.$store.dispatch('login', response.data).then(() => {
                                console.log('response true')
                                this.$router.push('/');
							}).catch((err) => {
								console.log(err)
							})

                            break;

                        default:
                            break;
                    }
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        },
    }
</script>

<style>
    .img_loader {
        width: 20px;
    }
    .homepage-header-background{
        margin-top: 100px;
    }
    .img-slides{
        height: 300px;
        width: 100%;
        object-fit: cover;
        object-position: center;
    }
    form{
        background:white;
        padding: 20px;
        box-shadow: 0px 2px 4px lightgrey;
    }
    .form-control, .btn-login{
        border-radius: 0px;
    }
</style>
