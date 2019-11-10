var count = 0;
var timeTotal = 0;
var selected = 0;
var randomColors = [
    "blue",
    "red",
    "green",
    "orange",
    "purple",
    "pink",
    "blue",
    "red",
    "green",
    "orange",
    "purple",
    "pink",
    "blue",
    "red",
    "green", 
    "orange",
    "purple",
    "pink",
    "blue",
    "red",
    "green", 
    "orange",
    "purple",
    "pink",
    "blue",
    "red",
    "green", 
    "orange",
    "purple",
    "pink",
    "blue",
    "red",
    "green", 
    "orange",
    "purple",
    "pink",
];
var colors = shuffle(randomColors);
var square = document.querySelectorAll(".square");
var messageDisplay = document.querySelector("#message");
var h1 = document.querySelector("h1");
var startBtn = document.querySelector("#startBtn");
var rgbCode = document.getElementById("rgbCode");
var seconds = 0, minutes = 0, hours = 0;
var prevCardId = 'none';
var card1Col = 'none';
var card2Col = 'none';
var cardID = 'none';

startBtn.addEventListener("click", function(){
  startBtn.textContent = "";
  startBtn.style.background = "white";
  for(var i = 0; i < square.length; i++) {
      square[i].style.background = colors[i];
      square[i].style.display = "block";
  }
timer();
});

for(var i = 0; i < square.length; i++) {
    square[i].style.background = "#232323";
    square[i].addEventListener("click", function() {   
        if(count == 35)
            {
                this.style.background = "#232323";
                rgbCode.textContent = "Game Over";
                h1.style.background = "white";
                rgbCode.style.color = "black";
                clearTimeout(t);
                alert("Game completed in: " + timeTotal);
            }
        else
            {
                count++;
                var clickedColor = this.style.background;
                this.style.background = "#232323";
                h1.style.background = clickedColor;
                rgbCode.textContent = clickedColor;
                console.log(count);
                this.removeEventListener('click',arguments.callee,false);
            }
    }
)
}

function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;
  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
}

function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    messageDisplay.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
    
    timeTotal = messageDisplay.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    timer();
}

function timer() {
    t = setTimeout(add, 1000);
}