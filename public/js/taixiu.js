
    // Lấy tham chiếu đến các phần tử DOM

  
    var imgToggle2 = document.getElementById("toggle-img2");
    var gameTaixiu = document.getElementById("game-taixiu");
    var imgToggle = document.getElementById("toggled");
    // Hàm để ẩn/hiện bảng
    function toggleGameTaixiu() {
      if (gameTaixiu.style.display === "none") {
        gameTaixiu.style.display = "block";
      } else {
        gameTaixiu.style.display = "none";
      }
    }

    // Bắt sự kiện click trên nút
    imgToggle.addEventListener("click", toggleGameTaixiu);
    imgToggle2.addEventListener("click", toggleGameTaixiu);
    // Bắt sự kiện click trên ảnh
 

var mainGame = document.querySelector('.khung-tx');
var startDragX, startDragY;

// Xử lý sự kiện khi bắt đầu kéo khung game trên PC
mainGame.addEventListener('mousedown', function(event) {
  startDragX = event.clientX - mainGame.offsetLeft;
  startDragY = event.clientY - mainGame.offsetTop;

  document.addEventListener('mousemove', dragGame);
});

// Xử lý sự kiện khi kết thúc kéo khung game trên PC
document.addEventListener('mouseup', function() {
  document.removeEventListener('mousemove', dragGame);
});

// Xử lý sự kiện khi bắt đầu kéo khung game trên điện thoại di động
mainGame.addEventListener('touchstart', function(event) {
  var touch = event.touches[0];

  startDragX = touch.clientX - mainGame.offsetLeft;
  startDragY = touch.clientY - mainGame.offsetTop;

  document.addEventListener('touchmove', dragGame);
});

// Xử lý sự kiện khi kết thúc kéo khung game trên điện thoại di động
document.addEventListener('touchend', function() {
  document.removeEventListener('touchmove', dragGame);
});

// Hàm xử lý khi di chuyển chuột hoặc chạm trên khung game
function dragGame(event) {
  if (event.type === 'mousemove') {
    var newLeft = event.clientX - startDragX;
    var newTop = event.clientY - startDragY;
  } else if (event.type === 'touchmove') {
    var touch = event.touches[0];
    var newLeft = touch.clientX - startDragX;
    var newTop = touch.clientY - startDragY;
  }

  mainGame.style.left = newLeft + 'px';
  mainGame.style.top = newTop + 'px';
}