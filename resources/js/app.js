import "./bootstrap";

import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import "plyr/dist/plyr.css";
import "../css/leaflet.css";
import "../css/MarkerCluster.css";
import "../css/MarkerCluster.Default.css";
import "../css/app.css";

import VueSocialSharing from "vue-social-sharing";
import LazyComponent from "v-lazy-component";

import dialog from "./plugins/dialog/";
import { createApp } from "vue";

const app = createApp({
  mounted() {
    window.addEventListener("scroll", this.handleScroll);

    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        e.preventDefault();
        window.lenis.scrollTo(this.getAttribute("href"), { offset: -160 });
      });
    });

    // if (document.getElementById("cookie-list")) {
    //   let cookiebotList = document.createElement("script");
    //   cookiebotList.setAttribute(
    //     "src",
    //     "https://consent.cookiebot.com/87ce9c45-32fd-469d-bfe7-9b3acbd482e2/cd.js"
    //   );
    //   document.getElementById("cookie-list").appendChild(cookiebotList);
    // }

    // Get all accordion buttons
    // const accordions = document.querySelectorAll(".accordion");

    // // Loop through each accordion and add click event
    // accordions.forEach((accordion) => {
    //   accordion.addEventListener("click", function () {
    //     const panel = this.nextElementSibling;
    //     const isActive = this.classList.contains("active"); // Check if it's already open

    //     // Close all panels before potentially opening a new one
    //     document.querySelectorAll(".accordion + .panel").forEach((p) => {
    //       p.style.display = "none";
    //     });

    //     // Remove active classes from all accordion buttons
    //     accordions.forEach((acc) => {
    //       acc.classList.remove("active", "!bg-midgrey", "!text-black", "!mb-0");
    //       const accSvg = acc.querySelector("svg");
    //       accSvg.classList.remove("rotate-180");
    //       // const accSvgLine = accSvg.querySelector("#Line_501");
    //       // accSvgLine.style.display = "block"; // show line for all buttons
    //     });

    //     // If the clicked accordion was already active, do nothing (just close it)
    //     if (isActive) return;

    //     // Otherwise, open the clicked one
    //     this.classList.add("active", "!bg-midgrey", "!text-black", "!mb-0");

    //     // Handle the SVG line visibility
    //     const svg = this.querySelector("svg");
    //     svg.classList.add("rotate-180");
    //     // const svgLine = svg.querySelector("#Line_501");
    //     // svgLine.style.display = "none"; // hide line for the clicked button

    //     // Show the corresponding panel
    //     panel.style.display = "block";

    //     // Scroll to the opened panel smoothly
    //     panel.scrollIntoView({
    //       behavior: "smooth", // Smooth scroll
    //       block: "center", // Scroll to the center of the screen
    //     });
    //   });
    // });

    const footerAccordions = document.querySelectorAll(".footer-accordion");

    footerAccordions.forEach((accordion) => {
      accordion.addEventListener("click", () => {
        const isOpen =
          !accordion.nextElementSibling.classList.contains("hidden");

        // Close all other accordion contents and reset their SVG lines
        footerAccordions.forEach((other) => {
          const content = other.nextElementSibling;
          const svg = other.querySelector("svg");
          const line = svg?.querySelector("#Line_501");

          if (
            content &&
            content.classList.contains("footer-accordion-content")
          ) {
            content.classList.add("hidden");
          }

          if (line) {
            line.style.display = "block";
          }
        });

        // If this one wasn't already open, open it and hide its line
        if (!isOpen) {
          const content = accordion.nextElementSibling;
          const svg = accordion.querySelector("svg");
          const line = svg?.querySelector("#Line_501");

          if (
            content &&
            content.classList.contains("footer-accordion-content")
          ) {
            content.classList.remove("hidden");
          }

          if (line) {
            line.style.display = "none";
          }
        }
      });
    });

    // let map = document.getElementById("map");
    // if (map != null) {
    //   setTimeout(() => {
    //     this.map = L.map("map", { zoomControl: true });
    //     this.map.setView([54.64176270931645, -6.744395690967584], 8);
    //     this.map.touchZoom.disable();
    //     this.map.doubleClickZoom.disable();
    //     this.map.scrollWheelZoom.disable();
    //     this.map.boxZoom.disable();
    //     this.map.keyboard.disable();
    //     this.map.zoomControl.setPosition("bottomright");

    //     var defaultIcon = L.icon({
    //       iconUrl:
    //         "https://riverridge.ams3.digitaloceanspaces.com/uploads/2025/03/marker.svg",
    //       iconSize: [35, 35],
    //       popupAnchor: [-3, -6],
    //     });

    //     var clickedIcon = L.icon({
    //       iconUrl:
    //         "https://riverridge.ams3.digitaloceanspaces.com/uploads/2025/03/marker-active.svg",
    //       iconSize: [35, 35],
    //       popupAnchor: [-3, -6],
    //     });

    //     L.tileLayer(
    //       "https://tile.jawg.io/jawg-light/{z}/{x}/{y}{r}.png?access-token=YkWEciXphWgIS2QOfmX2S8YtQtZ8RnJ3io8JTMA0Aeo5JLYtztUJTa3THMLHNURG",
    //       {
    //         attribution:
    //           '<a href="https://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank">&copy; <b>Jawg</b>Maps</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    //       }
    //     ).addTo(this.map);

    //     var markers = [];
    //     for (const element of document.getElementsByClassName(
    //       "office-marker"
    //     )) {
    //       var marker = [];
    //       var lat = element.getAttribute("data-lat");
    //       var lng = element.getAttribute("data-lng");
    //       var name = element.getAttribute("data-name");
    //       var address = element.getAttribute("data-address");
    //       var contact = element.getAttribute("data-contact");
    //       marker = [name, lat, lng, address, contact];
    //       markers.push(marker);
    //     }

    //     for (var i = 0; i < markers.length; i++) {
    //       marker = new L.marker([markers[i][1], markers[i][2]], {
    //         name: markers[i][0],
    //         address: markers[i][3],
    //         icon: defaultIcon,
    //       })
    //         .on("click", markerOnClick)
    //         .addTo(this.map);

    //       marker.bindPopup(
    //         '<p class="font-sora font-semibold office-name">' +
    //           markers[i][0] +
    //           " Office </p>" +
    //           markers[i][3] +
    //           '<a class="font-manrope !text-deepgreen" href="tel:' +
    //           markers[i][4] +
    //           '">' +
    //           markers[i][4] +
    //           "</a>"
    //       );
    //     }

    //     function markerOnClick(e) {
    //       if (document.getElementById("map-location-name")) {
    //         document.getElementById("map-location-name").innerHTML =
    //           this.options.name;
    //       }

    //       if (document.getElementById("map-location-address")) {
    //         document.getElementById("map-location-address").innerHTML =
    //           this.options.address;
    //       }
    //     }
    //   }, 500);
    // }

    // ==========================
    // MENU: Slide Down from Top
    // ==========================
    const menuBtn = document.getElementById("menuBtn");
    const menu = document.getElementById("menu");
    const panelWrapper = document.getElementById("panel-wrapper");
    const navHolder = document.getElementById("nav-holder");
    const menuOpen = document.getElementById("menu-open");
    const menuClose = document.getElementById("menu-close");
    let history = [];

    // Open menu (slide down)
    menuBtn?.addEventListener("click", () => {
      menu?.classList.remove("-translate-y-full");
      menu?.classList.remove("hidden");
      menu?.classList.add("translate-y-0");
      menu?.classList.add("h-full");
      menu?.classList.add("flex");

      //already open
      if (menuBtn?.classList.contains("open")) {
        closeMenu();
        menuBtn?.classList.remove("open");
        menuClose?.classList.add("hidden");
        menuOpen?.classList.remove("hidden");
        // Don't remove navHolder classes - keep white background on close
        //not open
      } else {
        menuBtn?.classList.toggle("open");
        menuOpen?.classList.add("hidden");
        menuClose?.classList.remove("hidden");
        menuBtn?.classList.add("open");
        navHolder?.classList.add(
          "bg-white",
          "border-b",
          "border-b-[#D9D9D9]",
          "text-black",
          "active",
        );
      }
    });

    // ==========================
    // MOBILE NAVIGATION - SIMPLIFIED
    // ==========================
    const mobilePanelWrapper = document.getElementById("mobile-panel-wrapper");
    let panelStack = [];

    // Handle mobile trigger buttons
    mobilePanelWrapper?.addEventListener("click", (e) => {
      const trigger = e.target.closest(".mobile-trigger");
      if (trigger) {
        const nextPanelId = trigger.getAttribute("data-next-panel");
        const nextPanel = mobilePanelWrapper.querySelector(
          `[data-panel-id="${nextPanelId}"]`,
        );

        if (nextPanel) {
          // Hide all panels
          mobilePanelWrapper.querySelectorAll(".mobile-panel").forEach((p) => {
            p.classList.add("translate-x-full");
          });

          // Show next panel
          nextPanel.classList.remove("translate-x-full");
          nextPanel.classList.add("translate-x-0");

          // Track history
          panelStack.push(nextPanelId);
        }
      }
    });

    // Handle mobile back buttons
    mobilePanelWrapper?.addEventListener("click", (e) => {
      const backBtn = e.target.closest(".mobile-back");
      if (backBtn) {
        panelStack.pop();
        const previousPanelId = panelStack[panelStack.length - 1];

        // Hide all panels
        mobilePanelWrapper.querySelectorAll(".mobile-panel").forEach((p) => {
          p.classList.add("translate-x-full");
        });

        if (previousPanelId) {
          // Show previous panel
          const previousPanel = mobilePanelWrapper.querySelector(
            `[data-panel-id="${previousPanelId}"]`,
          );
          if (previousPanel) {
            previousPanel.classList.remove("translate-x-full");
            previousPanel.classList.add("translate-x-0");
          }
        } else {
          // Show main panel
          const mainPanel = mobilePanelWrapper.querySelector(
            '[data-panel-level="0"]',
          );
          if (mainPanel) {
            mainPanel.classList.remove("translate-x-full");
            mainPanel.classList.add("translate-x-0");
          }
        }
      }
    });

    // Initialize default open state on desktop
    function initializeDefaultOpenState() {
      // Only on desktop (lg breakpoint: 1024px)
      if (window.innerWidth >= 1024) {
        const firstDefaultBtn = document.querySelector(
          '[data-default-open="true"][data-target-panel]',
        );
        const firstDefaultPanel = document.querySelector(
          '[data-default-open="true"][id]',
        );

        if (firstDefaultBtn) {
          // Mark first button as active
          firstDefaultBtn.classList.add("border-r-red", "opacity-100");
          firstDefaultBtn.classList.remove(
            "opacity-60",
            "lg:opacity-60",
            "border-r-[#000000]",
            "lg:border-r-[#000000]",
          );

          // Hide all panels
          panelWrapper?.querySelectorAll(".menu-panel").forEach((p) => {
            p.classList.add("hidden");
            p.classList.remove("lg:flex");
          });

          // Show the first panel if it exists
          if (firstDefaultPanel) {
            firstDefaultPanel.classList.remove("hidden");
            firstDefaultPanel.classList.add("lg:flex");
          }
        }
      }
    }

    // Call on load and on resize
    window.addEventListener("load", initializeDefaultOpenState);
    window.addEventListener("resize", initializeDefaultOpenState);

    // Handle sub-panel navigation
    document.querySelectorAll("[data-target-panel]").forEach((btn) => {
      btn.addEventListener("click", () => {
        const targetId = btn.getAttribute("data-target-panel");
        const targetPanel = document.getElementById(targetId);

        // Remove active classes from all buttons
        document.querySelectorAll("[data-target-panel]").forEach((b) => {
          b.classList.remove(
            "opacity-100",
            "border-r-red",
            "lg:opacity-100",
            "lg:border-r-red",
          );
          b.classList.add(
            "opacity-60",
            "lg:opacity-60",
            "border-r-[#000000]",
            "lg:border-r-[#000000]",
          );
          b.classList.remove("lg:hover:border-r-red", "hover:border-r-red");
        });

        // Add active classes to clicked button
        btn.classList.add("border-r-red", "opacity-100");
        btn.classList.remove(
          "opacity-60",
          "lg:opacity-60",
          "border-r-[#000000]",
          "lg:border-r-[#000000]",
        );

        // Hide all panels by adding hidden and removing lg:flex
        panelWrapper?.querySelectorAll(".menu-panel").forEach((p) => {
          p.classList.add("hidden");
          p.classList.remove("lg:flex");
        });

        // Show target panel by removing hidden and adding lg:flex
        if (targetPanel) {
          targetPanel.classList.remove("hidden");
          targetPanel.classList.add("lg:flex");
        }

        // Update history
        history.push(targetId);
      });
    });

    // Handle back buttons
    document.querySelectorAll("[data-back]").forEach((btn) => {
      btn.addEventListener("click", () => {
        history.pop();
        const previous = history[history.length - 1] || null;

        panelWrapper
          ?.querySelectorAll(".menu-panel")
          .forEach((p) => p.classList.add("translate-x-full"));

        if (previous) {
          document
            .getElementById(previous)
            ?.classList.remove("translate-x-full");
        } else {
          panelWrapper
            ?.querySelector('[data-level="0"]')
            ?.classList.remove("translate-x-full");
        }
      });
    });

    // Close menu + reset panels
    function closeMenu() {
      menu?.classList.add("-translate-y-full");
      menu?.classList.add("hidden");
      menu?.classList.remove("translate-y-0");
      menu?.classList.remove("h-full");
      menu?.classList.remove("flex");

      // Reset mobile panels
      const mobilePanels =
        mobilePanelWrapper?.querySelectorAll(".mobile-panel");
      if (mobilePanels) {
        mobilePanels.forEach((p) => p.classList.add("translate-x-full"));
        const mainPanel = mobilePanelWrapper?.querySelector(
          '[data-panel-level="0"]',
        );
        if (mainPanel) {
          mainPanel.classList.remove("translate-x-full");
          mainPanel.classList.add("translate-x-0");
        }
      }
      panelStack = [];

      // Don't remove navHolder classes - keep the white background
      // Just reset to default open state on desktop
      setTimeout(() => {
        initializeDefaultOpenState();
      }, 100);
    }

    // ESC closes the menu
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") closeMenu();
    });
  },
  methods: {
    handleScroll() {
      // when the user scrolls, check the pageYOffset
      if (window.pageYOffset > 0) {
        document.getElementsByTagName("html")[0].classList.add("scrolled");
      } else {
        document.getElementsByTagName("html")[0].classList.remove("scrolled");
      }
    },
  },
});

app.use(VueSocialSharing);
app.use(LazyComponent);
app.use(dialog);

Object.entries(
  import.meta.glob("./components/**/*.vue", { eager: true }),
).forEach(([path, definition]) => {
  app.component(
    path
      .split("/")
      .pop()
      .replace(/\.\w+$/, ""),
    definition.default,
  );
});

app.mount("#app");
