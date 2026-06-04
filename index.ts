//loading animation
window.addEventListener("load", () => {
    const main = document.getElementsByTagName("main");
    if(main[0] !== undefined) {
        main[0].classList.remove("opacity-0", "translate-y-10");
    }
});



// logic for the login password input
const loginPwdInput = document.getElementById("loginPwdInput") as HTMLDivElement;
const loginPassword = document.getElementById("loginPassword") as HTMLInputElement;
const loginTogglePwd = document.getElementById("loginTogglePwd") as HTMLButtonElement;
const loginShowPwdIcon = document.getElementById("loginShowPwdIcon") as HTMLElement;
const loginHidePwdIcon = document.getElementById("loginHidePwdIcon") as HTMLElement;

loginTogglePwd.onclick = function () {
    if(loginPassword.type === "password"){
        loginPassword.type = "text";
        loginShowPwdIcon.classList.add("hidden");
        loginHidePwdIcon.classList.remove("hidden");
    }
    else {
        loginPassword.type = "password";
        loginShowPwdIcon.classList.remove("hidden");
        loginHidePwdIcon.classList.add("hidden");
    }
}

loginPassword.addEventListener("focus", () => {
    loginPwdInput.classList.remove("border-white/25")
    loginPwdInput.classList.add("border-white")
})

loginPassword.addEventListener("blur", () => {
    loginPwdInput.classList.remove("border-white");
    loginPwdInput.classList.add("border-white/25");
});



// logic for the signup password input
const signupPwdInput = document.getElementById("signupPwdInput") as HTMLDivElement;
const signupPassword = document.getElementById("signupPassword") as HTMLInputElement;
const signupTogglePwd = document.getElementById("signupTogglePwd") as HTMLButtonElement;
const signupShowPwdIcon = document.getElementById("signupShowPwdIcon") as HTMLElement;
const signupHidePwdIcon = document.getElementById("signupHidePwdIcon") as HTMLElement;
const signupPwdComplexRule = document.getElementById("signupPwdComplexRule") as HTMLElement;

signupTogglePwd.onclick = function () {
    if(signupPassword.type === "password"){
        signupPassword.type = "text";
        signupShowPwdIcon.classList.add("hidden");
        signupHidePwdIcon.classList.remove("hidden");
    }
    else {
        signupPassword.type = "password";
        signupShowPwdIcon.classList.remove("hidden");
        signupHidePwdIcon.classList.add("hidden");
    }
}

signupPassword.addEventListener("focus", () => {
    signupPwdInput.classList.remove("border-white/25");
    signupPwdInput.classList.add("border-white");
    signupPwdComplexRule.classList.remove("hidden");
})

signupPassword.addEventListener("blur", () => {
    signupPwdInput.classList.remove("border-white");
    if (signupPassword.classList.contains("error-state")) {
        signupPwdInput.classList.add("border-red-400");
    } else {
        signupPwdInput.classList.add("border-white/25");
    }
});



// logic for the signup  confirm password input
const signupConfirmPwdInput = document.getElementById("signupConfirmPwdInput") as HTMLDivElement;
const signupConfirmPassword = document.getElementById("signupConfirmPassword") as HTMLInputElement;
const signupConfirmTogglePwd = document.getElementById("signupConfirmTogglePwd") as HTMLButtonElement;
const signupConfirmShowPwdIcon = document.getElementById("signupConfirmShowPwdIcon") as HTMLElement;
const signupConfirmHidePwdIcon = document.getElementById("signupConfirmHidePwdIcon") as HTMLElement;

signupConfirmTogglePwd.onclick = function () {
    if(signupConfirmPassword.type === "password"){
        signupConfirmPassword.type = "text";
        signupConfirmShowPwdIcon.classList.add("hidden");
        signupConfirmHidePwdIcon.classList.remove("hidden");
    }
    else {
        signupConfirmPassword.type = "password";
        signupConfirmShowPwdIcon.classList.remove("hidden");
        signupConfirmHidePwdIcon.classList.add("hidden");
    }
}

signupConfirmPassword.addEventListener("focus", () => {
    signupConfirmPwdInput.classList.remove("border-white/25");
    signupConfirmPwdInput.classList.add("border-white");
})

signupConfirmPassword.addEventListener("blur", () => {
    signupConfirmPwdInput.classList.remove("border-white");
    if (signupConfirmPassword.classList.contains("error-state")) {
        signupConfirmPwdInput.classList.add("border-red-400");
    } else {
        signupConfirmPwdInput.classList.add("border-white/25");
    }
});



