<!-- Update Phase Price Modal -->
<div class="modal fade" id="pricing-update-phase-modal" tabindex="-1" aria-labelledby="pricing-update-phase-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header text-bg-primary">
            <h1 class="modal-title fs-5" id="pricing-update-phase-modal-label">Update Phase Pricing</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="phase-pricing" method="post" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                    <select class="form-select" id="phase" name="phase" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Phase 1">1</option>
                        <option value="Phase 2">2</option>
                        <option value="Phase 3">3</option>
                        <option value="Phase 4">4</option>
                    </select>
                    <label for="phase">Phase</label>                
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="lot-type" name="lot-type" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Supreme">Supreme</option>
                        <option value="Special">Special</option>
                        <option value="Standard">Standard</option>
                    </select>
                    <label for="lot-type">Lot Type</label>                      
                </div>
                <label for="new-lot-price" class="form-label">New Lot Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="number" class="form-control" id="new-lot-price" name="new-lot-price" aria-label="Amount (to the nearest peso)" placeholder="0.00" required>
                </div>               

                <div class="price-calculations mt-4 border-top pt-3">
                    <h6 class="fw-bold">Price Breakdown:</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span>Base Price:</span>
                                <span id="base-price">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>VAT (12%):</span>
                                <span id="vat">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>MCF:</span>
                                <span id="mcf">₱10,000.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold border-top pt-2">
                                <span>Total Purchase Price:</span>
                                <span id="total-price">₱0.00</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="fw-bold mt-2">Option 1: Cash Sale</h6>
                            <div class="d-flex justify-content-between">
                                <span>Discount (10%):</span>
                                <span id="cash-discount">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Final Price:</span>
                                <span id="cash-final">₱0.00</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="fw-bold mt-2">Option 2: 6 Months</h6>
                            <div class="d-flex justify-content-between">
                                <span>Discount (5%):</span>
                                <span id="sixmonth-discount">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Final Price:</span>
                                <span id="sixmonth-final">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Down Payment (20%):</span>
                                <span id="sixmonth-dp">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Monthly Payment:</span>
                                <span id="sixmonth-monthly">₱0.00</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="fw-bold mt-2">Option 3: Installment Plans</h6>
                            <div class="d-flex justify-content-between">
                                <span>Down Payment (20%):</span>
                                <span id="installment-dp">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Balance:</span>
                                <span id="installment-balance">₱0.00</span>
                            </div>
                            <div class="installment-details">
                                <div class="d-flex justify-content-between">
                                    <span>1 Year (0%):</span>
                                    <span id="year1-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>2 Years (10%):</span>
                                    <span id="year2-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>3 Years (15%):</span>
                                    <span id="year3-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>4 Years (20%):</span>
                                    <span id="year4-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>5 Years (25%):</span>
                                    <span id="year5-monthly">₱0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update-pricing-submit">Update</button>
            </form>
        </div>
        </div>
    </div>
</div>

<style>
.price-calculations {
    font-size: 0.9rem;
}

.price-calculations .row > div {
    padding: 12px;
    background-color: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 12px;
}

.price-calculations .d-flex {
    margin-bottom: 6px;
}

.price-calculations h6 {
    color: #0d6efd;
    margin-bottom: 12px;
}

.installment-details {
    padding-left: 12px;
    border-left: 3px solid #dee2e6;
    margin-top: 8px;
}
</style>

<script>
document.getElementById('new-lot-price').addEventListener('input', function() {
    const basePrice = parseFloat(this.value) || 0;
    const vat = basePrice * 0.12;
    const mcf = 10000;
    const totalPrice = basePrice + vat + mcf;

    // Cash Sale (Option 1)
    const cashDiscount = totalPrice * 0.10;
    const cashFinal = totalPrice - cashDiscount;

    // 6 Months (Option 2)
    const sixMonthDiscount = totalPrice * 0.05;
    const sixMonthFinal = totalPrice - sixMonthDiscount;
    const sixMonthDP = sixMonthFinal * 0.20;
    const sixMonthMonthly = (sixMonthFinal - sixMonthDP) / 6;

    // Installment Plans (Option 3)
    const installmentDP = totalPrice * 0.20;
    const installmentBalance = totalPrice - installmentDP;

    // Calculate monthly payments for different years with interest
    const year1Monthly = installmentBalance / 12; // 0% interest
    const year2Monthly = (installmentBalance * 1.10) / 24; // 10% interest
    const year3Monthly = (installmentBalance * 1.15) / 36; // 15% interest
    const year4Monthly = (installmentBalance * 1.20) / 48; // 20% interest
    const year5Monthly = (installmentBalance * 1.25) / 60; // 25% interest

    function formatCurrency(amount) {
        return '₱' + amount.toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Update all price displays
    document.getElementById('base-price').textContent = formatCurrency(basePrice);
    document.getElementById('vat').textContent = formatCurrency(vat);
    document.getElementById('mcf').textContent = formatCurrency(mcf);
    document.getElementById('total-price').textContent = formatCurrency(totalPrice);
    
    document.getElementById('cash-discount').textContent = formatCurrency(cashDiscount);
    document.getElementById('cash-final').textContent = formatCurrency(cashFinal);
    
    document.getElementById('sixmonth-discount').textContent = formatCurrency(sixMonthDiscount);
    document.getElementById('sixmonth-final').textContent = formatCurrency(sixMonthFinal);
    document.getElementById('sixmonth-dp').textContent = formatCurrency(sixMonthDP);
    document.getElementById('sixmonth-monthly').textContent = formatCurrency(sixMonthMonthly);
    
    document.getElementById('installment-dp').textContent = formatCurrency(installmentDP);
    document.getElementById('installment-balance').textContent = formatCurrency(installmentBalance);
    document.getElementById('year1-monthly').textContent = formatCurrency(year1Monthly);
    document.getElementById('year2-monthly').textContent = formatCurrency(year2Monthly);
    document.getElementById('year3-monthly').textContent = formatCurrency(year3Monthly);
    document.getElementById('year4-monthly').textContent = formatCurrency(year4Monthly);
    document.getElementById('year5-monthly').textContent = formatCurrency(year5Monthly);
});
</script>