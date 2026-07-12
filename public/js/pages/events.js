document.addEventListener('DOMContentLoaded', function() {
  const eventItems = document.querySelectorAll('.event-item');
  
  // check if device is mobile
  function isMobile() {
    return window.innerWidth <= 576;
  }
  
  function isTablet() {
    return window.innerWidth > 576 && window.innerWidth <= 991;
  }
  
  // Intersection Observer for fly-in animation
  const observerOptions = {
    threshold: isMobile() ? 0.1 : 0.2,
    rootMargin: '0px'
  };
  
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('fly-in');
        } else {
          entry.target.classList.remove('fly-in');
        }
      });
    },
    observerOptions
  );

  // Observe all event items
  eventItems.forEach((item) => {
    observer.observe(item);
  });

  // Scroll-based zoom effect: scale up when element is in center of viewport
  function updateZoomEffect() {
    // Disable zoom effect on very small screens
    if (isMobile()) {
      eventItems.forEach((item) => {
        item.classList.remove('zoom-active');
      });
      return;
    }
    
    const viewportCenter = window.innerHeight / 2;
    
    eventItems.forEach((item) => {
      const rect = item.getBoundingClientRect();
      const itemCenter = rect.top + rect.height / 2;
      
      // Calculate distance from viewport center
      const distanceFromCenter = Math.abs(viewportCenter - itemCenter);
      const maxDistance = window.innerHeight / 2;
      
      // Adjust threshold based on device - more conservative to prevent clipping
      const threshold = isTablet() ? 0.4 : 0.5;
      
      // If item is close to center (within a threshold), apply zoom
      if (distanceFromCenter < maxDistance * threshold && rect.top < window.innerHeight && rect.bottom > 0) {
        // Calculate scale based on proximity to center (closer = larger)
        const proximityRatio = 1 - (distanceFromCenter / (maxDistance * threshold));
        
        // Only add zoom-active class if it's very close to center
        // Increased threshold to make zoom more selective
        if (proximityRatio > 0.6) {
          item.classList.add('zoom-active');
        } else {
          item.classList.remove('zoom-active');
        }
      } else {
        item.classList.remove('zoom-active');
      }
    });
  }
  
  // Run on scroll with throttling for performance
  let ticking = false;
  window.addEventListener('scroll', function() {
    if (!ticking) {
      window.requestAnimationFrame(function() {
        updateZoomEffect();
        ticking = false;
      });
      ticking = true;
    }
  });
  
  // Handle window resize
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      updateZoomEffect();
    }, 250);
  });
  
  // Initial check
  updateZoomEffect();
});
