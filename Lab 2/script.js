function myQuestion1() {
    var x = document.getElementById("question1");
    if (x.innerHTML === "Show Answer") {
        x.innerHTML = "Hide Answer";
    } else {
        x.innerHTML = "Show Answer";
    }
}
            
function myQuestion2() {
    var x = document.getElementById("question2");
    if (x.innerHTML === "Show Answer") {
        x.innerHTML = "Hide Answer";
    } else {
        x.innerHTML = "Show Answer";
    }
}

function myQuestion3() {
    var x = document.getElementById("question3");
    if (x.innerHTML === "Show Answer") {
        x.innerHTML = "Hide Answer";
    } else {
        x.innerHTML = "Show Answer";
    }
}

function myAnswer1() {
    var x = document.getElementById("myA1");
    if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
    } else {
        x.style.visibility = "hidden";
    }
}
            
function myAnswer2() {
    var x = document.getElementById("myA2");
    if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
    } else {
        x.style.visibility = "hidden";
    }
}
            
function myAnswer3() {
    var x = document.getElementById("myA3");
    if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
    } else {
        x.style.visibility = "hidden";
    }
}
            
function myTime() {
    setInterval(function(){ document.getElementById('timeslot').innerHTML = "<span>"+Date()+"</span>" }, 1000);
}

var input = document.querySelector('input')
function colour0() {
    var randomColor = "#"+((1<<24)*Math.random()|0).toString(16);
}
            
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}