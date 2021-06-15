const toSignIn = document.querySelector("#to-signin");
const toSignUp = document.querySelector("#to-signup");

const signInForm = document.querySelector("#signin-container");
const signUpForm = document.querySelector("#signup-container");

const signInBackBtn = document.querySelector("#signin-back-btn");
const signUpBackBtn = document.querySelector("#signup-back-btn");

toSignIn.addEventListener("click", () => {
  toSignUp.style.display = "none";
  toSignIn.style.display = "none";
  signInForm.style.display = "block";
});

toSignUp.addEventListener("click", () => {
  toSignUp.style.display = "none";
  toSignIn.style.display = "none";
  signUpForm.style.display = "block";
});

signInBackBtn.addEventListener("click", () => {
  signInForm.style.display = "none";
  signUpForm.style.display = "none";
  toSignUp.style.display = "block";
  toSignIn.style.display = "block";
});

signUpBackBtn.addEventListener("click", () => {
  signInForm.style.display = "none";
  signUpForm.style.display = "none";
  toSignUp.style.display = "block";
  toSignIn.style.display = "block";
});
