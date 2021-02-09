<div class="container" id="board">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>글쓴이</th>
        </tr>
    </thead>
    <!--{{datum.notice_id}}가 아니고 바로 datum.notice_id로 가지고 왔음-->
    <tbody id="content">
        <tr v-for="datum in contents"  v-on:click="details(datum.notice_id)">
            <td>{{datum.notice_id}}</td>
            <td>{{datum.notice_title}}</td>
            <td>{{datum.user_full_name}}</td>
        </tr>
    </tbody>
</table>
<button class="btn btn-info" type="button" id="show-modal" @click="showModal = true">글쓰기</button>
<modal v-if="showModal" @close="showModal = false">
    <h3 slot="header" class="text-info">MEMENT에 글 올리기</h3>
    <div slot="body">
        <input class="form-control" type="text" placeholder="제목을 입력하세요" ref="comment_title" v-model="comment_title">
        <textarea class="form-control" rows="10" placeholder="자유롭게 작성해 보세요" ref="comment" v-model="comment" required></textarea>
    </div>
    <div slot="footer">
        <button class="btn btn-info modal-default-button" @click="submit_content">
            저장하기
        </button>
    </div>
</modal>
</div>


<script type="text/x-template" id="modal-template">
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                <div class="modal-header">
                    <slot name="header">
                    default header
                    </slot>
                    <i class="fas fa-times btn" @click="$emit('close')"></i>
                </div>
                <div class="modal-body">
                    <slot name="body">
                    
                    </slot>
                    
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                    </slot>
                </div>
                </div>
            </div>
        </div>
    </transition>
</script>
<script>
var get_url = window.location.href;
var last_url_value = Number(get_url.split("/").pop());
var axiosDataLoadLink = 'http://pyoungsub.devleaguer.com///codeigniter/mement/board_data/'+last_url_value;
var aixosContentInputLink = "http://pyoungsub.devleaguer.com///codeigniter/mement/comment/"+last_url_value;
Vue.component('modal', {
  template: '#modal-template'
})

new Vue({
    el: '#board',
    data () {
        return {
            contents: null,
            showModal: false,
            comment_title: null,
            comment: null
        }
    },
    created () {
        axios
        .get(axiosDataLoadLink)
        .then(
            response => (
                this.contents = response['data']['contents']
            )
        )
    },
    methods: {
        details(page_number){
            location.href='/codeigniter/mement/details/'+page_number;
        },
        submit_content(){
            if(this.comment_title==null||this.comment_title==""){
                this.$refs.comment_title.focus();
            }else if(this.comment==null||this.comment==""){
                this.$refs.comment.focus();
            }else{
                axios
                .get(aixosContentInputLink,{
                    params:{
                        comment_title: this.comment_title,
                        comment: this.comment
                    }
                })
                .then(
                    response => (
                        window.location.reload()
                    )

                )
            }
        }
    }
})
</script>



<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 600px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>