// public/js/index.js - Specific scripts for the homepage (Fully Prepared for Laravel Backend)

// Import shared utilities from the new global main.js
import { getCurrentLang, getDynamicMessage, sanitizeForBackend } from './main.js';

document.addEventListener("DOMContentLoaded", () => {
  // --- START: RESOURCES CAROUSEL INITIALIZATION ---
  const resourcesCarouselElement = document.getElementById('resourcesCarousel');
  if (resourcesCarouselElement) {
      const resourcesCarousel = new bootstrap.Carousel(resourcesCarouselElement, {
          interval: false,
          wrap: true
      });
  }
  // --- END: RESOURCES CAROUSEL INITIALIZATION ---

  // --- START: GENERAL CONTACT FORM LARAVEL INTEGRATION ---
  // EmailJS has been completely removed. This form will submit its data
  // via a standard HTML POST request directly to a Laravel backend endpoint.

  const contactForm = document.getElementById('contactForm');
  const contactSubmitBtn = document.getElementById('contactSubmitBtn');
  const contactFormMessage = document.getElementById('contactFormMessage'); // For displaying Laravel response messages

  if (contactForm && contactSubmitBtn && contactFormMessage) {
    // The 'action' attribute on the form points to our Laravel route `contact.submit` (defined in web.php)
    // The form uses method="POST", and the `@csrf` directive in Blade ensures the CSRF token is included.
    // This JavaScript merely provides immediate UI feedback while the browser handles the actual form submission.
    
    contactForm.addEventListener('submit', function() {
        // Provide immediate visual feedback when the form is submitted
        contactSubmitBtn.disabled = true;
        contactSubmitBtn.textContent = getDynamicMessage('Sending...', 'جاري الإرسال...');
        contactFormMessage.style.display = 'none'; // Clear any previous feedback
        // The Laravel controller will handle the actual processing and any success/error messages (via redirect).
    });
  }
  // --- END: GENERAL CONTACT FORM LARAVEL INTEGRATION ---
});