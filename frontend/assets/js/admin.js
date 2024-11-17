// JavaScript for handling the sidebar dropdown
document.querySelectorAll(".sidebar-menu li").forEach((item) => {
  item.addEventListener("click", () => {
    const submenu = item.querySelector(".sub-menu");
    if (submenu) {
      submenu.classList.toggle("open");
    }
  });
});

// Accordion functionality for sidebar menu
document.addEventListener("DOMContentLoaded", function () {
  const accordions = document.querySelectorAll(".accordion");

  accordions.forEach((accordion) => {
    accordion.addEventListener("click", function () {
      this.classList.toggle("active");
      const panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  });
});
