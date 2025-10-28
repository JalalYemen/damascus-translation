// public/js/auth-frontend.js - Handles the authentication modal and Laravel auth interactions (Simple Auth, No Verification).

import { getCurrentLang, getDynamicMessage, sanitizeForBackend } from './main.js';

document.addEventListener("DOMContentLoaded", () => {
    // --- Get all HTML elements ---
    const authModal = document.getElementById('auth-modal');
    const overlay = document.getElementById('overlay');
    const authToggle = document.getElementById('auth-toggle'); // Button inside the li
    const authCloseButton = document.getElementById('auth-close');
    const signupButton = document.getElementById('signup-button');
    const loginButton = document.getElementById('login-button');
    const googleButton = document.getElementById('google-signin'); // Placeholder for future Google Auth integration
    const logoutButton = document.getElementById('logout-button');
    const emailInput = document.getElementById('auth-email');
    const passwordInput = document.getElementById('auth-password');
    const authError = document.getElementById('auth-error');

    // User Nav Elements
    const userNav = document.getElementById('user-nav');
    const userAvatar = document.getElementById('user-avatar');
    const userDropdown = document.getElementById('user-dropdown-menu');
    const dropdownUserEmail = document.getElementById('dropdown-user-email');

    // Get the LIST ITEM for the auth toggle button
    const authToggleLi = document.getElementById('auth-toggle-li');

    // Retrieve CSRF token from the meta tag
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // --- Modal functions ---
    const openAuthModal = () => {
        if (authModal) authModal.style.display = 'flex';
        if (overlay) overlay.style.display = 'block';
        if (authError) authError.textContent = ''; // Clear previous errors
        if (emailInput) emailInput.value = ''; // Clear inputs
        if (passwordInput) passwordInput.value = '';
    };
    const closeModal = () => {
        if (authModal) authModal.style.display = 'none';
        if (overlay) overlay.style.display = 'none';
        if (authError) authError.textContent = '';
    };

    // --- Attach Event Listeners ---
    if (authToggle) authToggle.addEventListener('click', openAuthModal);
    if (authCloseButton) authCloseButton.addEventListener('click', closeModal);
    if (overlay) overlay.addEventListener('click', closeModal);

    // Logout via Laravel backend
    if (logoutButton) logoutButton.addEventListener('click', async (e) => {
        e.preventDefault();

        try {
            const response = await fetch('/logout', { // URL is still /logout
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    _token: CSRF_TOKEN
                })
            });

            // Attempt to parse JSON response. If server sent HTML (e.g. 419), this will throw a SyntaxError.
            let data = null; // Initialize data as null
            try {
                data = await response.json();
            } catch (jsonParseError) {
                // If it's a 419 HTML response, this will catch the SyntaxError
                // We'll handle 419 explicitly by status, otherwise a generic error.
                console.error('Failed to parse JSON response on logout (possibly HTML 419):', jsonParseError);
            }

            if (response.ok) { // Status 200-299
                console.log('Logout successful:', data ? data.message : 'No message from server');
                window.location.href = '/'; // Always reload/redirect after successful logout
            } else { // Status 4xx, 5xx
                let errorMessage = getDynamicMessage('Logout failed. Please try again.', 'فشل تسجيل الخروج. الرجاء المحاولة مرة أخرى.');
                
                if (response.status === 419) {
                    errorMessage = getDynamicMessage('Your session has expired. Please refresh and try again.', 'انتهت جلستك. الرجاء تحديث الصفحة والمحاولة مرة أخرى.');
                } else if (data && data.message) { // Generic error message from JSON response
                    errorMessage = data.message;
                } else if (data && data.errors) { // Specific validation errors (less likely on logout but robust)
                    errorMessage = Object.values(data.errors).map(err => err.join(', ')).join('\n');
                } else { // Fallback for network errors or unhandled HTTP status
                    errorMessage = `${errorMessage} (Status: ${response.status} ${response.statusText})`;
                }
                authError.textContent = errorMessage;
                console.error('Logout failed:', response, data); // Log full response and parsed data for debugging
            }
        } catch (error) { // Catches network errors or problems with `response.json()`
            console.error('Network or unexpected error during logout:', error);
            // This happens for true network errors, or when `response.json()` throws a SyntaxError on 419 HTML.
            authError.textContent = getDynamicMessage('An unexpected error occurred during logout. Please try again.', 'حدث خطأ غير متوقع أثناء تسجيل الخروج. الرجاء المحاولة مرة أخرى.');
        }
    });

    // Login via Laravel backend
    if (loginButton) loginButton.addEventListener('click', async (e) => {
        e.preventDefault();
        authError.textContent = ''; // Clear previous errors
        if (!emailInput.value || !passwordInput.value) {
            authError.textContent = getDynamicMessage('Please enter email and password.', 'الرجاء إدخال البريد الإلكتروني وكلمة المرور.');
            return;
        }

        try {
            const response = await fetch('/login', { // Still targets /login
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    email: sanitizeForBackend(emailInput.value),
                    password: sanitizeForBackend(passwordInput.value),
                    _token: CSRF_TOKEN
                })
            });

            const data = await response.json();
            if (response.ok) {
                console.log('Login successful:', data.message);
                closeModal();
                // --- SIMPLIFIED: Always reload on successful login ---
                window.location.reload(); 
            } else {
                let errorMessage = data.message || getDynamicMessage('Login failed. Check credentials.', 'فشل تسجيل الدخول. تحقق من البيانات.');
                 if (data.errors) {
                    errorMessage += "\n" + Object.values(data.errors).map(err => err.join(', ')).join('\n');
                }
                authError.textContent = errorMessage;
                console.error('Login failed:', data);
            }
        } catch (error) {
            console.error('Network or unexpected error during login:', error);
            authError.textContent = getDynamicMessage('An error occurred during login. Check console for details.', 'حدث خطأ أثناء تسجيل الدخول. تحقق من وحدة التحكم للمزيد من التفاصيل.');
        }
    });

    // Registration via Laravel backend
    if (signupButton) signupButton.addEventListener('click', async (e) => {
        e.preventDefault();
        authError.textContent = ''; // Clear previous errors
        if (!emailInput.value || !passwordInput.value) {
            authError.textContent = getDynamicMessage('Please enter email and password.', 'الرجاء إدخال البريد الإلكتروني وكلمة المرور.');
            return;
        }

        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    email: sanitizeForBackend(emailInput.value),
                    password: sanitizeForBackend(passwordInput.value),
                    _token: CSRF_TOKEN
                })
            });

            const data = await response.json();
            if (response.ok) {
                console.log('Registration successful:', data.message);
                closeModal();
                // --- SIMPLIFIED: Always reload on successful registration ---
                window.location.reload(); 
            } else {
                let errorMessage = data.message || getDynamicMessage('Registration failed. Please try again.', 'فشل التسجيل. الرجاء المحاولة مرة أخرى.');
                if (data.errors) {
                    errorMessage += "\n" + Object.values(data.errors).map(err => err.join(', ')).join('\n');
                }
                authError.textContent = errorMessage;
                console.error('Registration failed:', data);
            }
        } catch (error) {
            console.error('Network or unexpected error during registration:', error);
            authError.textContent = getDynamicMessage('An error occurred during registration. Check console for details.', 'حدث خطأ أثناء التسجيل.');
        }
    });

    // Google Sign-in placeholder (needs Laravel backend integration like Laravel Socialite in future)
    if (googleButton) googleButton.addEventListener('click', () => {
       window.location.href = '/auth/google/redirect';
    });

    // Dropdown functionality for user avatar
    if (userAvatar) {
        userAvatar.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('show-dropdown');
        });
    }
    window.addEventListener('click', () => {
        if (userDropdown && userDropdown.classList.contains('show-dropdown')) {
            userDropdown.classList.remove('show-dropdown');
        }
    });

    /**
     * Updates the UI based on user authentication state.
     * @param {object|null} user The authenticated user object from Laravel, or null if logged out.
     */
    function updateAuthUI(user) {
        if (user) {
            if (userNav) userNav.style.display = 'block';
            if (authToggleLi) authToggleLi.style.display = 'none';

            // Populate Avatar Initial
            if (userAvatar && user.email) {
                userAvatar.textContent = user.email.charAt(0).toUpperCase();
            }
            // Populate Dropdown Email
            if (dropdownUserEmail && user.email) {
                dropdownUserEmail.textContent = user.email;
            }
        } else {
            if (userNav) userNav.style.display = 'none';
            if (authToggleLi) authToggleLi.style.display = 'block';
            if (userDropdown) userDropdown.classList.remove('show-dropdown');
        }
    }
});