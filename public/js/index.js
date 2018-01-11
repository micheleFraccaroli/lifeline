var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var id_users = []; //qui va identificativo utente ogni volta che uno si collega
var receiver_message = []; //qua va username interlocutore 

app.get('/', function(req, res){
  res.sendFile('/resources/home.blade.php');
});

io.on('connection', function(socket){
	console.log('other user connected');
	//console.log(socket.id);

	io.emit('new message', { 
		username: socket.id,
		message: "sei connesso"
	});

	//set dentro alla var globale l'id del mio utente con cui sono loggato
	socket.on('identified', function(data) {
		id_users[data.nickname] = socket.id;
		console.log("DATA: " + data);
		console.log("NICKNAME -----> " + data.nickname);
		console.log("ID_USERS[DATA]: " + id_users[data.nickname]);
	});

	//set dentro alla var globaòe l'id dell'utente con cui voglio comunicare
	socket.on('receiver', function(data) {
		receiver_message[data.my_identifier] = data.nick_receiver;
		console.log("DATA RECEIVER: " + data);
		console.log("DATA MY_IDENTIFIER: " + data.my_identifier);
		console.log("DATA NICK_RECEIVER: " + data.nick_receiver);
		console.log("ID_SOCKET" + id_users[data.nick_receiver]);
		console.log("RECEIVER_MESS -------------> " + receiver_message[data.my_identifier]);
	});

	socket.on('chat message', function(data) {
		console.log("CORPO DEL MESSAGGIO -------> " + data.body);
		console.log("MESSAGGIO A LUI ---------> " + id_users[receiver_message[data.id_utente]]);
		socket.to(id_users[receiver_message[data.id_utente]]).emit('mess', data.body);
	});
	
});

io.on('connection', function(socket){
	socket.on('disconnect', function(){
	    console.log('user disconnected');
	  });
});

http.listen(65000, function(){
  console.log('listening on *:65000');
});