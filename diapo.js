var slideIndex = 0;
showSlides();

function showSlides() {
  var slides = document.getElementsByClassName("slide");
  for (var i = 0; i < slides.length; i++) {
    slides[i].addEventListener("click", function() {
      window.location.href = this.parentElement.getAttribute("href");
    });
    slides[i].classList.remove("active");
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].classList.add("active");
  setTimeout(showSlides, 5000);
}

function plusSlides(n) {
  slideIndex += n;
  var slides = document.getElementsByClassName("slide");
  if (slideIndex < 1) {
    slideIndex = slides.length;
  }
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  for (var i = 0; i < slides.length; i++) {
    slides[i].classList.remove("active");
  }
  slides[slideIndex - 1].classList.add("active");
}
