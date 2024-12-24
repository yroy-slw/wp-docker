import { SCROLL_THRESHOLD } from './constants';

/**
 * Adds or removes the "header-visible" class on the <body> element
 * based on the scroll position of the page.
 */
window.addEventListener('scroll', () => {
    const body = document.body;
    const scrollTop = window.scrollY;

    /**
     * If the scroll position is greater than or equal to 200 pixels,
     * add the "is-scrolled" class to the <body> element.
     */
    if (scrollTop >= SCROLL_THRESHOLD) {
        body.classList.add('is-scrolled');
    } else {
        body.classList.remove('is-scrolled');
    }
});
