<div class="container" style="height:100%;overflow:hidden;">
    <div id="chat_room">
        <h3>MEMENT Chat</h3>
        <div id="branch" class="list-group" style="overflow-y:scroll;max-height:700px;">
            <a class="list-group-item list-group-item-action btn" v-for="list in branch_list" v-on:click="getChatRoom(list.branch_name)">{{list.branch_name}}</a>
        </div>
    </div>
</div>
<script>
var branch = new Vue({
    el:'#branch',
    data() {
        return  {
            branch_list: null,
            list_url: "http://localhost/codeigniter/mement/branch_list",
            user_name: null,
            chat_log: null
        }
    },
    created() {
        axios
        .get(this.list_url)
        .then(
            response => (
                this.branch_list = response['data']
            )
        )
    },
    methods: {
        getChatRoom(roomName){
            axios.get("../user_config")
            .then(
                response => (
                    console.log(response.data),
                    console.log(roomName),
                    $('#test').removeClass("d-none"),
                    $('#messages').html(""),
                    user_id = response.data.user_id,
                    username = response.data.username,
                    socket.emit('chat test', { user_id, username, roomName})
                )
            )
        }
    }
})
</script>