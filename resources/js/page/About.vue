<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="container-fluid">
                <div class="bg-about">
                    <span class="txt-about">About</span>
                </div>

                <!-- Nav pills -->
                <ul class="container nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#bataktoba">Batak Toba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#batakkaro">Batak Karo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#bataksimalungun">Batak Simalungun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#batakpakpakdairi">Batak Pakpak-Dairi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#batakangkolamandailing">Batak Angkola-Mandailing</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="container tab-content">
                    <div id="bataktoba" class="tab-pane active"><br>
                        <h3>HOME</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div id="batakkaro" class="tab-pane fade"><br>
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="bataksimalungun" class="tab-pane fade"><br>
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                    <div id="batakpakpakdairi" class="tab-pane fade"><br>
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                    <div id="batakangkolamandailing" class="tab-pane fade"><br>
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                </div>
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
    .bg-about{
        margin-top: 40px;
        margin-bottom: 40px;
    }
    .txt-about{
        background: #393636;
        padding: 10px;
        color: #fff;
        font-size: 15px;
        font-weight: bold;
    }
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #3490DB;
        font-weight: bold;
        background-color: transparent;
        border: 2px solid #3490dc;
        border-radius: 50px;
    }
    .homepage-header-background{
        margin-top: 100px;
    }
</style>
