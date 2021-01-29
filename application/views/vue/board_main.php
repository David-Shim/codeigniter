<div class="container" id="board">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>글쓴이</th>
        </tr>
    </thead>
    <tbody id="content">
        <tr v-for="datum in contentList"  v-on:click="details(datum.notice_id)"><!--{{datum.notice_id}}가 아니고 바로 datum.notice_id로 가지고 왔음-->
            <td>{{datum.notice_id}}</td>
            <td>{{datum.notice_title}}</td>
            <td>{{datum.user_full_name}}</td>
        </tr>
    </tbody>
</table>
</div>
<script>
$( document ).ready(function() {
    var get_url = window.location.href;
    var last_url_value = get_url.split("/").pop();
    axios.get('http://localhost/codeigniter/mement/board_data/'+last_url_value)
    .then(function(response) {
        console.log(response);

        var app = new Vue({
            el:'#board',
            data: {
                contentList: [
                    { notice_id: response['data'][0]['notice_id'],notice_title: response['data'][0]['notice_title'],user_full_name: response['data'][0]['user_full_name'] },
                    { notice_id: response['data'][1]['notice_id'],notice_title: response['data'][1]['notice_title'],user_full_name: response['data'][1]['user_full_name'] },
                    { notice_id: response['data'][2]['notice_id'],notice_title: response['data'][2]['notice_title'],user_full_name: response['data'][2]['user_full_name'] },
                    { notice_id: response['data'][3]['notice_id'],notice_title: response['data'][3]['notice_title'],user_full_name: response['data'][3]['user_full_name'] },
                    { notice_id: response['data'][4]['notice_id'],notice_title: response['data'][4]['notice_title'],user_full_name: response['data'][4]['user_full_name'] },
                    { notice_id: response['data'][5]['notice_id'],notice_title: response['data'][5]['notice_title'],user_full_name: response['data'][5]['user_full_name'] },
                    { notice_id: response['data'][6]['notice_id'],notice_title: response['data'][6]['notice_title'],user_full_name: response['data'][6]['user_full_name'] },
                    { notice_id: response['data'][7]['notice_id'],notice_title: response['data'][7]['notice_title'],user_full_name: response['data'][7]['user_full_name'] },
                    { notice_id: response['data'][8]['notice_id'],notice_title: response['data'][8]['notice_title'],user_full_name: response['data'][8]['user_full_name'] },
                    { notice_id: response['data'][9]['notice_id'],notice_title: response['data'][9]['notice_title'],user_full_name: response['data'][9]['user_full_name'] }
                ]
            },
            methods: {
                details: function (page_number) {
                    location.href='/codeigniter/mement/details/'+page_number;
                }
            }
        });

    })
    .catch(function(error) {
        console.log(error);
    });
});
</script>