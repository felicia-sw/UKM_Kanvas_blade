document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.btn-filter');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const visibleCountElement = document.getElementById('visibleCount');
    const categoryNameElement = document.getElementById('categoryName');
    
    // Debug: Log all items and their categories
    console.log('=== Gallery Items Debug ===');
    galleryItems.forEach((item, index) => {
        const category = item.getAttribute('data-category');
        const title = item.querySelector('.text-white.fw-bold')?.textContent || 'Unknown';
        console.log(`Item ${index + 1}: "${title}" - Category: "${category}"`);
    });
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter').toLowerCase().trim();
            const categoryName = this.textContent.trim();
            let visibleCount = 0;
            
            console.log(`\n=== Filtering by: "${filter}" ===`);
            
            galleryItems.forEach((item, index) => {
                const itemCategory = item.getAttribute('data-category').toLowerCase().trim();
                const title = item.querySelector('.text-white.fw-bold')?.textContent || 'Unknown';
                
                const shouldShow = filter === 'all' || itemCategory === filter;
                
                console.log(`Item ${index + 1} "${title}": category="${itemCategory}", filter="${filter}", show=${shouldShow}`);
                
                if (shouldShow) {
                    item.classList.remove('hidden');
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                    item.style.display = 'none';
                }
            });
            
            console.log(`Visible items: ${visibleCount}`);
            
            // Update visible count with animation
            if (visibleCountElement) {
                visibleCountElement.style.transform = 'scale(1.2)';
                visibleCountElement.style.color = '#FF750F';
                setTimeout(() => {
                    visibleCountElement.textContent = visibleCount;
                    visibleCountElement.style.transform = 'scale(1)';
                    visibleCountElement.style.color = '#FFEC77';
                }, 200);
            }
            
            // Update category name
            if (categoryNameElement) {
                const displayName = filter === 'all' ? 'All Categories' : categoryName;
                categoryNameElement.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    categoryNameElement.textContent = displayName;
                    categoryNameElement.style.transform = 'scale(1)';
                }, 200);
            }
            
            // Trigger AOS refresh to re-animate visible items
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        });
    });
    
    // Show all items initially
    galleryItems.forEach(item => {
        item.classList.remove('hidden');
        item.style.display = '';
    });
});

// Modal popup functions
function togglePopup(event, artworkId) {
    event.stopPropagation();
    const modal = document.getElementById(`popup-${artworkId}`);
    
    // Close all other modals
    document.querySelectorAll('.artwork-modal-overlay').forEach(m => {
        m.classList.remove('active');
    });
    
    // Open current modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closePopup(artworkId) {
    const modal = document.getElementById(`popup-${artworkId}`);
    modal.classList.remove('active');
    document.body.style.overflow = ''; // Restore scrolling
}

// Close modal when pressing ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.artwork-modal-overlay').forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
    }
});

// Share functions
function shareArtwork(platform) {
    const url = window.location.href;
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=Check out this amazing artwork!`;
            break;
        case 'instagram':
            alert('Please share via Instagram app');
            return;
    }
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard!');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
}