/**
 * Change field state
 * @param {HTMLElement} field
 * @param {"error" | "default"} state
 * @param {string} [errorMessage]
 */
function changeFieldState(field: HTMLInputElement, state: "error" | "default", errorMessage?: string) {
    const wrapper  = field.closest(".field-wrapper") as HTMLElement;
    const errorMsg = wrapper.querySelector(".error-msg") as HTMLElement;

    if (state === "error") {
        field.classList.add("error-state");
        // Application de la border rouge différente si c'est un input classique ou un input composé
        // (ex. input password + bouton pour afficher/cacher)
        if (field.classList.contains("composed-field")) {
            const composedDiv = field.closest("div") as HTMLElement;
            composedDiv.classList.remove("border-white/25");
            composedDiv.classList.add("border-red-400");
        } else {
            field.classList.remove("border-white/25");
            field.classList.add("border-red-400");
        }
        errorMsg.textContent = errorMessage ?? "";
        errorMsg.classList.remove("hidden");
    }

    if (state === "default") {
        field.classList.remove("error-state", "border-red-400");
        field.classList.add("border-white/25");
        errorMsg.classList.add("hidden");
    }
}

/**
 * Change password complexity rule state
 * @param {HTMLElement} li
 * @param {"error" | "default"} state
 */
function changePasswordComplexityRuleState(li: HTMLElement, state: "error" | "default") {
    const emojiValid = li.querySelector('span.emojiValid') as HTMLElement;
    if (state === "error") {
        li.classList.remove("text-gray-300");
        li.classList.add("text-red-400");
        emojiValid.textContent  = "❌";
    }
    else if (state === "default") {
        li.classList.remove("text-red-400");
        li.classList.add("text-gray-300");
        emojiValid.textContent  = "✅";
    }
}


/**
 * Return the empty fields of a form
 * @param {HTMLFormElement} form
 */
function getEmptyFields(form: HTMLFormElement): HTMLInputElement[] {
    const fields = form.querySelectorAll("input");
    let emptyFields: HTMLInputElement[] = [];

    fields.forEach(field => {
        if (field.value.trim() === ""){
            emptyFields.push(field);
        }
    });

    return emptyFields;
}

/**
 * Returns a boolean if the given field matches the email format
 * @param {HTMLInputElement} field
 */
function isEmailFormatValid(field: HTMLInputElement): boolean {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return regex.test(field.value);
}

/**
 * Return a boolean if the given field don't exceed 30 characters
 * @param {HTMLInputElement} field
 */
function isUsernameFormatValid(field: HTMLInputElement): boolean {
    return field.value.length <= 30;
}

/**
 * Return a boolean if passwordField is equal to confirmPasswordField
 * @param {HTMLInputElement} passwordField
 * @param {HTMLInputElement} confirmPasswordField
 */
function isConfirmPasswordValid(passwordField: HTMLInputElement, confirmPasswordField: HTMLInputElement): boolean {
    return passwordField.value === confirmPasswordField.value;
}

/**
 * Returns an associative array with the complexity rule as the key and a boolean value indicating whether the rule is satisfied<br>
 * - **length** : Is the password more than 8 characters long<br>
 * - **uppercase letter** : is the password contain an uppercase letter<br>
 * - **number** : is the password contain a number<br>
 * - **special character** : is the password contain a special character (!@#$%^&*)
 * @param {HTMLInputElement} field
 */
