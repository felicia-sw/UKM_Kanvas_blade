/**
 * Removes an exchange item from the cart.
 * @param {HTMLElement} button - The remove button that was clicked.
 */
function removeItem(button) {
    const item = button.closest('.cart-item');
    if (item) {
        // Optional: Add an animation before removing
        item.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
        item.style.transform = 'translateX(100%)';
        item.style.opacity = '0';

        setTimeout(() => {
            item.remove();
            updateCartCount();
        }, 300);
    }
}

/**
 * Updates the cart count badge and the summary text.
 */
function updateCartCount() {
    const items = document.querySelectorAll('#cartItems .cart-item');
    const count = items.length;
    const badge = document.getElementById('cartBadge');
    const countElement = document.getElementById('exchangeCount');
    const cartItemsContainer = document.getElementById('cartItems');

    if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'block' : 'none';
    }

    if (countElement) {
        countElement.textContent = `${count} Active Exchange Request${count !== 1 ? 's' : ''}`;
    }

    // Show a message if the cart is empty
    if (count === 0 && cartItemsContainer) {
        cartItemsContainer.innerHTML = `
            <div class="text-center text-muted p-5">
                <i class="bi bi-cart-x" style="font-size: 4rem;"></i>
                <h5 class="mt-3">No Exchange Requests Yet</h5>
                <p class="small">Start connecting with your community!</p>
            </div>
        `;
    }
}

// Initial count update when the page loads
document.addEventListener('DOMContentLoaded', updateCartCount);
