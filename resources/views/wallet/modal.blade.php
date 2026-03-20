<div class="modal fade" id="walletModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Wallet</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h3 class="fw-bold">
                    ₹{{ number_format($walletBalance ?? 0, 2) }}
                </h3>
                <p class="text-muted">Available balance</p>

                <!-- Top up form will go here next -->
            </div>

        </div>
    </div>
</div>