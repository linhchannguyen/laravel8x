var io = require("socket.io")(6001, {
    cors: {
        origin: "http://localhost",
        methods: ["GET", "POST"]
    }
});
var Redis = require('ioredis')
var redis = new Redis(6380)
io.on('error', function (socket) {
    console.log('error')
})
io.on('connection', function (socket) {
    console.log('Connected ' + socket.id)
})
redis.psubscribe('*', function (error, count) {
})
redis.on('pmessage', function (partner, channel, message) {
    message = JSON.parse(message)
    io.emit(channel, message.data)//Chổ này channel này chính là channel trong redis, tên của nó được thiết lặp ở REDIS_PREFIX. Nếu kết nối mà không đúng tên channel sẽ lỗi
})