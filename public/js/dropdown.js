function toggleDropdown(dropdownId) {
  document.getElementById(dropdownId).classList.toggle("show");
}

// Close dropdown if user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches(".dropdown-btn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

// Update button text with selected values
document
  .querySelectorAll('.dropdown-item input[type="checkbox"]')
  .forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      let dropdown = checkbox.closest(".dropdown");
      let selected = Array.from(
        dropdown.querySelectorAll(
          '.dropdown-item input[type="checkbox"]:checked'
        )
      ).map((checkbox) => checkbox.parentElement.textContent.trim());
      dropdown.querySelector(".dropdown-btn").textContent =
        selected.length > 0 ? selected.join(", ") : "Select items";
    });
  });
