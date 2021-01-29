<div class="container">
	<div class="clearfix">
		<div class="float-left">
			<h2>게시판입니다.</h2>
		</div>
		<div class="float-right">
		</div>
	</div>
    <table class="table table-hover">
		<thead>
			<tr>
			<th>번호</th>
			<th>작성자</th>
			<th>제목</th>
			<th>작성일</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($get_data as $row) : ?>
			<tr class="clickable-row" data-href="http://localhost/codeigniter/mement/details/<?php echo $row['notice_id']?>">
				<td><?php echo $row['notice_id']?></td>
				<td><?php echo $row['user_full_name']?></td>
				<td><?php echo $row['notice_title']?></td>
				<td><?php echo $row['reg_date']?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
    </table>
	<div class="container-flude">
		<div class="clearfix">
			<div class="float-left">
				
			</div>
			<div class="float-right">
				<button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#write_modal">글쓰기</button>
			</div>
		</div>
	</div>
</div>

<script>
//게시판 row 클릭하면 해당 링크로 가게
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

<!-- write_modal Header -->
<div class="modal fade" id="write_modal">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- write_modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">MEMENT 글쓰기</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

			<form method="post" action="http://localhost/codeigniter/mement/comment">
            <!-- write_modal body -->
            <div class="modal-body">
				<div class="form-group">
					<label for="comment">제목:</label>
					<input class="form-control" rows="10" id="comment_title" name="comment_title" required>
				</div>
				<div class="form-group">
					<label for="comment">내용:</label>
					<textarea class="form-control" rows="10" id="comment" name="comment" required></textarea>
				</div>
            </div>
            
            <!-- write_modal footer -->
            <div class="modal-footer">
            	<button type="submit" class="btn btn-danger">저장</button>
			</div>
			</form>
        </div>
    </div>
</div>