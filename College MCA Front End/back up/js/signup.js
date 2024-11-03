const passwordField = document.getElementById("password");
const passwordIcon = document.querySelector(".password-field svg");

// Existing mousemove and focus animations
const handleMouseMove = event => {
    if (!document.querySelector("#password:is(:focus)") && !document.querySelector("#password:is(:user-invalid)")) {
        const eyes = document.getElementsByClassName('eye');
        for (let eye of eyes) {
            const x = eye.getBoundingClientRect().left + 10;
            const y = eye.getBoundingClientRect().top + 10;
            const rad = Math.atan2(event.pageX - x, event.pageY - y);
            const rot = (rad * (180 / Math.PI) * -1) + 180;
            eye.style.transform = `rotate(${rot}deg)`;
        }
    }
};

const handleFocusPassword = event => {
    document.getElementById('face').style.transform = 'translateX(30px)';
    const eyes = document.getElementsByClassName('eye');
    for (let eye of eyes) {
        eye.style.transform = `rotate(100deg)`;
    }
};

const handleFocusOutPassword = event => {
    document.getElementById('face').style.transform = 'translateX(0)';
    if (event.target.checkValidity()) {
        document.getElementById('ball').classList.toggle('sad');
    } else {
        document.getElementById('ball').classList.toggle('sad');
        const eyes = document.getElementsByClassName('eye');
        for (let eye of eyes) {
            eye.style.transform = `rotate(215deg)`;
        }
    }
};

// Adding functionality to toggle password visibility
const togglePasswordVisibility = () => {
    passwordIcon.addEventListener("click", () => {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Toggle eye icon (you can customize this part to show an eye-slash or any other icon)
        if (type === "password") {
            passwordIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
        } else {
            passwordIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />';
        }
    });
};

// Initialize password visibility toggle
togglePasswordVisibility();

// Existing event listeners for mousemove and password focus
document.addEventListener("mousemove", event => handleMouseMove(event));
passwordField.addEventListener('focus', event => handleFocusPassword(event));
passwordField.addEventListener('focusout', event => handleFocusOutPassword(event));

document.getElementById('submit').addEventListener("mouseover", event => document.getElementById('ball').classList.toggle('look_at'));
document.getElementById('submit').addEventListener("mouseout", event => document.getElementById('ball').classList.toggle('look_at'));
