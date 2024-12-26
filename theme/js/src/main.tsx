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
