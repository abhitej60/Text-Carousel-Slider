document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tcp-slider-wrapper').forEach(function (wrapper) {
      const container = wrapper.querySelector('.tcp-slider-container');
      const slides = wrapper.querySelectorAll('.tcp-slide');
      const nextBtn = wrapper.querySelector('.tcp-next');
      const prevBtn = wrapper.querySelector('.tcp-prev');
  
      const desktopSlides = parseInt(wrapper.dataset.slidesDesktop) || 1;
      const tabletSlides = parseInt(wrapper.dataset.slidesTablet) || 1;
      const mobileSlides = parseInt(wrapper.dataset.slidesMobile) || 1;
  
      let currentIndex = 0;
      let slidesToShow = 1;
  
      function getSlidesToShow() {
        if (window.innerWidth <= 480) return mobileSlides;
        if (window.innerWidth <= 768) return tabletSlides;
        return desktopSlides;
      }
  
      function updateSlider() {
        slidesToShow = getSlidesToShow();
        const slideWidth = wrapper.offsetWidth / slidesToShow;
        slides.forEach((slide) => {
          slide.style.flex = `0 0 ${slideWidth}px`;
        });
  
        if (currentIndex > slides.length - 1) currentIndex = 0;
        if (currentIndex < 0) currentIndex = slides.length - 1;
  
        const offset = currentIndex * (wrapper.offsetWidth / slidesToShow);
        container.style.transform = `translateX(${-offset}px)`;
      }
  
      nextBtn?.addEventListener('click', () => {
        currentIndex++;
        if (currentIndex >= slides.length) currentIndex = 0;
        updateSlider();
      });
  
      prevBtn?.addEventListener('click', () => {
        currentIndex--;
        if (currentIndex < 0) currentIndex = slides.length - 1;
        updateSlider();
      });
  
      window.addEventListener('resize', updateSlider);
      updateSlider();
    });
  });
  