<!-- Add Estate Reservation Modal -->
<div class="modal fade" id="add-estate-reservation-modal" tabindex="-1" aria-labelledby="add-estate-reservation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="add-estate-reservation-modal-label">Add New Estate Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add-reservation-estate" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="estate" name="estate" required>
                            <option selected disabled></option>
                            <?php
                            if (!empty($formattedAvailableEstates)) {
                                for ($i = 0; $i < count($formattedAvailableEstates["available_estate"]); $i++) {
                                    echo "<option value='{$formattedAvailableEstates["estate_id"][$i]}'>{$formattedAvailableEstates["available_estate"][$i]}</option>";
                                }
                            } else {
                                echo "<option value='' disabled selected>No available estates</option>";
                            }
                            ?>
                        </select>
                        <label for="estate">Available Estate</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="customer" name="customer" required>
                            <option selected disabled></option>
                            <?php
                            if (!empty($formattedCustomers)) {
                                for ($i = 0; $i < count($formattedCustomers["customer_id"]); $i++) {
                                    echo "<option value='{$formattedCustomers["customer_id"][$i]}'>{$formattedCustomers["customer"][$i]}</option>";
                                }
                            } else {
                                echo "<option value='' disabled selected>No customers available</option>";
                            }
                            ?>
                        </select>
                        <label for="customer">Customers</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="payment-option" name="payment-option" required>
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

                    <!-- Payable Amount -->
                    <label for="price" class="form-label" id="payable-amount-label">Payable Amount</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="text" class="form-control" id="price" name="price" readonly>
                    </div>

                    <!-- Monthly Payment (Hidden by Default) -->
                    <div id="monthly-payment-group" class="mb-3" style="display: none;">
                        <label for="monthly-payment" class="form-label">Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" id="monthly-payment" name="monthly-payment" readonly>
                        </div>
                    </div>

                    <div id="total-payable-amount-group" class="mb-3" style="display: none;">
                        <label for="monthly-payment" class="form-label">Payable Amount (Monthly Total)</label>
                        <div class="input-group">
                            <span class="input-group-text">₱</span>
                            <input type="text" class="form-control" id="total-payable-amount" name="total-payable-amount" readonly>
                        </div>
                    </div>

                    <!-- Receipt Upload Field (Image Only) -->
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="receipt" name="receipt" accept=".jpg,.jpeg,.png" required>
                        <label for="receipt">Upload Receipt (Image Only)</label>
                    </div>

                    <p id="payment-note" class="text-muted small" style="display: none;"></p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="add-estate-reservation-submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const estateSelect = document.getElementById("estate");
        const paymentOptionSelect = document.getElementById("payment-option");
        const priceField = document.getElementById("price");
        const payableAmountLabel = document.getElementById("payable-amount-label");

        const monthlyPaymentGroup = document.getElementById("monthly-payment-group");
        const monthlyPaymentInput = document.getElementById("monthly-payment");

        const paymentNote = document.getElementById("payment-note");
        const receiptInput = document.getElementById("receipt");

        const totalPayableAmountGroup = document.getElementById("total-payable-amount-group");
        const totalPayableAmountField = document.getElementById("total-payable-amount");

        function fetchPricing() {
            const estateId = estateSelect.value;
            const estateTypeMatch = estateId.match(/^E-([A-C])/);
            const estateType = estateTypeMatch[1];
            const paymentOption = paymentOptionSelect.value;

            if (!estateId || !paymentOption) {
                priceField.value = "Please select all fields";
                monthlyPaymentGroup.style.display = "none";
                paymentNote.style.display = "none";
                totalPayableAmountGroup.style.display = "none";
                totalPayableAmountField.value = "";
                return;
            }

            fetch("<?= BASE_URL ?>/estate-reservations/fetch-estate-pricing", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        estateType,
                        paymentOption
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const price = parseFloat(data.price);
                        const monthlyPayment = parseFloat(data.monthly_payment);
                        priceField.value = price.toFixed(2);

                        if (paymentOption === "Cash Sale") {
                            monthlyPaymentGroup.style.display = "none";
                            payableAmountLabel.textContent = "Payable Amount";
                            paymentNote.style.display = "block";
                            paymentNote.textContent = "* The customer must pay the full amount before uploading the receipt.";

                            totalPayableAmountField.value = price.toFixed(2); // Full payment for Cash Sale
                        } else {
                            const downPayment = (price * 0.2).toFixed(2);
                            const months = paymentOption.includes("6 Months") ? 6 : parseInt(paymentOption.match(/\d+/)[0]) * 12;

                            monthlyPaymentInput.value = monthlyPayment;
                            monthlyPaymentGroup.style.display = "block";


                            payableAmountLabel.textContent = "Down Payment";
                            paymentNote.style.display = "block";

                            if (paymentOption === "6 Months") {
                                paymentNote.textContent = "* The customer must pay a 20% down payment. The remaining balance will be divided into 6 monthly payments.";
                            } else {
                                paymentNote.textContent = `* The customer must pay a 20% down payment. The remaining balance will be divided into ${months} monthly payments over ${months / 12} years.`;
                            }

                            // Calculate total payable amount (monthly payments only)
                            const totalPayableAmount = (monthlyPayment * months).toFixed(2);
                            totalPayableAmountField.value = totalPayableAmount;
                            totalPayableAmountGroup.style.display = "block";

                        }
                    } else {
                        priceField.value = "No price available";
                        monthlyPaymentGroup.style.display = "none";
                        paymentNote.style.display = "none";
                        totalPayableAmountField.value = "";
                    }
                })
                .catch(error => {
                    console.error("Error fetching pricing:", error);
                    priceField.value = "Error fetching price";
                    monthlyPaymentGroup.style.display = "none";
                    paymentNote.style.display = "none";
                    totalPayableAmountField.value = "";
                });
        }

        estateSelect.addEventListener("change", fetchPricing);
        paymentOptionSelect.addEventListener("change", fetchPricing);
    });
</script>