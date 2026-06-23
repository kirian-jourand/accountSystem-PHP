<?php
require_once "includes/config_session.inc.php";
require_once "includes/signup_view.inc.php";

$submitFeedback = getSignupSubmitFeedback();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"> <!-- NOSONAR -->
    <title>Account System - Home</title>
</head>
<body class="
    bg-[url(/accountSystem/img/bg.jpg)]
    bg-cover
    bg-center
    min-h-screen
    flex
    flex-col
    items-center
    justify-center
    font-['Montserrat']
    text-white
">
<main class="
    rounded-2xl
    shadow-lg/10
    p-8
    backdrop-blur-md
    bg-black/50
    grid
    grid-cols-1
    gap-32
    opacity-0
    translate-y-10
    transition-all
    duration-800
    ease-out
    w-sm
">
    <div class="grid grid-cols-1 gap-6">
        <h3 class=" text-2xl font-bold tracking-wide uppercase text-center">Login</h3>
        <form method="POST" action="" class="grid grid-cols-1 gap-6">
            <div class="field-wrapper">
                <label for="e-mail"> <span class="hidden">E-mail</span>
                    <input type="email" name="e-mail" placeholder="E-mail" class="border border-white/25 rounded-2xl px-4 py-1 placeholder-gray-300 focus:outline-none focus:border-white w-full">
                </label>
            </div>
            <div class="field-wrapper">
                <div id="loginPwdInput" class="mb-1 border border-white/25 rounded-2xl py-1 placeholder-gray-300 flex items-center justify-center">
                    <label for="pwd" class="grow"> <span class="hidden">Password</span>
                        <input type="password" name="pwd" id="loginPassword" placeholder="Password" class="composed-field placeholder-gray-300 pl-4 focus:outline-none focus:ring-0">
                    </label>
                    <button type="button" id="loginTogglePwd" class="text-gray-300 w-12 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="loginShowPwdIcon" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="loginHidePwdIcon" class="size-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <span class="error-msg hidden  text-red-400 text-sm font-bold">erreur</span>
                <a class="underline text-gray-300 text-xs">Forget password ?</a>
            </div>
            <button type="submit" class="bt-primary px-8 py-2 rounded-2xl uppercase text-md font-bold shadow-lg shadow-pink-600/50 hover:shadow-orange-300 transition-all duration-450 ease-in-out">Login</button>
        </form>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <h3 class=" text-2xl font-bold tracking-wide uppercase text-center">Signup</h3>
        <form method="POST" action="includes/signup.inc.php" id="signup-form" class="grid grid-cols-1 gap-6">
            <div class="field-wrapper">
                <label for="username"> <span class="hidden">Username</span>
                    <input
                            type="text"
                            name="username"
                            placeholder="Username"
                            value="<?= htmlspecialchars($submitFeedback['submitData']['username'] ?? '') ?>"
                            class="border border-white/25 rounded-2xl px-4 py-1 placeholder-gray-300 focus:outline-none focus:border-white w-full">
                </label>
                <span class="error-msg hidden  text-red-400 text-sm font-bold">erreur</span>
            </div>
            <div class="field-wrapper">
                <label for="e-mail"> <span class="hidden">E-mail</span>
                    <input
                            type="email"
                            name="e-mail"
                            placeholder="E-mail"
                            value="<?= htmlspecialchars($submitFeedback['submitData']['e-mail'] ?? '') ?>"
                            class="border border-white/25 rounded-2xl px-4 py-1 placeholder-gray-300 focus:outline-none focus:border-white w-full">
                </label>
                <span class="error-msg hidden  text-red-400 text-sm font-bold">erreur</span>
            </div>
            <div class="field-wrapper">
                <div id="signupPwdInput" class="mb-1 border border-white/25 rounded-2xl py-1 placeholder-gray-300 flex items-center justify-center">
                    <label for="pwd" class="grow"> <span class="hidden">Password</span>
                        <input type="password" name="pwd" id="signupPassword" placeholder="Password" class="composed-field placeholder-gray-300 pl-4 focus:outline-none focus:ring-0">
                    </label>
                    <button type="button" id="signupTogglePwd" class="text-gray-300 w-12 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="signupShowPwdIcon" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="signupHidePwdIcon" class="size-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <span class="error-msg hidden  text-red-400 text-sm font-bold">erreur</span>
                <ul id="signupPwdComplexRule" class="hidden">
                    <li class="lengthCheck text-red-400 text-sm"><span class="emojiValid">❌</span> is more than 8 characters long</li>
                    <li class="uppercaseCheck text-red-400 text-sm"><span class="emojiValid">❌</span> Contains an uppercase letter (A,B,C,...)</li>
                    <li class="numberCheck text-red-400 text-sm"><span class="emojiValid">❌</span> Contains a number (1,2,3,...)</li>
                    <li class="specialCharCheck text-red-400 text-sm"><span class="emojiValid">❌</span> Contains a special character (!@#$%^&*)</li>
                </ul>
            </div>
            <div class="field-wrapper">
                <div id="signupConfirmPwdInput" class="mb-1 border border-white/25 rounded-2xl py-1 placeholder-gray-300 flex items-center justify-center">
                    <label for="confirmPwd" class="grow"> <span class="hidden">Confirm password</span>
                        <input type="password" name="confirmPwd" id="signupConfirmPassword" placeholder="Confirm password" class="composed-field placeholder-gray-300 pl-4 focus:outline-none focus:ring-0">
                    </label>
                    <button type="button" id="signupConfirmTogglePwd" class="text-gray-300 w-12 flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="signupConfirmShowPwdIcon" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" id="signupConfirmHidePwdIcon" class="size-6 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <span class="error-msg hidden  text-red-400 text-sm font-bold">erreur</span>
            </div>
            <button type="button" id="signup-submit-btn" class="bt-primary px-8 py-2 rounded-2xl uppercase text-md font-bold shadow-lg shadow-pink-600/50 hover:shadow-orange-300 transition-all duration-450 ease-in-out">Signup</button>
        </form>
    </div>
</main>
<div class="snackbar bg-black/50 opacity-0 translate-y-10" id="snackbar">
    <div class="snackbar-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-[rgb(234,148,103)]">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </div>
    <div class="snackbar-text">
        <p class="snackbar-title">Account created successfully</p>
        <p class="snackbar-sub">Welcome! You can now log in.</p>
    </div>
    <button id="snackbar-close">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <div class="progress-bar" id="progress-bar"></div>
</div>
</body>
<div id="submit-data" data-feedback="<?= htmlspecialchars(json_encode($submitFeedback)) ?>"></div>
</html>
<script src="./js/index.js"></script>