function isPasswordComplex(field: HTMLInputElement): Record<string, boolean> {
    return {
        "length":               field.value.length >= 8,
        "uppercase letter":    /[A-Z]/.test(field.value),
        "number":              /\d/.test(field.value),
        "special character":   /[!@#$%^&*]/.test(field.value)
    };
}


const signupForm = document.getElementById("signup-form") as HTMLFormElement;
const signupFormFields = signupForm.querySelectorAll<HTMLInputElement>("input");
const signupSubmitBtn = document.getElementById("signup-submit-btn") as HTMLButtonElement;

// Test en temps réel si le password est complex
const passwordField = signupForm.querySelector<HTMLInputElement>("input[name=\"pwd\"]") as HTMLInputElement;
const passwordLengthCheck = signupForm.querySelector(".lengthCheck") as HTMLElement;
const passwordUppercaseCheck = signupForm.querySelector(".uppercaseCheck") as HTMLElement;
const passwordNumberCheck = signupForm.querySelector(".numberCheck") as HTMLElement;
const passwordSpecialCharCheck = signupForm.querySelector(".specialCharCheck") as HTMLElement;
const emailField = signupForm.querySelector("input[type=\"email\"]") as HTMLInputElement;
let passwordComplexityCheck = false;
passwordField.addEventListener("input", () => {
    const passwordComplexity = isPasswordComplex(passwordField);

    changePasswordComplexityRuleState(passwordLengthCheck, passwordComplexity["length"] ? "default" : "error");
    changePasswordComplexityRuleState(passwordUppercaseCheck, passwordComplexity["uppercase letter"] ? "default" : "error");
    changePasswordComplexityRuleState(passwordNumberCheck, passwordComplexity["number"] ? "default" : "error");
    changePasswordComplexityRuleState(passwordSpecialCharCheck, passwordComplexity["special character"] ? "default" : "error");

    passwordComplexityCheck =
        (passwordComplexity["length"] &&
        passwordComplexity["uppercase letter"] &&
        passwordComplexity["number"] &&
        passwordComplexity["special character"]) ?? false;
});

/**
 * Checks whether the signup form is valid and submits it if it is. It also updates the field statuses.
 */
function validateSignupForm () {
    // Remise à 0 des fields
    signupFormFields.forEach(field => {
        changeFieldState(field, "default");
    })

    // Check if the email format is valid
    let emailFormatCheck = isEmailFormatValid(emailField);
    if (!emailFormatCheck) {
        changeFieldState(emailField, "error", "The email format is invalid (Ex. example@mail.com)");
    }

    // Check if passwordField equals confirmPasswordField
    const confirmPasswordField = signupForm.querySelector("input[name=\"confirmPwd\"]") as HTMLInputElement;
    let confirmPasswordCheck = isConfirmPasswordValid(passwordField, confirmPasswordField);
    if(!confirmPasswordCheck) {
        changeFieldState(confirmPasswordField, "error", "This is different from the password field");
    }

    // Check if fields are empty
    let emptyFieldsCheck = true;
    let emptyFields = getEmptyFields(signupForm);
    if (emptyFields.length > 0) {
        emptyFieldsCheck = false;
        emptyFields.forEach(field => {
            changeFieldState(field, "error", "This field is required");
        });
    }

    // Check if the username don't exceed 30 characters
    const usernameField = signupForm.querySelector<HTMLInputElement>("input[name=\"username\"]") as HTMLInputElement;
    const usernameFormatCheck = isUsernameFormatValid(usernameField);
    if (!usernameFormatCheck) {
        changeFieldState(usernameField, "error", "The username must not exceed 30 characters");
    }

    return emptyFieldsCheck && emailFormatCheck && usernameFormatCheck && confirmPasswordCheck && passwordComplexityCheck;
}

signupSubmitBtn.addEventListener("click", () => {
    if (validateSignupForm()) {
        signupForm.submit();
    }
});

// Resets the field to its default state when the user modifies it
signupForm.querySelectorAll("input").forEach(field => {
    field.addEventListener("input", () => {
        changeFieldState(field, "default");
    });
});


const DURATION = 6000; // 6 secondes
let rafId: number;
let startTime: number;
const snackbar = document.getElementById('snackbar') as HTMLElement;
const bar = document.getElementById('progress-bar') as HTMLElement;
function showSnackbar(): void {
    snackbar.classList.remove("opacity-0", "translate-y-10");

    snackbar.style.display = 'flex';
    bar.style.transform = 'scaleX(1)';
    startTime = performance.now();

    function animate(now: number): void {
        const progress = Math.min((now - startTime) / DURATION, 1);
        bar.style.transform = `scaleX(${1 - progress})`;
        if (progress < 1) {
            rafId = requestAnimationFrame(animate);
        } else {
            snackbar.classList.add("opacity-0", "translate-y-10");
            setTimeout(() => {
                snackbar.style.display = 'none';
            }, 1000);
        }
    }
    rafId = requestAnimationFrame(animate);
}

document.getElementById('snackbar-close')?.addEventListener('click', () => {
    cancelAnimationFrame(rafId);
    snackbar.classList.add("opacity-0", "translate-y-10");
    setTimeout(() => {
        snackbar.style.display = 'none';
    }, 1000);
});


const submitData = document.getElementById("submit-data") as HTMLElement;
const submitFeedback: Array<any> = JSON.parse(<string>submitData.dataset.feedback);
console.log(submitFeedback);
if (!Array.isArray(submitFeedback)) {
    if("errors" in submitFeedback) {
        validateSignupForm();
        if(submitFeedback["errors"]["isEmailRegistered"]) {
            changeFieldState(emailField, "error", "This email address is already associated with an account");
        }
    }
    else if ("signup" in submitFeedback && submitFeedback["signup"] === "success") {
        showSnackbar();
    }
}