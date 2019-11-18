<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                Ini Home Component
            </div>
        </div>

        <Footer/>
    </div>
</template>

<script>
    import Menu from '../components/Menu'

    export default {
        components:{
            Menu
        }
    }
</script>

<style>
    .homepage-header-background{
        margin-top: 100px;
    }
</style>
