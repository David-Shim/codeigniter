<script>
$( document ).ready(function() {
    axios.get('http://http://pyoungsub.devleaguer.com//codeigniter/mement/test1/<?php echo $details[0]['notice_id']?>')
    .then(function(response) {
        console.log(response);
        var app = new Vue({
            el: '#content',
            data: {
                result: response
            }
        })
    })
    .catch(function(error) {
        console.log(error);
    });
});
</script>