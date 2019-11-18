<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="row">

                    <Carousell/>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="container">
                            <div class="bg-primary p-2 text-center text-white">
                                Halaman Pendaftaran
                            </div>
                            <form action="" method="post" v-on:submit.prevent="onSubmit">
                                <div class="mb-3 mt-2">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="masukan nama" v-model="nama"> <br>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="masukan nomor telepon" v-model="phone"> <br>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="masukan email" v-model="email"> <br>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="masukan password" v-model="password"> <br><input type="text" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="masukan password confirmation" v-model="password_confirmation"> <br>
                                    <button type="submit" class="btn btn-primary btn-daftar">Daftar<img v-show="showloader" src="assets/img/loader/loading_send.gif" class="img_loader" alt=""></button>
                                </div>
                                <div class="text-center">
                                    <router-link to="/login">sudah punya akun ? masuk disini lae</router-link>
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
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components:{
            Menu, Carousell
        },
        data() {
            return {
                nama: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                success: false,
                showloader: false,
            }
        },
        computed: {

        },
        mounted() {
            console.log(process.env.API_URL);
        },
        methods: {
            onSubmit() {
                this.text_send_service = !this.text_send_service;
                this.showloader        = !this.showloader;

                let currentObj = this;

                let formData = new FormData();
                formData.append('nama', this.nama);
                formData.append('email', this.email);
                formData.append('phone', this.phone);
                formData.append('password', this.password);
                formData.append('password_confirmation', this.password_confirmation);

                axios.post(process.env.API_URL+'user/register', formData)
                .then(response => {
                    this.showloader = !this.showloader;
                    this.success = response.data;
                    console.log(response.data);
                })
                .catch(function (error){
                    currentObj.output = error;
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
    .form-control, .btn-daftar{
        border-radius: 0px;
    }
</style>
