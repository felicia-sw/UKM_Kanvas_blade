        // Popup functions for home gallery
        function togglePopupHome(event, artworkId) {
            event.stopPropagation();
            const popup = document.getElementById(`popup-home-${artworkId}`);
            const allPopups = document.querySelectorAll('.artwork-popup-home');

            // Close all other popups
            allPopups.forEach(p => {
                if (p.id !== `popup-home-${artworkId}`) {
                    p.classList.remove('active');
                }
            });

            // Toggle current popup
            popup.classList.toggle('active');
        }

        function closePopupHome(artworkId) {
            const popup = document.getElementById(`popup-home-${artworkId}`);
            popup.classList.remove('active');
        }

        // Close popup when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.artwork-card-home') && !event.target.closest('.btn-gradient')) {
                document.querySelectorAll('.artwork-popup-home').forEach(popup => {
                    popup.classList.remove('active');
                });
            }
        });
