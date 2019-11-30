<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="row">

                    <Carousell/>

                    <vue-toastr ref="mytoast"></vue-toastr>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="container bg-formdaftar">
                            <div class="bg-primary p-2 text-center text-white">
                                Halaman Pendaftaran
                            </div>
                            <form action="" method="post" v-on:submit.prevent="onSubmit()">
                                <div class="mb-3 mt-2">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="masukan nama" v-model="form.nama"> <br>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="masukan nomor telepon" v-model="form.phone"> <br>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="masukan email" v-model="form.email"> <br>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="masukan password" v-model="form.password"> <br>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="masukan password confirmation" v-model="form.password_confirmation"> <br>

                                    <button type="submit" :disabled="btnsubmit" class="btn btn-primary btn-daftar">Daftar <img v-show="showloader" src="assets/img/loader/loading_send.gif" class="img_loader" alt=""></button>
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
    import swal from 'sweetalert2'
    import VueToastr from "vue-toastr"
    import { Carousel, Slide } from 'vue-carousel'

    export default {
        components:{
            'vue-toastr':VueToastr,
            Menu, Carousell
        },
        data() {
            return {
                form: {
                    nama: '',
                    email: '',
                    phone: '',
                    password: '',
                    password_confirmation: '',
                },
                showloader: false,
                btnsubmit: false
            }
        },
        computed: {

        },
        mounted() {
            console.log(process.env.MIX_API_URL);
        },
        methods: {
            onSubmit() {
                this.text_send_service = !this.text_send_service;
                this.showloader        = !this.showloader;
                this.btnsubmit         = true;

                let currentObj = this;

                let formData = new FormData();
                formData.append('nama', this.form.nama);
                formData.append('email', this.form.email);
                formData.append('phone', this.form.phone);
                formData.append('password', this.form.password);
                formData.append('password_confirmation', this.form.password_confirmation);

                axios.post(process.env.MIX_API_URL+'user/register', formData)
                .then(response => {
                    // console.log(response);
                    this.showloader = !this.showloader;
                    console.log(response.data);
                    this.$refs.mytoast.Add({
                        msg: 'Perhatian',
                        title: response.data.message,
                        clickClose: true,
                        timeout: 3500,
                        position: 'toast-top-center',
                        type: response.data.type
                    });

                    this.form = '';
                    this.btnsubmit = false;
                })
                .catch(function (error){
                    currentObj.output = error;
                });
            }
        },
    }
</script>

<style>
    @media (min-width: 768px) {
        .bg-formdaftar {
            max-width: 520px !important;
        }
    }
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
