$(document).ready(function() {
    let score = 0;
    let canvas = document.getElementById('canvas');
    let ctx = canvas.getContext('2d');
    let i = 0;
    let randWidth = Math.floor(Math.random() * (canvas.width - 20));
    let colorArr = ['red', 'black', 'green', 'blue', 'yellow']
    let color = colorArr[Math.floor(Math.random() * colorArr.length)];
    let paddleHeight = 10;
    let paddleWidth = 75;
    let paddleX = (canvas.width - paddleWidth) / 2;
    let curColor = colorArr[Math.floor(Math.random() * colorArr.length)];
    $("#curColor").css('background', curColor);
    let loop = setInterval(function() {
        ctx.clearRect(randWidth, i - 10, 20, 20);
        ctx.beginPath();
        ctx.rect(randWidth, i, 20, 20);
        ctx.fillStyle = color;
        ctx.fill();
        ctx.closePath();
        if (randWidth > paddleX && randWidth < paddleX + paddleWidth && i + 20 === canvas.height - paddleHeight - 50) {
            if (color === curColor) {
                score++;

            } else {
                score--;
            }
            $("#score").html(`SCORE: ${score}`);
            ctx.clearRect(randWidth, i, 20, 20);
            curColor = colorArr[Math.floor(Math.random() * colorArr.length)];
            $("#curColor").css('background', curColor);
            color = colorArr[Math.floor(Math.random() * colorArr.length)];
            randWidth = Math.floor(Math.random() * canvas.width);
            i = 0;
        }
        if (i >= canvas.height - 20) {
            if (color === curColor) {
                score--;
                $("#score").html(`SCORE: ${score}`);
            }
            curColor = colorArr[Math.floor(Math.random() * colorArr.length)];
            $("#curColor").css('background', curColor);
            color = colorArr[Math.floor(Math.random() * colorArr.length)];
            randWidth = Math.floor(Math.random() * canvas.width);
            i = 0;
        }
        i += 10;

    }, 30)

    function drawPaddle() {
        ctx.beginPath();
        ctx.rect(paddleX, canvas.height - paddleHeight - 50, paddleWidth, paddleHeight);
        ctx.fillStyle = "#0095DD";
        ctx.fill();
        ctx.closePath();
    }
    drawPaddle();

    $("body").mousemove(function(e) {
        console.log(this.offsetLeft);
        ctx.clearRect(paddleX, canvas.height - paddleHeight - 50, paddleWidth, paddleHeight);

        if (e.clientX <= paddleWidth) {
            paddleX = 0;
        } else if (e.clientX >= canvas.width) {
            paddleX = canvas.width - paddleWidth;
        } else {
            paddleX = e.clientX - paddleWidth;
        }
        drawPaddle();

    })
    console.log(ctx);

})
