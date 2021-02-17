const app = require('express')();
const http = require('http').Server(app);
const io = require('socket.io')(http,{
	cors: {origin:"*"}
});
const port = 3000;

io.on('connection', (socket) => {
    console.log('a user connected');
    socket.on('disconnect', () => {
      	console.log('user disconnected');
    });
});

//Run when client connects
io.on('connection', (socket) => {
	
	socket.on('chat message', (roomName)=>{
		socket.join(roomName);
		console.log(roomName);
	})
	
	socket.on('chat test', ({roomName, user_id, username})=>{
		console.log(roomName);
		console.log(user_id);
		console.log(username);
	})

	//Listen for chatMessage
	/*
    socket.on('chat message', msg=>{
		console.log(msg.roomName);
		console.log(msg.user_id);
		console.log(msg.username);
		console.log(msg.msg);
    });
	*/
});

http.listen(port, () => {
  	console.log('listening on *:'+port);
});