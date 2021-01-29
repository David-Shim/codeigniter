<!--본문-->
<div id="app" class="container">
    <div>
        게시글 번호: {{notice_id}}
    </div>
    <div>
        게시글 제목: {{notice_title}}
    </div>
    <div>
        게시자: {{user_full_name}}
    </div>
    <div style="white-space:pre-line;">
        {{main_contents}}
    </div>
    <input type="text" v-model="contentReply" :key="notice_id">
    <button type="button" @click="submitReply">댓글</button>
    <br>

    <div v-for="list in replies">
        <div>{{list.first_name}}    {{list.reg_date}}<br>
            {{list.reply_content}}<br>
            <i class="fas fa-thumbs-up"></i> 45 <i class="fas fa-thumbs-down"></i> 답글
            <div v-for="re_list in re_replies" v-if="list.reply_id==re_list.reply_id">
                &nbsp;&nbsp;&nbsp;&nbsp;{{re_list.first_name}}  {{re_list.content}}    {{re_list.reg_date}}
            </div>
            <!--
            <div v-if="list.number_of_re_re>=1" v-on:click="show_re_re">
                <i class="fas fa-sort-down"></i>답글 {{list.number_of_re_re}}개 보기
            </div>
            -->
        </div>
        <br>

        <!--
        <div v-for="test in re_replies" v-if="list.reply_id==test.reply_id">
            &nbsp;&nbsp;&nbsp;&nbsp;{{test.first_name}}  {{test.content}}    {{test.reg_date}}
        </div>
        -->
    </div>
    <br>
    <br>

    <div style="white-space:pre-line;">
        {{all_data}}
    </div>
</div>
<script>
var get_url = window.location.href;
var last_url_value = get_url.split("/").pop();
var axiosDataLoadLink = 'http://localhost/codeigniter/mement/api/'+last_url_value;
var replySubmitLink =   'http://localhost/codeigniter/mement/inputReply/'+last_url_value;

new Vue({
    el: '#app',
    data () {
        return {
            notice_id: null,
            notice_title: null,
            user_full_name: null,
            main_contents: null,
            replies: null,
            re_replies: null,
            all_data: null,
            contentReply: "공개 댓글 추가..."
        }
    },
    watch: {
        contentReply(){
            console.log(this.contentReply);
        }
    },
    created () {
        axios
        .get(axiosDataLoadLink)
        .then(
            response => (
                this.notice_id = response['data']['content'][0]['notice_id'],
                this.notice_title = response['data']['content'][0]['notice_title'],
                this.user_full_name = response['data']['content'][0]['user_full_name'],
                this.main_contents = response['data']['content'][0]['main_contents'],
                this.replies = response['data']['replies'],
                this.re_replies = response['data']['re_replies'],
                this.all_data = response['data']
            )
        )
    },
    methods: {
        submitReply(){
            //console.log(this.notice_id);
            axios.get(replySubmitLink,{
                params:{
                    replyContent: this.contentReply
                }
            })
            .then(function(response){
                console.log(response.data);
            })
            .catch(function(error){
                console.log(error);
            })
            this.contentReply = "공개 댓글 추가...";
        }
    }
})
</script>