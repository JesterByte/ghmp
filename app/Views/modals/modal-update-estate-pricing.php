<!-- Update Estate Price Modal -->
<div class="modal fade" id="pricing-update-estate-modal" tabindex="-1" aria-labelledby="pricing-update-estate-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header text-bg-primary">
            <h1 class="modal-title fs-5" id="pricing-update-estate-modal-label">Update Estate Pricing</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="estate-pricing" method="post" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                    <select class="form-select" id="estate" name="estate" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Estate A">A</option>
                        <option value="Estate B">B</option>
                        <option value="Estate C">C</option>
                    </select>
                    <label for="estate">Estate</label>                
                </div>
                <label for="new-estate-price" class="form-label">New Estate Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="number" class="form-control" step="0.01" id="new-estate-price" name="new-estate-price" aria-label="Amount (to the nearest peso)" placeholder="0.00" required>
                </div>               

                <div class="price-calculations mt-4 border-top pt-3">
                    <h6 class="fw-bold">Price Breakdown:</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span>Base Price:</span>
                                <span id="estate-base-price">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>VAT (12%):</span>
                                <span id="estate-vat">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>MCF:</span>
                                <span id="estate-mcf">₱10,000.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold border-top pt-2">
                                <span>Total Purchase Price:</span>
                                <span id="estate-total-price">₱0.00</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="fw-bold mt-2">Option 1: Cash Sale</h6>
                            <div class="d-flex justify-content-between">
                                <span>Discount (10%):</span>
                                <span id="estate-cash-discount">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Final Price:</span>
                                <span id="estate-cash-final">₱0.00</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="fw-bold mt-2">Option 2: 6 Months</h6>
                            <div class="d-flex justify-content-between">
                                <span>Discount (5%):</span>
                                <span id="estate-sixmonth-discount">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Final Price:</span>
                                <span id="estate-sixmonth-final">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Down Payment (20%):</span>
                                <span id="estate-sixmonth-dp">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Monthly Payment:</span>
                                <span id="estate-sixmonth-monthly">₱0.00</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <h6 class="fw-bold mt-2">Option 3: Installment Plans</h6>
                            <div class="d-flex justify-content-between">
                                <span>Down Payment (20%):</span>
                                <span id="estate-installment-dp">₱0.00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Balance:</span>
                                <span id="estate-installment-balance">₱0.00</span>
                            </div>
                            <div class="installment-details">
                                <div class="d-flex justify-content-between">
                                    <span>1 Year (0%):</span>
                                    <span id="estate-year1-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>2 Years (10%):</span>
                                    <span id="estate-year2-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>3 Years (15%):</span>
                                    <span id="estate-year3-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>4 Years (20%):</span>
                                    <span id="estate-year4-monthly">₱0.00</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>5 Years (25%):</span>
                                    <span id="estate-year5-monthly">₱0.00</span>
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

<script>
document.getElementById('new-estate-price').addEventListener('input', function() {
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
    document.getElementById('estate-base-price').textContent = formatCurrency(basePrice);
    document.getElementById('estate-vat').textContent = formatCurrency(vat);
    document.getElementById('estate-mcf').textContent = formatCurrency(mcf);
    document.getElementById('estate-total-price').textContent = formatCurrency(totalPrice);
    
    document.getElementById('estate-cash-discount').textContent = formatCurrency(cashDiscount);
    document.getElementById('estate-cash-final').textContent = formatCurrency(cashFinal);
    
    document.getElementById('estate-sixmonth-discount').textContent = formatCurrency(sixMonthDiscount);
    document.getElementById('estate-sixmonth-final').textContent = formatCurrency(sixMonthFinal);
    document.getElementById('estate-sixmonth-dp').textContent = formatCurrency(sixMonthDP);
    document.getElementById('estate-sixmonth-monthly').textContent = formatCurrency(sixMonthMonthly);
    
    document.getElementById('estate-installment-dp').textContent = formatCurrency(installmentDP);
    document.getElementById('estate-installment-balance').textContent = formatCurrency(installmentBalance);
    document.getElementById('estate-year1-monthly').textContent = formatCurrency(year1Monthly);
    document.getElementById('estate-year2-monthly').textContent = formatCurrency(year2Monthly);
    document.getElementById('estate-year3-monthly').textContent = formatCurrency(year3Monthly);
    document.getElementById('estate-year4-monthly').textContent = formatCurrency(year4Monthly);
    document.getElementById('estate-year5-monthly').textContent = formatCurrency(year5Monthly);
});
</script>