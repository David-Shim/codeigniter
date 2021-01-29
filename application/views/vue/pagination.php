<div class="container">
<ul id="pagination" class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" v-on:click="linkTo(pre_page)">Previous</a></li>
    <li v-for="item in page_numbers" class="page-item" :class="{'active' : item.i == representNumber}">
        <a class="page-link" v-on:click="linkTo(item.i)">
        {{item.i}}
        </a>
    </li>
    <li class="page-item"><a class="page-link" v-on:click="linkTo(next_page)">Next</a></li>
</ul>
</div>
<script>
var pagination = new Vue({
    el:'#pagination',
    data() {
        return  {
            representNumber: last_url_value,
            pre_page: last_url_value-1,
            next_page: last_url_value+1,
            page_numbers:[]
        }
    },
    computed:{
        get_the_first(){
            return Math.ceil((this.representNumber)/10)*10-9
        },
        get_the_last(){
            return Math.ceil((this.representNumber)/10)*10
        }
    },
    methods:{
        linkTo(page_number){
            location.href='/codeigniter/mement/board/'+page_number;
        }
    }
})
var i;
for(i=pagination.get_the_first;i<=pagination.get_the_last;i++){
    pagination.page_numbers.push({
        i
    })
}
//get the page number and show the pagination which is setted multiples of 10
//Here is an example above scenario
//if the number of the page is 13, the pagination represents numbers from 11 to 20
//if the number of the page is 3, the pagination represents numbers from 1 to 10
//what if the number of the page is 20? The pagination has to represent 11 to 20
</script>