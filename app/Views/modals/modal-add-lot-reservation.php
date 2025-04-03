<!-- Update Add Lot Reservation Modal -->
<div class="modal fade" id="add-lot-reservation-modal" tabindex="-1" aria-labelledby="add-lot-reservation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="add-lot-reservation-modal-label">Add New Lot Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add-reservation" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="lot" name="lot" aria-label="Floating label select example" required>
                            <option selected disabled></option>
                            <?php
                            for ($i = 0; $i < count($formattedAvailableLots["available_lot"]); $i++) {
                                echo "<option value='{$formattedAvailableLots["lot_id"][$i]}'>{$formattedAvailableLots["available_lot"][$i]}</option>";
                            }
                            ?>
                        </select>
                        <label for="lot">Available Lots</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="customer" name="customer" aria-label="Floating label select example" required>
                            <option selected disabled></option>
                            <?php
                            for ($i = 0; $i < count($formattedCustomers["customer_id"]); $i++) {
                                echo "<option value='{$formattedCustomers["customer_id"][$i]}'>{$formattedCustomers["customer"][$i]}</option>";
                            }
                            ?>
                        </select>
                        <label for="customer">Customers</label>
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
                    <div class="form-floating mb-3">
                        <select class="form-select" id="payment-option" name="payment-option" aria-label="Floating label select example" required>
                            <option selected disabled></option>
                            <option value="Cash Sale">Cash Sale</option>
                            <option value="6 Months">6 Months</option>
                            <option value="Installment: 1 Year">Installment: 1 Year</option>
                            <option value="Installment: 2 Years">Installment: 2 Years</option>
                            <option value="Installment: 3 Years">Installment: 3 Years</option>
                            <option value="Installment: 4 Years">Installment: 4 Years</option>
                            <option value="Installment: 5 Years">Installment: 5 Years</option>
                        </select>
                        <label for="payment-option">Payment Option</label>
                    </div>

                    <!-- Label for Payable Amount -->
                    <label for="price" class="form-label" id="payable-amount-label">Payable Amount</label>
                    <!-- Price with Peso Sign (Input Group) -->
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">₱</span>
                        <input type="text" class="form-control" id="price" name="price" readonly aria-describedby="basic-addon1">
                    </div>

                    <!-- Label & Input Group for Monthly Payment (Initially Hidden) -->
                    <div id="monthly-payment-group" class="mb-3" style="display: none;">
                        <label for="monthly-payment" class="form-label">Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" id="monthly-payment" name="monthly-payment" readonly>
                        </div>
                    </div>

                    <!-- Receipt Upload Field (Image Only) -->
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="receipt" name="receipt" accept=".jpg,.jpeg,.png" required>
                        <label for="receipt">Upload Receipt (Image Only)</label>
                    </div>

                    <p id="payment-note" class="text-muted small" style="display: none;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="add-lot-reservation-submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const lotSelect = document.getElementById("lot");
        const lotTypeSelect = document.getElementById("lot-type");
        const paymentOptionSelect = document.getElementById("payment-option");
        const priceField = document.getElementById("price");
        const payableAmountLabel = document.getElementById("payable-amount-label");
        const monthlyPaymentGroup = document.getElementById("monthly-payment-group");
        const monthlyPaymentInput = document.getElementById("monthly-payment");
        const paymentNote = document.getElementById("payment-note");

        function fetchPricing() {
            const lotId = lotSelect.value;
            const lotType = lotTypeSelect.value;
            const paymentOption = paymentOptionSelect.value;

            if (!lotId || !lotType || !paymentOption) {
                priceField.value = "Please select all fields";
                monthlyPaymentGroup.style.display = "none";
                paymentNote.style.display = "none";
                return;
            }

            const phase = lotId.charAt(0);

            fetch("<?= BASE_URL ?>/lot-reservations/fetch-phase-pricing", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        phase,
                        lotType,
                        paymentOption
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const price = parseFloat(data.price);
                        priceField.value = price.toFixed(2); // Populate payable amount with data.price

                        if (paymentOption === "Cash Sale") {
                            // For Cash Sale, only show the full price
                            monthlyPaymentGroup.style.display = "none";
                            payableAmountLabel.textContent = "Payable Amount";
                            paymentNote.style.display = "block";
                            paymentNote.textContent = "* The customer must pay the full amount before uploading the receipt.";
                        } else {
                            // For Installments and 6 Months, show monthly payment as well
                            const monthlyPayment = parseFloat(data.monthly_payment);
                            monthlyPaymentInput.value = monthlyPayment.toFixed(2); // Populate monthly payment with data.monthly_payment
                            monthlyPaymentGroup.style.display = "block";
                            payableAmountLabel.textContent = "Payable Amount (Down Payment)";
                            paymentNote.style.display = "block";

                            // Dynamic messages based on payment options
                            if (paymentOption === "6 Months") {
                                paymentNote.textContent = "* The customer must pay a 20% down payment. The remaining balance will be divided into 6 monthly payments.";
                            } else {
                                const years = parseInt(paymentOption.match(/\d+/)[0]);
                                const months = years * 12;
                                paymentNote.textContent = `* The customer must pay a 20% down payment. The remaining balance will be divided into ${months} monthly payments over ${years} years.`;
                            }
                        }
                    } else {
                        priceField.value = "No price available";
                        monthlyPaymentGroup.style.display = "none";
                        paymentNote.style.display = "none";
                    }
                })
                .catch(error => {
                    console.error("Error fetching pricing:", error);
                    priceField.value = "Error fetching price";
                    monthlyPaymentGroup.style.display = "none";
                    paymentNote.style.display = "none";
                });
        }

        // Event listeners
        lotSelect.addEventListener("change", fetchPricing);
        lotTypeSelect.addEventListener("change", fetchPricing);
        paymentOptionSelect.addEventListener("change", fetchPricing);
    });
</script>