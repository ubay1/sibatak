<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="text-center">
                    <!-- <div class="bg-welcome">
                        <span class="welcome">Selamat Datang Lae {{user.nama}}</span>
                    </div> -->
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
                        <span class="d-flex flex-column">
                            <router-link to="chat"><img class="img-home" src="images/img-chat.png" alt=""></router-link>
                            <span class="txt-home">Chat</span>
                        </span>
                    </div>

                    <hr class="hr-home">

                </div>

                <div class="bg-apiblog">
                    <span class="txt-apiblog">Blog</span> <br><br>
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
        .bg-welcome{
            margin-bottom: 100px;
            text-align: left;
            margin-left: 60px;
            margin-right: 60px;
        }
        .welcome{
            color: #393636;
            font-weight: bold;
            font-size: 20px;

        }
        .txt-home{
            font-size: 20px;
            color: #393636;
            text-transform: uppercase;
            font-weight: bold;
        }
    }

    @media (min-width:320px) and (max-width:767px){
        .bg-img-home{
            display: flex;
            flex-direction: column;
            margin-bottom: 40px;
        }
        .bg-img-home span{
            margin-bottom: 20px;
        }
        .bg-welcome{
            margin-bottom: 100px;
            text-align: left;
            margin-left: 60px;
            margin-right: 60px;
        }
        .welcome{
            color: #393636;
            font-weight: bold;
            font-size: 20px;
        }
        .txt-home{
            font-size: 20px;
            color: #393636;
            text-transform: uppercase;
            font-weight: bold;
        }
    }

    .img-home{
        width: 150px;
    }

    .hr-home{
        margin-left: 60px;
        margin-bottom: 20px;
        margin-right: 60px;
    }

    .bg-apiblog{
        margin-bottom: 40px;
        margin-left: 60px;
        margin-top: 20px;
        margin-bottom: 60px;
        margin-right: 60px;
    }
    .txt-apiblog{
        background: #393636;
        padding: 10px;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
    }

    .homepage-header-background{
        margin-top: 100px;
    }
</style>
