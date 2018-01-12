/************* CHAT *************/


var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var id_users = []; //qui va identificativo utente ogni volta che uno si collega
var receiver_message = []; //qua va username interlocutore 


app.get('/', function(req, res){
  res.sendFile('/resources/home.blade.php');
});

io.on('connection', function(socket){
	console.log('other user connected to the chat');
	//console.log(socket.id);

	io.emit('new message', { 
		username: socket.id,
		message: "sei connesso alla chat"
	});

	//set dentro alla var globale l'id del mio utente con cui sono loggato
	socket.on('identified', function(data) {
		id_users[data.nickname] = socket.id;
		console.log("NICKNAME -----> " + data.nickname);
		console.log("ID_USERS[DATA]: " + id_users[data.nickname]);
	});

	//set dentro alla var globale l'id dell'utente con cui voglio comunicare
	socket.on('receiver', function(data) {
		receiver_message[data.my_identifier] = data.nick_receiver;
		console.log("DATA RECEIVER: " + data);
		console.log("DATA MY_IDENTIFIER: " + data.my_identifier);
		console.log("DATA NICK_RECEIVER: " + data.nick_receiver);
		console.log("ID_SOCKET" + id_users[data.nick_receiver]);
		console.log("RECEIVER_MESS AL POSTO "+data.my_identifier+" -------------> " + receiver_message[data.my_identifier]);
	});

	//cambio interlocutore quando cambio la tab nella chat
	socket.on('change context', function(data) {
		console.log("CHANGE_CONTEXT-----MESSAGGIO DA " + data.my_identifier);
		console.log("CHANGE_CONTEXT-----MESSAGGIO A LUI ---------> " + data.nick_receiver);
		console.log("MESSAGGIO INIZIALMENTE A......" + receiver_message[data.my_identifier]);
		receiver_message[data.my_identifier] = data.nick_receiver;
		console.log("CHANGING............." + receiver_message[data.my_identifier]);
		console.log("NEW SOCKET TO SEND MESSAGE......." + id_users[receiver_message[data.my_identifier]]);
	});

	//invio del messaggio
	socket.on('chat message', function(data) {
		console.log("CORPO DEL MESSAGGIO -------> " + data.body);
		console.log("MESSAGGIO A LUI ---------> " + id_users[receiver_message[data.id_utente]]);
		socket.to(id_users[receiver_message[data.id_utente]]).emit('mess', {
			body: data.body, 
			id_utente: data.id_utente
		});
	});
});

// appN.get('/', function(req,res) {
// 	res.sendFile('/resources/index.blade.php');
// });

// ioN.on('connection', function(socket) {
// 	console.log("Connected");
// 	//Notifiche
// 	socket.on('friend_request', function(data) {
// 		console.log("NOTIFICA DI RICHIESTA D'AMICIZIA DA UTENTE ID: " + data.user_requester);
// 		console.log("NOTIFICA DI RICHIESTA D'AMICIZIA A UTENTE ID: " + data.user_receiver);
// 		//socket.to(id_users[receiver_message])
// 	});
// });


//utente disconnesso
io.on('connection', function(socket){
	socket.on('disconnect', function(){
	    console.log('user disconnected');
	  });
});

//server in ascolto sulla porta 65000
http.listen(65000, function(){
  console.log('listening on *:65000');
});