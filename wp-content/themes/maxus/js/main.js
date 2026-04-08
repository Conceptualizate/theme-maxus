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

  // ==============================
  // Models Filter
  // ==============================

  const filterBtns = document.querySelectorAll(".js-model-filter");
  const modelCards = document.querySelectorAll(".js-model-card");

  if (filterBtns.length && modelCards.length && typeof gsap !== "undefined") {
    filterBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        const filter = btn.dataset.filter;

        // Toggle active class
        filterBtns.forEach((b) => b.classList.remove("is-active"));
        btn.classList.add("is-active");

        // Determine which cards match
        const show = [];
        const hide = [];

        modelCards.forEach((card) => {
          if (filter === "all" || card.dataset.category === filter) {
            show.push(card);
          } else {
            hide.push(card);
          }
        });

        // Animate out non-matching cards, then show matching
        const tl = gsap.timeline();

        if (hide.length) {
          tl.to(hide, {
            opacity: 0,
            scale: 0.92,
            duration: 0.3,
            stagger: 0.04,
            ease: "power2.in",
            onComplete() {
              hide.forEach((c) => (c.style.display = "none"));
            },
          });
        }

        tl.call(() => {
          show.forEach((c) => {
            c.style.display = "";
            gsap.set(c, { opacity: 0, scale: 0.92 });
          });
        });

        tl.to(show, {
          opacity: 1,
          scale: 1,
          duration: 0.4,
          stagger: 0.06,
          ease: "power2.out",
        });
      });
    });
  }

  // ==============================
  // Scroll to Top
  // ==============================

  const scrollTopBtn = document.querySelector(".js-scroll-top");

  if (scrollTopBtn) {
    const SCROLL_THRESHOLD = 400;

    window.addEventListener("scroll", () => {
      if (window.scrollY > SCROLL_THRESHOLD) {
        scrollTopBtn.classList.add("is-visible");
      } else {
        scrollTopBtn.classList.remove("is-visible");
      }
    }, { passive: true });

    scrollTopBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // ==============================
  // Scroll Entrance Animations
  // ==============================

  if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {
    gsap.registerPlugin(ScrollTrigger);

    const from = { y: 30, autoAlpha: 0 };
    const to   = { y: 0, autoAlpha: 1, ease: "power2.out" };
    const triggerDefaults = { start: "top 85%", once: true };

    // — Helper: animate a section header (eyebrow + title + optional description)
    function animateHeader(selector) {
      const header = document.querySelector(selector);
      if (!header) return;
      gsap.fromTo(header.children, { ...from }, {
        ...to,
        duration: 0.6,
        stagger: 0.12,
        scrollTrigger: { trigger: header, ...triggerDefaults },
      });
    }

    // — Categories
    animateHeader(".categories__header");

    const catCards = document.querySelectorAll(".category-card");
    if (catCards.length) {
      gsap.fromTo(catCards, { ...from }, {
        ...to,
        duration: 0.5,
        stagger: 0.1,
        scrollTrigger: { trigger: ".categories__grid", ...triggerDefaults },
      });
    }

    // — Models
    animateHeader(".models__header");

    const modelsFilters = document.querySelector(".models__filters");
    if (modelsFilters) {
      gsap.fromTo(modelsFilters.children,
        { autoAlpha: 0, y: 12 },
        { autoAlpha: 1, y: 0, duration: 0.4, stagger: 0.06, ease: "power2.out",
          scrollTrigger: { trigger: modelsFilters, ...triggerDefaults },
        }
      );
    }

    const modelsGrid = document.querySelector(".js-models-grid");
    if (modelsGrid) {
      gsap.fromTo(modelsGrid.querySelectorAll(".js-model-card"), { ...from }, {
        ...to,
        duration: 0.5,
        stagger: 0.08,
        scrollTrigger: { trigger: modelsGrid, ...triggerDefaults },
      });
    }

    // — Services
    animateHeader(".services__header");

    const serviceCards = document.querySelectorAll(".service-card");
    if (serviceCards.length) {
      gsap.fromTo(serviceCards, { ...from }, {
        ...to,
        duration: 0.5,
        stagger: 0.12,
        scrollTrigger: { trigger: ".services__grid", ...triggerDefaults },
      });
    }

    // — CTA
    const ctaCard = document.querySelector(".cta__card");
    if (ctaCard) {
      gsap.fromTo(ctaCard,
        { y: 40, autoAlpha: 0 },
        { y: 0, autoAlpha: 1, duration: 0.7, ease: "power2.out",
          scrollTrigger: { trigger: ".cta", ...triggerDefaults },
        }
      );
    }
  }

});