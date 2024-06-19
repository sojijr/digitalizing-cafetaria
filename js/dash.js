const welcomeSection = document.querySelector(".welcome-section");
const profileSection = document.querySelector(".profile-section");
const allergySection = document.querySelector(".allergy-section");
const ticketSection = document.querySelector(".ticket-section");

const dashboardBtn = document.querySelector(".dashboard");
const profileBtn = document.querySelector(".profile");
const allergyBtn = document.querySelector(".allergy");
const ticketBtn = document.querySelector(".ticket");

// Function to hide all sections and remove active styles from buttons
function resetAll() {
  welcomeSection.classList.add("hidden");
  profileSection.classList.add("hidden");
  allergySection.classList.add("hidden");
  ticketSection.classList.add("hidden");

  dashboardBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
  profileBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
  allergyBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
  ticketBtn.classList.remove("bg-[#093697]", "text-white", "rounded-lg");
}

// Function to show a specific section and add active styles to button
function showSection(section, button) {
  resetAll();
  section.classList.remove("hidden");
  button.classList.add("bg-[#093697]", "text-white", "rounded-lg");

  // Save the current section identifier in localStorage
  localStorage.setItem("currentSection", section.dataset.section);
}

dashboardBtn.addEventListener("click", function () {
  showSection(welcomeSection, dashboardBtn);
});

profileBtn.addEventListener("click", function () {
  showSection(profileSection, profileBtn);
});

allergyBtn.addEventListener("click", function () {
  showSection(allergySection, allergyBtn);
});

ticketBtn.addEventListener("click", function () {
  showSection(ticketSection, ticketBtn);
});

// Call resetAll initially to hide all sections
resetAll();

// Check localStorage for the current section and display it
const currentSection = localStorage.getItem("currentSection");
switch (currentSection) {
  case "welcome":
    showSection(welcomeSection, dashboardBtn);
    break;
  case "profile":
    showSection(profileSection, profileBtn);
    break;
  case "allergy":
    showSection(allergySection, allergyBtn);
    break;
  case "ticket":
    showSection(ticketSection, ticketBtn);
    break;
  default:
    showSection(welcomeSection, dashboardBtn);
    break;
}