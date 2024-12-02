function createWebSocket(lever) {
    const socket = new WebSocket(server);
    socket.onmessage = function (event) {
        var receivedData = JSON.parse(event.data);
        handleSocketEvent(receivedData);
    };
    socket.onclose = function (event) {
        console.log('WebSocket connection closed. Reconnecting...');
        setTimeout(function() {
            createWebSocket(lever);
        }, 3000);
    };
    socket.onopen = function(event) {
        socket.send(JSON.stringify({ leverr: lever }));
    };
    return socket;
}
const socket = createWebSocket(lever);
function handleSocketEvent(data) {
    if (data.type === 'tablePhone') {
        loadtablePhone(null, {
            success: true,
            data: data.data
        });
    }
    if (data.type === 'loadhisuser') {
        loaddatahisuer(null, {
            success: true,
            data: data.data
        });
    }
    if (data.type === 'tableHistory') {
        loadtableHistory(null, {
            success: true,
            data: data.data
        });
    }
}