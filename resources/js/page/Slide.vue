<template>
    <div class="col-lg-6 col-md-6 col-sm-12 d-sm-none d-none d-lg-block">
        <carousel :loop="true" :autoplay="true" :autoplayTimeout="4000" :perPage="1" class="caro-list">
            <slide>
                <div class=" text-center">
                    <img src="../../img/b1.jpg" alt="" class="img-fluid img-slides">
                    <p>Batak 1</p>
                </div>
            </slide>
            <slide>
                <div class=" text-center">
                    <img src="../../img/b2.jpg" alt="" class="img-fluid img-slides">
                    <p>Batak 2</p>
                </div>
            </slide>
            <slide>
                <div class=" text-center">
                    <img src="../../img/b3.jpg" alt="" class="img-fluid img-slides">
                    <p>Batak 3</p>
                </div>
            </slide>
        </carousel>
    </div>
</template>
