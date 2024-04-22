$(document).ready(function() {
    var currentSlide = 0;
    var slides = $('.slide');
  
    function showSlide(index) {
      slides.removeClass('active');
      slides.eq(index).addClass('active');
    }
  
    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }
  
    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }
  
    $('.next').click(function() {
      nextSlide();
    });
  
    $('.prev').click(function() {
      prevSlide();
    });
  
    // Mostrar o primeiro slide
    showSlide(currentSlide);
  
    // Autoplay
    setInterval(nextSlide, 5000); // Troca o slide a cada 5 segundos
  });
  