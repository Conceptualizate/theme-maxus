document.addEventListener("DOMContentLoaded", () => {

  // ==============================
  // Mobile Menu
  // ==============================

  const hamburger = document.querySelector(".navbar__hamburger");
  const mobileMenu = document.querySelector(".mobile-menu");
  const closeBtn   = document.querySelector(".mobile-menu__close");
  const body       = document.body;

  function openMenu() {
    if (!mobileMenu || !hamburger) return;
    mobileMenu.classList.add("open");
    body.classList.add("no-scroll");
    hamburger.setAttribute("aria-expanded", "true");
  }

  function closeMenu() {
    if (!mobileMenu || !hamburger) return;
    mobileMenu.classList.remove("open");
    body.classList.remove("no-scroll");
    hamburger.setAttribute("aria-expanded", "false");
  }

  if (hamburger) hamburger.addEventListener("click", openMenu);
  if (closeBtn)  closeBtn.addEventListener("click", closeMenu);

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && mobileMenu && mobileMenu.classList.contains("open")) {
      closeMenu();
    }
  });

  // ==============================
  // Hero Slider
  // ==============================

  const heroSliderElement = document.querySelector(".js-hero-slider");

  if (heroSliderElement && typeof Swiper !== "undefined") {

    const slidesCount = heroSliderElement.querySelectorAll(".swiper-slide").length;
    const currentEl   = document.querySelector(".hero-slider__current");
    const formatNum   = (n) => String(n).padStart(2, "0");

    let activeTl = null;

    function animateSlide(slide) {
      if (!slide || typeof gsap === "undefined") return;

      // Kill timeline anterior para evitar conflictos
      if (activeTl) activeTl.kill();

      const image   = slide.querySelector(".hero-slide__image");
      const title   = slide.querySelector(".js-hero-title");
      const copy    = slide.querySelector(".js-hero-copy");
      const actions = [...slide.querySelectorAll(".hero-slide__actions > *")];

      activeTl = gsap.timeline({ defaults: { ease: "power3.out" } });

      // Imagen: leve zoom de entrada
      if (image) {
        activeTl.fromTo(
          image,
          { scale: 1.1 },
          { scale: 1, duration: 1.8, ease: "power2.out" },
          0
        );
      }

      // Título: blur + slide vertical
      if (title) {
        activeTl.fromTo(
          title,
          { y: 28, autoAlpha: 0, filter: "blur(14px)" },
          { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 0.85 },
          0.05
        );
      }

      // Descripción: blur más suave
      if (copy) {
        activeTl.fromTo(
          copy,
          { y: 18, autoAlpha: 0, filter: "blur(8px)" },
          { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 0.7 },
          0.28
        );
      }

      // Botones: entrada escalonada desde abajo
      if (actions.length) {
        activeTl.fromTo(
          actions,
          { y: 14, autoAlpha: 0 },
          { y: 0, autoAlpha: 1, duration: 0.5, stagger: 0.08 },
          0.42
        );
      }
    }

    new Swiper(heroSliderElement, {
      loop:           slidesCount > 1,
      speed:          900,
      effect:         "fade",
      fadeEffect:     { crossFade: true },
      allowTouchMove: slidesCount > 1,
      autoplay: slidesCount > 1
        ? { delay: 6000, disableOnInteraction: false }
        : false,
      pagination: {
        el:        ".hero-slider__pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".hero-slider__arrow--next",
        prevEl: ".hero-slider__arrow--prev",
      },
      on: {
        init(swiper) {
          if (currentEl) currentEl.textContent = formatNum(swiper.realIndex + 1);
          animateSlide(swiper.slides[swiper.activeIndex]);
        },
        // slideChange dispara al inicio del cambio (sin esperar que termine la transición)
        slideChange(swiper) {
          if (currentEl) currentEl.textContent = formatNum(swiper.realIndex + 1);
          animateSlide(swiper.slides[swiper.activeIndex]);
        },
      },
    });
  }

});