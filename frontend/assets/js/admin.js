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

//edit model
function openEditModal(car) {
  document.getElementById("editModal").style.display = "block";
  document.getElementById("edit-id").value = car.id;
  document.getElementById("edit-name").value = car.name;
  document.getElementById("edit-brand").value = car.brand;
  document.getElementById("edit-model").value = car.model;
  document.getElementById("edit-year").value = car.year;
  document.getElementById("edit-price").value = car.price;
  document.getElementById("edit-location").value = car.location;
  document.getElementById("edit-availability").checked = car.availability;
}

function closeModal() {
  document.getElementById("editModal").style.display = "none";
}

window.onclick = function(event) {
  const modal = document.getElementById("editModal");
  if (event.target === modal) {
      closeModal();
  }
};

