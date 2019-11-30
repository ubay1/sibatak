<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="text-center">
                    <div class="bg-welcome">
                        <span class="welcome">Selamat Datang Lae {{user.nama}}</span>
                    </div>
                    <div class="bg-img-home">
                        <span class="d-flex flex-column">
                            <router-link to="blog"><img class="img-home" src="images/img-blog.png" alt=""></router-link>
                            <span class="txt-home">blog</span>
                        </span>
                        <span class="d-flex flex-column">
                            <router-link to="about"><img class="img-home" src="images/img-about.png" alt=""></router-link>
                            <span class="txt-home">About</span>
                        </span>
                        <span class="d-flex flex-column">
                            <router-link to="galeri"><img class="img-home" src="images/img-galeri.png" alt=""></router-link>
                            <span class="txt-home">Galeri</span>
                        </span>
                    </div>

                    <hr class="hr-home">
                    disini api blog

                </div>
            </div>
        </div>

        <Footer/>
    </div>
</template>

<script>
    import Menu from '../components/Menu'

    export default {
        data() {
            return {
                user: {
                    nama: "",
                    email: "",
                    token: ""
                }
            }
        },
        mounted() {
            if (localStorage.data) {
                let data = JSON.parse(localStorage.data);
                this.user.nama = data.user.nama;
                this.user.email = data.user.email;
                // console.log(data)
            }
        },
        components:{
            Menu
        }
    }
</script>

<style>
    @media(min-width:768px){
        .bg-img-home{
            display: flex;
            justify-content: space-evenly;
            margin-bottom: 40px;
        }
        .hr-home{
            border:1px solid #2a2a2a;
            width: 70%;
            margin-bottom: 40px;
        }
    }
    .img-home{
        width: 150px;
    }
    .bg-welcome{
        margin-bottom: 100px;
    }
    .welcome{
        background: #FFEB3B;
        color: #393636;
        font-weight: bold;
        padding: 20px;
        font-size: 30px;
        box-shadow: 0px 4px 0px #c5c4c4;
        text-transform: uppercase;

    }
    .txt-home{
        font-size: 20px;
        color: #393636;
        text-transform: uppercase;
        font-weight: bold;
    }

    .homepage-header-background{
        margin-top: 100px;
    }
</style>
