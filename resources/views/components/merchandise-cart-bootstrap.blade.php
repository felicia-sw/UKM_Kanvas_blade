<!-- Floating Cart Button -->
<button
    class="btn btn-primary rounded-circle position-fixed bottom-0 end-0 m-4 p-3 shadow-lg"
    type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas"
    aria-controls="cartOffcanvas"
    style="background: linear-gradient(to right, #fd7e14, #0dcaf0); border: none; width: 60px; height: 60px; z-index: 1050;">
    <i class="bi bi-cart-fill fs-5"></i>
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartBadge">
        0
    </span>
</button>

<!-- Cart Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel" style="width: 28rem;">
    <div class="offcanvas-header text-white" style="background: linear-gradient(to right, #fd7e14, #0dcaf0);">
        <div>
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">Exchange Hub</h5>
            <small>Your community connections</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="text-white text-center py-3" style="background: linear-gradient(to right, #0dcaf0, #0d6efd);">
        <div class="fs-6 fw-semibold mb-1" id="exchangeCount">0 Active Exchange Requests</div>
        <div class="small opacity-90">Ready to connect with your neighbors</div>
    </div>

    <div class="offcanvas-body p-4" id="cartItems">
        <!-- Sample Item -->
        <div class="card cart-item mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                             style="width: 50px; height: 50px; background: linear-gradient(to bottom right, #fd7e14, #0dcaf0);">
                            SM
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-semibold mb-1">Weekly Sourdough Bread</h6>
                        <p class="text-muted small mb-0">Posted by Sarah M. • 2 days ago</p>
                    </div>
                </div>
                <div class="bg-light rounded p-3">
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-2">
                            <i class="bi bi-circle-fill text-success me-2 small"></i>Offering
                        </div>
                        <p class="small">Fresh homemade sourdough bread, delivered weekly.</p>
                    </div>
                    <hr>
                    <div>
                        <div class="text-muted small text-uppercase fw-bold mb-2">
                            <i class="bi bi-circle-fill text-warning me-2 small"></i>Seeking
                        </div>
                        <p class="small">Lawn mowing service for small front yard.</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white d-flex gap-2">
                <button class="btn btn-sm btn-primary w-100">Connect</button>
                <button class="btn btn-sm btn-outline-danger w-100" onclick="removeItem(this)">Remove</button>
            </div>
        </div>
    </div>

    <div class="offcanvas-footer p-3 bg-light border-top">
        <div class="d-grid gap-2">
            <button class="btn btn-outline-primary">Browse More</button>
            <button class="btn btn-primary" style="background: linear-gradient(to right, #fd7e14, #0dcaf0); border: none;">Start Exchange</button>
        </div>
    </div>
</div>
