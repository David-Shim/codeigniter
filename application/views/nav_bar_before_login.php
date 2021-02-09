<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="#">MEMENT</a>
        <!-- Links -->
        <ul class="navbar-nav navbar-right">
            <!-- Dropdown -->
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#login_modal"><i class="fas fa-sign-in-alt fa-fw"></i> 로그인</a>
                    <a class="dropdown-item" type="button" data-toggle="modal" data-target="#signin_login_modal"><i class="fas fa-user-plus fa-fw"></i> 회원가입</a>
                </div>
            </div>
        </ul>
    </div>
</nav>
<div style="height:20px;"></div>

<!-- login_modal Header -->
<div class="modal fade" id="login_modal">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- login_modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">MEMENT 로그인 하기</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <!-- login_modal body -->
            <div class="modal-body">
                <form method="post" action="http://pyoungsub.devleaguer.com///codeigniter/mement/login">
                    <div class="form-group">
                       <label for="user_email"><i class="far fa-envelope fa-fw"></i> 이메일 주소</label> <input type="email" class="form-control" id="user_email" name="user_email" required>
                    </div>
                    <div class="form-group">
                        <label for="user_pw"><i class="fas fa-lock fa-fw"></i> 비밀번호</label> <input type="password" class="form-control" id="user_password" name="user_password" required>
                    </div>
            </div>
            
            <!-- login_modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">로그인</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- signin_login_modal Header -->
<div class="modal fade" id="signin_login_modal">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- signin_login_modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">MEMENT 회원가입</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            
            <!-- signin_login_modal body -->
            <div class="modal-body">
            Modal body..
            </div>
            
            <!-- signin_login_modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>