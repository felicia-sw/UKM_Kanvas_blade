        function viewPaymentProof(imageUrl) {
            document.getElementById('paymentProofImage').src = imageUrl;
            const modal = new bootstrap.Modal(document.getElementById('paymentProofModal'));
            modal.show();
        }
