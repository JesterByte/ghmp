<!-- Add Custom Payment Plan Modal -->
<div class="modal fade" id="add-custom-payment-plan-modal" tabindex="-1" aria-labelledby="add-custom-payment-plan-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="add-custom-payment-plan-modal-label">Add Custom Payment Plan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add-custom-payment-plan" id="add-custom-payment-plan-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                    <?php if ($currentPage === "Lot"): ?>
                        <div class="form-floating mb-3">
                            <select name="phase" required id="phase" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="Phase 1">1</option>
                                <option value="Phase 2">2</option>
                                <option value="Phase 3">3</option>
                                <option value="Phase 4">4</option>
                            </select>
                            <label for="phase">Phase</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select name="lot-type" required id="lot-type" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="Supreme">Supreme</option>
                                <option value="Special">Special</option>
                                <option value="Standard">Standard</option>
                            </select>
                            <label for="lot-type">Lot Type</label>
                        </div>
                    <?php elseif ($currentPage === "Estate"): ?>
                        <div class="form-floating mb-3">
                            <select name="estate" required id="estate" class="form-select">
                                <option value="" disabled selected></option>
                                <option value="Estate A">Estate A</option>
                                <option value="Estate B">Estate B</option>
                                <option value="Estate C">Estate C</option>
                            </select>
                            <label for="estate">Estate Type</label>
                        </div>
                    <?php endif; ?>

                    <label for="new-lot-price" class="form-label">Total Purchase Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" id="new-lot-price" name="new-lot-price" 
                               aria-label="Amount (to the nearest peso)" placeholder="0.00" readonly required>
                    </div>

                    <label for="interest-rate" class="form-label">Interest Rate</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="interest-rate" name="interest-rate" placeholder="0.00" required>
                        <span class="input-group-text">%</span>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="term" required placeholder="Term (Years)" id="term" class="form-control">
                        <label for="term">Term (Years)</label>
                    </div>

                    <label for="down-payment-rate" class="form-label">Down Payment Rate</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="down-payment-rate" name="down-payment-rate" placeholder="0.00" required>
                        <span class="input-group-text">%</span>
                    </div>

                    <label for="down-payment" class="form-label">Down Payment</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" id="down-payment" name="down-payment" 
                               aria-label="Amount (to the nearest peso)" placeholder="0.00" readonly required>
                    </div>

                    <label for="motnhly-payment" class="form-label">Monthly Payment</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" id="motnhly-payment" name="motnhly-payment" 
                               aria-label="Amount (to the nearest peso)" placeholder="0.00" readonly required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="add-custom-payment-plan-form" name="add-custom-payment-plan-submit">Add Payment</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all form elements
    const form = document.getElementById('add-custom-payment-plan-form');
    const lotPriceInput = document.getElementById('new-lot-price');
    const interestRateInput = document.getElementById('interest-rate');
    const termInput = document.getElementById('term');
    const downPaymentRateInput = document.getElementById('down-payment-rate');
    const downPaymentInput = document.getElementById('down-payment');
    const monthlyPaymentInput = document.getElementById('motnhly-payment');

    // Function to calculate payments
    function calculatePayments() {
        const totalPrice = parseFloat(lotPriceInput.value) || 0;
        const interestRate = parseFloat(interestRateInput.value) || 0;
        const term = parseFloat(termInput.value) || 0;
        const downPaymentRate = parseFloat(downPaymentRateInput.value) || 0;

        if (totalPrice && interestRate && term && downPaymentRate) {
            // Calculate down payment
            const downPayment = totalPrice * (downPaymentRate / 100);
            downPaymentInput.value = downPayment.toFixed(2);

            // Calculate remaining balance
            const principal = totalPrice - downPayment;
            
            // Calculate total interest
            const totalInterest = principal * (interestRate / 100) * term;
            
            // Calculate total amount to be paid in installments
            const totalInstallmentAmount = principal + totalInterest;
            
            // Calculate monthly payment
            const numberOfMonths = term * 12;
            const monthlyPayment = totalInstallmentAmount / numberOfMonths;
            
            monthlyPaymentInput.value = monthlyPayment.toFixed(2);
        }
    }

    // Add event listeners for automatic calculation
    [interestRateInput, termInput, downPaymentRateInput].forEach(input => {
        input.addEventListener('input', calculatePayments);
    });

    // Lot price fetch logic
    const phaseSelect = document.getElementById('phase');
    const lotTypeSelect = document.getElementById('lot-type');
    const estateTypeSelect = document.getElementById('estate');

    <?php if ($currentPage === "Lot"): ?>
        function updateLotPrice() {
            if (phaseSelect.value && lotTypeSelect.value) {
                fetch(`<?= BASE_URL ?>/custom-payment-plans-lot/get-phase-price`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        phase: phaseSelect.value,
                        lot_type: lotTypeSelect.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.price) {
                        lotPriceInput.value = data.price;
                        calculatePayments();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        phaseSelect.addEventListener('change', updateLotPrice);
        lotTypeSelect.addEventListener('change', updateLotPrice);

    <?php elseif ($currentPage === "Estate"): ?>
        function updateEstatePrice() {
            if (estateTypeSelect.value) {
                fetch(`<?= BASE_URL ?>/custom-payment-plans-estate/get-estate-price`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        estate: estateTypeSelect.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.price) {
                        lotPriceInput.value = data.price;
                        calculatePayments();
                    } else {
                        console.error('No price data received');
                    }
                })
                .catch(error => {
                    console.error('Error fetching estate price:', error);
                    lotPriceInput.value = '0.00';
                    calculatePayments();
                });
            }
        }

        estateTypeSelect.addEventListener('change', updateEstatePrice);
    <?php endif; ?>
});
</script>