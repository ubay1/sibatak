<template>
    <div>
        <Menu/>
        <div class="homepage-header-background">
            <div class="">
                <div id="chatku">
                    <div class="chat">

                        <div id="message_box" v-for="(chat, index) in chats" :key="index">
                            <div v-if="chat.user == user.nama">
                                <div class="bubble-right">
                                    <p><span class="nama">{{chat.user}}</span>
                                        <span class="msgc">{{chat.message}}
                                        </span><span class="date">{{chat.sendDate}}</span>
                                    </p>
                                </div>
                            </div>
                            <div v-if="chat.user != user.nama">
                                <div class="bubble-left">
                                    <p><span class="nama">{{chat.user}}</span>
                                        <span class="msgc">{{chat.message}}
                                        </span><span class="date">{{chat.sendDate}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-input">
                            <form class="form-chat" id="msg_form">
                                <div class="flex-container">
                                    <input type="hidden" name="nama" id="nama" :value="user.nama">
                                    <textarea type="text" placeholder="tulis pesan.." name="message" id="message" class="form-control form-control-chat" v-model="form.message"></textarea>

                                    <div id="btn-smartphone" class="bg-button-smartphone">
                                        <button type="button" name="sendMessage" id="submit" class="btn btn-primary btn-kirim" @click.prevent="sendMessage()"> kirim
                                        </button>
                                    </div>
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
    import Menu from '../components/Menu'
    import firebase from '../firebase/fire'

    export default {
        data() {
            return {
                username: '',
                messages: [],
                chats:[],
                data:{
                    message:''
                },
                user: {
                    nama: "",
                },
                form:{
                    nama:'',
                    message:''
                }
            }
        },
        created() {

        },
        mounted() {
            if (localStorage.data) {
                let data = JSON.parse(localStorage.data);
                this.user.nama = data.user.nama;
                this.user.email = data.user.email;
                this.form.nama  = this.user.nama;
                console.log(data)

                // get data firebase realtime database
                firebase.database().ref('chats').on('value', (snapshot) => {
                    this.chats = [];
                    snapshot.forEach((doc) => {
                        let item = doc.val()
                        item.key = doc.key
                        this.chats.push(item)
                    });
                    // console.log(this.chats)
                });
            }
        },
        methods: {
            sendMessage(){
                console.log(this.form.nama +" "+ this.form.message)
                let newData = firebase.database().ref('chats').push();

                var a = new Date();
                var tgl = a.getDate() < 10 ? "0"+a.getDate() : a.getDate();
                var bln = a.getMonth()+1 < 10 ? "0"+a.getMonth() : a.getMonth()+1;
                var thn = a.getFullYear();
                var jam = a.getHours();
                var mnt = a.getMinutes();
                var date = tgl + '/' + bln + '/' + thn + ' ' + jam+":"+mnt;
                // console.log(date);

                newData.set({
                    type: 'newmsg',
                    user: this.form.nama,
                    message: this.form.message,
                    sendDate: date
                });
                this.form.message = '';
                this.form.message = ''
            }
        },
        components:{
            Menu
        }
    }
</script>

<style type="text/css">
	body{background-color:#F7F7F7;}
    .homepage-header-background{
        margin-top: 100px;
    }
    .chat{
        margin-top: 180px;
    }
    .form-chat {
        width: 100%;
        margin-left: 0px;
        padding: 0px;
        background: white;
        box-shadow: 0px 2px 4px transparent !important;
    }

	@media(min-width:600px){

		.bg-input{bottom:0px; position:fixed; background-color:#ECEAEA; height:100px; width:100%; box-shadow:0px -3px 0px #D0D0D0; display:flex; align-items:center; justify-content:center; }
		.flex-container{background: #ECEAEA; display:flex;  align-items:center; justify-content:center; }
		textarea.form-control {height:55px;}
		.form-control-chat{border-radius:0%; margin-left:10px; width:440px;}
		.form-control:focus{border-color:unset; box-shadow:unset; border:inset 2px #3F51B5;}
		.btn-kirim, .btn-gambar{border-radius:0%; height:43px; margin-left:15px; background-color:#3F51B5;}
		.btn-kirim:hover{background-color:#3647A5;}
		.btn-gambar:hover{background-color:#3647A5;}

		/*chat*/

		#chatku{margin-top:120px;}
		.bubble-left, .bubble-right{ line-height:100%; display: block; position: relative; padding:5px;
	   -webkit-border-radius: 11px; -moz-border-radius: 11px; margin-bottom: 1.5em; clear:both;
	   max-width: 80%; border: 1px solid #dadada;}

		#message_box{bottom:100px; position: relative; }

		.bubble-left{float:left; margin-left:20px; background: #fff; border:1px solid #D0CFCF;}
		.bubble-left p{margin-top:0px; margin-left:5px; margin-right:5px; margin-bottom:0px;}
		.bubble-left p .nama {color: #42A1FF; display:block;}
		.bubble-left p .msgc { display:block;}
		.bubble-left p .date { color: #777; display: block; margin-top:6px; font-size:10px; text-align:left;}

		.bubble-right{ float: right; margin-right:20px; background: #e2ffc7;}
		.bubble-right p{margin-top:0px; margin-left:5px; margin-right:5px; margin-bottom:0px;}
		.bubble-right p .nama {color: #42A1FF; display:none;}
		.bubble-right p .msgc { display:block;}
		.bubble-right p .date { color: #777; display:block; margin-top:6px; font-size:10px; text-align:right;}

	}

	@media(min-width:481px) and (max-width:599px ){

		.bg-input{bottom:10px; position:fixed; height:100px; width:100%; }
		textarea.form-control {height:65px;}
		.flex-container{margin-right:10px; margin-left:10px;}
		.form-control-chat{border-radius:0%; width:100%;}
		.form-control:focus{border-color:unset; box-shadow:unset; border:2px solid #3F51B5;}
		.btn-kirim, .btn-gambar{border-radius:0%; width:100%; border:unset; background-color:#3F51B5;}
		.btn-kirim:hover{background-color:#3647A5;}
		.btn-gambar:hover{background-color:#3647A5;}
		.bg-button-smartphone{background-color:#881C1C; display:flex; align-items:center;}

		/*chat*/

		#chatku{margin-top:120px;}
		.bubble-left, .bubble-right{ line-height:100%; display: block; position: relative; padding:5px;
	   -webkit-border-radius: 11px; -moz-border-radius: 11px; margin-bottom: 1.5em; clear:both;
	   max-width: 80%; border: 1px solid #dadada;}

		#message_box{bottom:100px; position: relative; }

		.bubble-left{float:left; margin-left:10px; background: #fff; border:1px solid #D0CFCF;}
		.bubble-left p{margin-top:0px; margin-left:5px; margin-right:5px; margin-bottom:0px;}
		.bubble-left p .nama {color: #42A1FF; display:block;}
		.bubble-left p .msgc { display:block;}
		.bubble-left p .date { color: #777; display: block; margin-top:6px; font-size:10px; text-align:left;}

		.bubble-right{ float: right; margin-right:10px; background: #e2ffc7;}
		.bubble-right p{margin-top:0px; margin-left:5px; margin-right:5px; margin-bottom:0px;}
		.bubble-right p .nama {color: #42A1FF; display:none;}
		.bubble-right p .msgc { display:block;}
		.bubble-right p .date { color: #777; display:block; margin-top:6px; font-size:10px; text-align:right;}

	}

	@media(min-width:320px) and (max-width:480px ){

		.bg-input{bottom:10px; position:fixed; height:100px; width:100%; }
		textarea.form-control {height:65px;}
		.flex-container{margin-right:10px; margin-left:10px;}
		.form-control-chat{border-radius:0%; width:100%;}
		.form-control:focus{border-color:unset; box-shadow:unset; border:2px solid #3F51B5;}
		.btn-kirim, .btn-gambar{border-radius:0%; width:100%; border:unset; background-color:#3F51B5;}
		.btn-kirim:hover{background-color:#3647A5;}
		.btn-gambar:hover{background-color:#3647A5;}
		.bg-button-smartphone{background-color:#881C1C; display:flex; align-items:center;}

		/*chat*/

		#chatku{margin-top:120px;}
		.bubble-left, .bubble-right{ line-height:100%; display: block; position: relative; padding:5px;
	   -webkit-border-radius: 11px; -moz-border-radius: 11px; margin-bottom: 1.5em; clear:both;
	   max-width: 80%; border: 1px solid #dadada;}

		#message_box{bottom:100px; position: relative; }

		.bubble-left{float:left; margin-left:10px; background: #fff; border:1px solid #D0CFCF;}
		.bubble-left p{margin-top:0px; margin-left:5px; margin-right:5px; margin-bottom:0px;}
		.bubble-left p .nama {color: #42A1FF; display:block;}
		.bubble-left p .msgc { display:block;}
		.bubble-left p .date { color: #777; display: block; margin-top:6px; font-size:10px; text-align:left;}

		.bubble-right{ float: right; margin-right:10px; background: #e2ffc7;}
		.bubble-right p{margin-top:0px; margin-left:5px; margin-right:5px; margin-bottom:0px;}
		.bubble-right p .nama {color: #42A1FF; display:none;}
		.bubble-right p .msgc { display:block;}
		.bubble-right p .date { color: #777; display:block; margin-top:6px; font-size:10px; text-align:right;}
	}
</style>
