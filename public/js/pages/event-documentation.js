function togglePopup(event, id) {
    event.stopPropagation();
    const popup = document.getElementById('popup-' + id);
    popup.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePopup(id) {
    const popup = document.getElementById('popup-' + id);
    popup.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close popup with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const activePopup = document.querySelector('.documentation-modal-overlay.active');
        if (activePopup) {
            activePopup.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
});
