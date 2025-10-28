// public/js/main.js - New shared utility scripts and global listeners (replaces old Firebase main.js and new general.js)

// A reusable function to get the current language of the document
export const getCurrentLang = () => document.documentElement.lang || 'en';

// A temporary helper to get localized messages client-side for dynamic JS strings.
// In later steps, these will ideally be provided via Laravel data attributes or API.
export const getDynamicMessage = (enText, arText, args = {}) => {
  const selectedText = getCurrentLang() === 'ar' ? arText : enText;
  if (typeof selectedText === 'function') {
      const paramNames = (selectedText.toString().match(/\((.*?)\)/)?.[1] || '').split(',').map(s => s.trim()).filter(s => s !== '');
      const namedArgs = paramNames.reduce((acc, name, index) => {
          if (Array.isArray(args) && args.length > index) {
              acc[name] = args[index];
          } else if (typeof args === 'object' && args !== null && args[name] !== undefined) {
              acc[name] = args[name];
          }
          return acc;
      }, {});
      let result = selectedText.toString().split('=>')[1] || selectedText.toString();
      for (const key in namedArgs) {
          result = result.replace(new RegExp(`:${key}`, 'g'), namedArgs[key]);
          result = result.replace(new RegExp(`{${key}}`, 'g'), namedArgs[key]);
      }
      return result.replace(/^`(.*)`$/s, '$1').trim();
  }
  let finalString = selectedText;
  if (typeof finalString === 'string' && typeof args === 'object' && args !== null) {
      for (const key in args) {
          finalString = finalString.replace(new RegExp(`:${key}`, 'g'), args[key]);
          finalString = finalString.replace(new RegExp(`{${key}}`, 'g'), args[key]);
      }
  }
  return finalString;
};


// Helper: Sanitize values for sending to Laravel backend (e.g., in JSON payload)
export function sanitizeForBackend(v) { // Renamed from sanitizeForEmailJS
  if (v === undefined || v === null) return '';
  if (typeof v === 'object' && !Array.isArray(v)) {
    try { return JSON.stringify(v); } catch (e) { return String(v); }
  }
  return String(v);
}


// Quote button slide-in/out logic (global)
const quoteBtn = document.getElementById("quoteSlideBtn");
const hero = document.querySelector(".hero-section");
const contactSection = document.getElementById("contact");

function getCssVar(name) {
  const value = getComputedStyle(document.documentElement).getPropertyValue(name);
  return parseFloat(value) || 80; // Default for --navbar-height if not found
}

if (quoteBtn && hero && contactSection) {
  window.addEventListener("scroll", () => {
    const navbarHeight = getCssVar("--navbar-height");
    const heroBottom = hero.offsetHeight;
    const contactTop = contactSection.offsetTop;

    const shouldShowQuoteBtn =
      window.scrollY > heroBottom &&
      window.scrollY < contactTop - navbarHeight;

    quoteBtn.classList.toggle("show", shouldShowQuoteBtn);
  });
}

// Navbar collapse/shrink logic (global)
const nav = document.querySelector('.navbar');
const collapseEl = document.getElementById('navbarNav');

if (nav && collapseEl && typeof bootstrap !== "undefined") {
  const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: false });
  let lastScrollY = window.scrollY;

  const toggler = document.querySelector('.navbar-toggler');
  if (toggler) {
    toggler.addEventListener('click', () => {
      // This toggles the menu open/closed
    });
  }

  window.addEventListener('scroll', () => {
    if (window.innerWidth <= 991) {
      if (window.scrollY > lastScrollY && collapseEl.classList.contains('show')) {
        bsCollapse.hide();
      }
      lastScrollY = window.scrollY;
    }
  });

  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      if (collapseEl.classList.contains('show')) {
        bsCollapse.hide();
      }
    });
  });
}