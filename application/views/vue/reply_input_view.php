<div class="container">
    <div class="row">
        <div class="col">
            <p id="first_name">{{ first_name }}</p>
        </div>
        <div id="reply_contents" class="col-11">
            <input v-model="notice_id" type="hidden" name="notice_id" value="<?php echo $details[0]['notice_id']?>">
            <input v-model="content" type="text" class="form-control" name="reply_content" placeholder="공개 댓글 추가...">
        </div>
    </div>
    <div class="clearfix">
        <div class="float-right">
            <button type="button" class="btn btn-sm">취소</button><button class="btn btn-dark btn-sm">댓글</button>
        </div>
    </div>
</div>