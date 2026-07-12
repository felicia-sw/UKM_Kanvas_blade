        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

        });

        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // spy bisa gradient span entire page height
        function updateGradientHeight() {
            const body = document.body;
            const html = document.documentElement;
            const height = Math.max(
                body.scrollHeight,
                body.offsetHeight,
                html.clientHeight,
                html.scrollHeight,
                html.offsetHeight
            );
            body.style.backgroundSize = `100% ${height}px`;
        }

        // update on load and resize
        window.addEventListener('load', updateGradientHeight);
        window.addEventListener('resize', updateGradientHeight);

        // kasih short delayto update 
        setTimeout(updateGradientHeight, 100);
