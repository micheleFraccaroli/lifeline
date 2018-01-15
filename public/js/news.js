/************* NOTIFICHE *************/

var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var id_users = []; //qui va identificativo utente ogni volta che uno si collega
var receiver_notification = []; //qua va username interlocutore 

app.get('/', function(req, res){
  res.sendFile('/resources/index.blade.php');
});

io.on('connection', function(socket){
	console.log('other user connected to the notification for friendship request');
	io.emit('new message', { 
		username: socket.id,
		message: "sei connesso alle notifiche"
	});

	//set dentro alla var globale l'id del mio utente con cui sono loggato
	socket.on('friend_identified', function(data) {
		id_users[data.my_id] = socket.id;
		console.log("MIO ID ========> " + data.my_id);
		console.log("SOCKE MIA ===========> " + id_users[data.my_id]);
	});

	socket.on('friend_request', function(data) {
		console.log("RICHIESTA D'AMICIZIA DA UTENTE CON ID -------> " + data.user_requester);
		console.log("RICHIESTA D'AMICIZIA PER UTENTE CON ID -------> " + data.user_receiver);
		receiver_notification[data.user_requester] = data.user_receiver;
		console.log(receiver_notification[data.my_identifier] = data.user_receiver);
		console.log("SOCKET DEL RICEVENTE DALLA NOTIFICA: " + id_users[receiver_notification[data.user_requester]])
		socket.to(id_users[receiver_notification[data.user_requester]]).emit('send_fr_req', {
			news: "Richiesta di amicizia"
		});
	});

	socket.on('friend_response', function(data) {
		console.log("RISPOSTA D'AMICIZIA PER UTENTE CON ID -------> " + data.user_resp_receiver);
		console.log("IDIDIDIDIDID---> " + receiver_notification[data.user_resp_receiver]);
		console.log("mia socket --------> " + id_users[data.user_resp_receiver]);
		socket.to(id_users[data.user_resp_receiver]).emit('friend_resp', {
			news: "Risposta alla richiesta"
		});
	});
});

//utente disconnesso
io.on('connection', function(socket){
	socket.on('disconnect', function(){
	    console.log('user disconnected from notification');
	});
});

//server in ascolto sulla porta 65000
http.listen(65001, function(){
  console.log('listening on *:65001');
});