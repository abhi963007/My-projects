const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

// Add event listener to the sign-up button
sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

// Add event listener to the sign-in button
sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// Additional functionality can be added here as needed
