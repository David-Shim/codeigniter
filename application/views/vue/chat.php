<div id="test" class="d-none" style="position:fixed;bottom:0;right:0;z-index:100;">
    <div id='messages' style='width:300px;height:400px;background-color:yellow;white-space:pre;'></div>
    <textarea id='msg' rows='4' placeholder='Enter Message' autocomplete='off' required></textarea>
</div>

<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>
    var socket = io('http://localhost:3000');
</script>

<script>
    $('#msg').on('keydown', function(event) {
        if (event.keyCode == 13)
            if (!event.shiftKey){
                event.preventDefault();
                const msg = document.querySelector('#msg').value;
                if(msg==""||msg==null){
                    document.querySelector('#msg').focus();
                }else{
                    //Emit message to server
                    socket.emit('chat message', msg);
                    document.querySelector('#msg').value = '';
                    document.querySelector('#msg').focus();
                }  
            }
        }
    );


    //Message from server
    socket.on('message', message => {
        outputMessage(message);
    });

    //messages.appendChild(item);
    function outputMessage(message){
        //메세지 이름이랑 접속자랑 같은 경우랑 그렇지 않은 경우 나누어야 함
        if(message.username===username){
            const div = document.createElement('div');
            div.classList.add('clearfix');
            div.innerHTML = `<div class="from-me float-right" id="${message.chatting_id}"><p class="meta"><span>${message.time}</span></p>
                            <p class="text" style="white-space: pre-line;">${message.text}</p></div>`;
            document.querySelector('.chat-messages').appendChild(div);
        }else if(message.username=='ChatCord Bot'){
            console.log("Go Go 87");
        }else{
            const div = document.createElement('div');
            div.classList.add('clearfix');
            div.innerHTML = `<div class="message float-left" id="${message.chatting_id}"><p class="meta">${message.username} <span>${message.time}</span></p>
            <p class="text" style="white-space: pre-line;">${message.text}</p></div>`;
            document.querySelector('.chat-messages').appendChild(div);
        }
    }
</script>