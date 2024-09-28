function toggleMenu() {
  const nav = document.querySelector(".header-nav");
  nav.classList.toggle("active");
}

// Initialize Swiper
const swiper = new Swiper(".swiper", {
  loop: true,
  speed: 600,
  autoplay: {
    delay: 8000,
    disableOnInteraction: false,
  },
  slidesPerView: 3,
  spaceBetween: 20,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1200: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
  },
});

// Reinitialize AOS animation on hover
// document.querySelectorAll(".staff-item").forEach((item) => {
//   item.addEventListener("mouseover", function () {
//     AOS.refreshHard();
//   });
// });
