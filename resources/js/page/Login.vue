<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="row">

                    <Carousell/>

                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="container">
                            <div class="bg-primary p-2 text-center text-white">
                                Halaman Login
                            </div>
                            <form>
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="masukan email"> <br>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="masukan password"> <br>
                                    <button type="submit" class="btn btn-primary btn-login">Login</button>
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
    import { Carousel, Slide } from 'vue-carousel';

    export default {
        components:{
            Menu, Carousell
        }
    }
</script>

<style>
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
