<div class="container">    
    <?php foreach ($replies as $row):?>
        <p><?php echo $row['first_name']?><br>
            <?php echo $row['reply_content']?><br>
            <i class="far fa-thumbs-up"></i>2 <i class="far fa-thumbs-down"></i>
            <span style="cursor: pointer;" onclick="reply_input_show(<?= $row['reply_id']?>);" class="_<?= $row['reply_id']?>">답글</span>
            <div id="<?= $row['reply_id']?>" style="display:none;">
                <div class="row">
                    <div class="col">
                        <p><?php echo $first_name?></p>
                    </div>
                    <div class="col-11">
                        <input id="<?php echo $row['reply_id']?>" type="hidden" name="reply_id" value="<?php echo $row['reply_id']?>">
                        <input id="_<?php echo $details[0]['notice_id'].$row['reply_id']?>" type="text" class="form-control" name="reply_content" placeholder="공개 답글 추가...">
                    </div>
                </div>
                <div class="clearfix">
                    <div class="float-right">
                        <button type="button" class="btn btn-sm" onclick="reply(<?= $row['reply_id']?>);">취소</button><button type="button" class="btn btn-dark btn-sm" onclick="submit_re_reply(<?= $row['reply_id']?>)">답글</button>
                    </div>
                </div>
            </div>
            <div id="_<?php echo $row['reply_id']?>">
            </div>
        </p>
    <?php endforeach;?>
</div>
<!--추후에 대댓글 불러오는거 여기다 쓰면 됨-->
<?php foreach ($re_replies as $row):?>
    <script>
        $('#_<?php echo $row['reply_id']?>').append("Re: <?php echo $row['first_name']." ".$row['content']." ".$row['reg_date']?><br>");
    </script>
<?php endforeach;?>

<script>
    function reply(reply_id){
        $(`#${reply_id}`).hide();
    }
    function reply_input_show(reply_id){
        $(`#${reply_id}`).show();
    }
    function submit_re_reply(reply_id){
        var details_page= "<?php echo $details[0]['notice_id']?>";
        var re_reply_content = $(`#_<?php echo $details[0]['notice_id']?>${reply_id}`).val();
        $.post("http://pyoungsub.devleaguer.com/codeigniter/mement/re_reply",{
            notice_id: details_page,
            reply_id: reply_id,
            content: re_reply_content
        },
        function(data,status){
            $(`#_<?php echo $details[0]['notice_id']?>${reply_id}`).val(null);
            $(`#${reply_id}`).hide();
            //업로드 된 데이터 답글 밑에 붙이기
            $(`#_${reply_id}`).append(data);
        });
    }
</script>