<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Demo chat</title>
    <style>
        * {
            font-family: 'Avenir';
        }

        .bubbleWrapper {
            padding: 10px 10px;
            display: flex;
            justify-content: flex-end;
            flex-direction: column;
            align-self: flex-end;
            color: #fff;
        }

        .inlineContainer {
            display: inline-flex;
        }

        .inlineContainer.own {
            flex-direction: row-reverse;
        }

        .inlineIcon {
            width: 20px;
            object-fit: contain;
        }

        .ownBubble {
            min-width: 60px;
            max-width: 700px;
            padding: 14px 18px;
            margin: 6px 8px;
            background-color: #5b5377;
            border-radius: 16px 16px 0 16px;
            border: 1px solid #443f56;

        }

        .otherBubble {
            min-width: 60px;
            max-width: 700px;
            padding: 14px 18px;
            margin: 6px 8px;
            background-color: #6C8EA4;
            border-radius: 16px 16px 16px 0;
            border: 1px solid #54788e;

        }

        .own {
            align-self: flex-end;
        }

        .other {
            align-self: flex-start;
        }

        span.own,
        span.other {
            font-size: 14px;
            color: grey;
        }
    </style>
</head>

<body>
    <div>
        @foreach($users as $value)
        <a href="{{route('login', ['id' => $value->id])}}">{{$value->name}}</a>&nbsp;&nbsp;&nbsp;
        @endforeach
        <br>
        <br>
    </div>
    <div id="chat" style="width:50%;">
        @foreach($messages as $value)
        @if($value->auth != Session::get('id'))
        <div class="bubbleWrapper">
            <div class="inlineContainer">
                <img class="inlineIcon" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png">
                <div class="otherBubble other">
                    {{$value->contents}}
                </div>
            </div><span class="other">{{date('H:i:s', strtotime($value->created_at))}}</span>
        </div>
        @else
        <div class="bubbleWrapper">
            <div class="inlineContainer own">
                <img class="inlineIcon" src="https://www.pinclipart.com/picdir/middle/205-2059398_blinkk-en-mac-app-store-ninja-icon-transparent.png">
                <div class="ownBubble own">
                    {{$value->contents}}
                </div>
            </div><span class="own">{{date('H:i:s', strtotime($value->created_at))}}</span>
        </div>
        @endif
        @endforeach
    </div>
    <br>
    <br>
    <br>
    <input type="hidden" class="message-auth" name="auth" value="{{Session::get('id')}}">
    <input class="message-contents" name="contents" value="">
    <button onclick="chat()" type="submit">Send</button>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.6.0/socket.io.js"></script>
    <script>
        var user = `{{Session::get('id')}}`;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var socket = io('http://localhost:6001')
        socket.on("presence-chat", function(data) {
            var date = new Date(data.message.created_at);
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            var hour = hours + ":" + minutes + ":" + seconds;
            if ($('#' + data.message.id).length == 0) {
                if (data.message.auth != user) {
                    $str = `
                        <div class="bubbleWrapper">
                            <div class="inlineContainer">
                                <img class="inlineIcon" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png">
                                <div class="otherBubble other">
                                    ` + data.message.contents + `
                                </div>
                            </div><span class="other">` + hour + `</span>
                        </div>`;
                } else {
                    $str = `
                        <div class="bubbleWrapper">
                            <div class="inlineContainer own">
                                <img class="inlineIcon" src="https://www.pinclipart.com/picdir/middle/205-2059398_blinkk-en-mac-app-store-ninja-icon-transparent.png">
                                <div class="ownBubble own">
                                    ` + data.message.contents + `
                                </div>
                            </div><span class="own">` + hour + `</span>
                        </div>`;
                }
                $('#chat').append($str)
            }
        })

        function chat() {
            $.ajax({
                method: 'post',
                url: 'http://localhost/laravel8x/public/message/chat',
                data: {
                    auth: $('.message-auth').val(),
                    contents: $('.message-contents').val()
                },
                success: function(result, status, xhr) {},
                error: function(ajaxContext) {
                    console.log(ajaxContext)
                }
            })
            $('.message-contents').val("")
        }
    </script>
</body>

</html>