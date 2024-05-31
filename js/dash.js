const welcomeSection = document.querySelector(".welcome-section");
const profileSection = document.querySelector(".profile-section");
const allergySection = document.querySelector(".allergy-section");
const ticketSection = document.querySelector(".ticket-section");

const profileBtn = document.querySelector(".profile");
const allergyBtn = document.querySelector(".allergy");
const ticketBtn = document.querySelector(".ticket");

// Function to hide all sections and remove active styles from buttons
function resetAll() {
  welcomeSection.classList.remove("hidden"); // Keep welcome section visible initially
  profileSection.classList.add("hidden");
  allergySection.classList.add("hidden");
  ticketSection.classList.add("hidden");

  profileBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
  allergyBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
  ticketBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
}

// Function to show a specific section and add active styles to button
function showSection(section, button) {
  welcomeSection.classList.add("hidden"); // Hide welcome section on other button clicks
  section.classList.remove("hidden");
  button.classList.add("bg-[#093697]", "text-white", "rounded-lg");
}

// Add click event listeners to buttons
profileBtn.addEventListener("click", function () {
  resetAll();
  showSection(profileSection, profileBtn);
});

allergyBtn.addEventListener("click", function () {
  resetAll();
  showSection(allergySection, allergyBtn);
});

ticketBtn.addEventListener("click", function () {
  resetAll();
  showSection(ticketSection, ticketBtn);
});

// Call hideAllSections initially to hide profile, allergy and ticket sections
resetAll();

const menu = document.getElementById("menu");
const close = document.getElementById("close");
const menuBar = document.querySelector(".menubar");

menu.addEventListener("click", () => {
  menuBar.classList.contains("hidden")
    ? menuBar.classList.remove("hidden")
    : menuBar.classList.add("hidden");
});
close.addEventListener("click", () => {
  if (!menuBar.classList.contains("hidden")) {
    menuBar.classList.add("hidden");
  } else {
    menuBar.classList.remove("hidden");
  }
});
