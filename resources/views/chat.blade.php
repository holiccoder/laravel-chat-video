<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Room</title>
</head>
<body>
    <div id="chat">
        <ul id="messages"></ul>
    </div>
    <input type="text" id="message" placeholder="Type your message here...">
    <button onclick="sendMessage()">Send</button>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('chat');
        channel.bind('new-message', function(data) {
            var messages = document.getElementById('messages');
            var li = document.createElement('li');
            li.appendChild(document.createTextNode(data.message));
            messages.appendChild(li);
        });

        function sendMessage() {
            var message = document.getElementById('message').value;
            fetch('/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            }).then(response => response.json())
              .then(data => console.log(data));
        }
    </script>
</body>
</html>