/**
 * Checks if the current scroll position exceeds a given threshold.
 *
 * @param scrollTop - The current vertical scroll position.
 * @param threshold - The scroll threshold to compare against.
 * @returns True if the scroll position exceeds the threshold, false otherwise.
 */
export const isScrollBeyondThreshold = (scrollTop: number, threshold: number): boolean => {
    return scrollTop >= threshold;
};

/**
 * Toggles a class on an HTML element based on a condition.
 *
 * @param element - The HTML element to modify.
 * @param className - The class name to toggle.
 * @param condition - The condition to determine whether to add or remove the class.
 */
export const toggleClass = (element: HTMLElement, className: string, condition: boolean): void => {
    if (condition) {
        element.classList.add(className);
    } else {
        element.classList.remove(className);
    }
};