import { SCROLL_THRESHOLD } from './constants';
import { isScrollBeyondThreshold, toggleClass } from './utils';

/**
 * Handles the scroll event and updates the <body> element's class
 * based on the current scroll position.
 */
const handleScroll = (): void => {
    const scrollTop = window.scrollY;
    const body = document.body;
	const headerVisibleClass = 'is-scrolled';

    // Determine if the scroll position exceeds the threshold
    const isBeyondThreshold = isScrollBeyondThreshold(scrollTop, SCROLL_THRESHOLD);

    // Toggle the "header-visible" class on the <body> element
    toggleClass(body, headerVisibleClass, isBeyondThreshold);
};

// Attach the scroll handler to the window
window.addEventListener('scroll', handleScroll);

/**
 * Toggles the navigation menu and manages button visibility.
 */
const toggleMenu = (): void => {
    const navMenuClass = 'cds-nav--visible';
    const navMenu = document.querySelector('.cds-nav'); // Navigation menu
    const openButton = document.querySelector('.cds-header__button'); // Open button
    const closeButton = document.querySelector('.cds-nav__button'); // Close button

    if (navMenu instanceof HTMLElement && openButton instanceof HTMLElement && closeButton instanceof HTMLElement) {
        const isMenuVisible = navMenu.classList.contains(navMenuClass);

        // Toggle the nav menu visibility
        toggleClass(navMenu, navMenuClass, !isMenuVisible);

        // Toggle visibility of the buttons
        toggleClass(openButton, 'is-hidden', !isMenuVisible); // Hide open button when menu is visible
        toggleClass(closeButton, 'is-hidden', isMenuVisible); // Show close button when menu is visible
    }
};

/**
 * Initialize event listeners for the open and close buttons.
 */
document.addEventListener('DOMContentLoaded', () => {
    const openButton = document.querySelector('.cds-header__button');
    const closeButton = document.querySelector('.cds-nav__button');

    if (openButton) {
        openButton.addEventListener('click', toggleMenu);
    }

    if (closeButton) {
        closeButton.addEventListener('click', toggleMenu);
    }
});
