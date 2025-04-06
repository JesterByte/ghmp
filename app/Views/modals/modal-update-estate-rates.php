<?php

use App\Utils\Formatter;
?>
<!-- Update Estate Price Modal -->
<div class="modal fade" id="rates-update-estate-modal" tabindex="-1" aria-labelledby="rates-update-estate-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header text-bg-primary">
            <h1 class="modal-title fs-5" id="rates-update-estate-modal-label">Update Estate Rates</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="estate-rates" method="post" class="needs-validation" novalidate>
                <label for="vat" class="form-label">VAT</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="vat" name="vat" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["vat"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>   
                <label for="mcf" class="form-label">Memorial Care Fee</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input required type="number" step="0.01" class="form-control" id="mcf" name="mcf" aria-label="Amount (to the nearest peso)" value="<?= $firstRow["memorial_care_fee"] ?>" placeholder="0.00">
                </div>
                <label for="cash-sale-discount" class="form-label">Cash Sale Discount</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="cash-sale-discount" name="cash-sale-discount" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["cash_sale_discount"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>         
                <label for="six-months-discount" class="form-label">6 Months Discount</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="six-months-discount" name="six-months-discount" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["six_months_discount"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>       
                <label for="down-payment-rate" class="form-label">Down Payment Rate</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="down-payment-rate" name="down-payment-rate" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["down_payment_rate"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>  
                <label for="one-year-interest-rate" class="form-label">1 Year Interest Rate</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="one-year-interest-rate" name="one-year-interest-rate" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["one_year_interest_rate"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>  
                <label for="two-years-interest-rate" class="form-label">2 Years Interest Rate</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="two-years-interest-rate" name="two-years-interest-rate" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["two_years_interest_rate"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>  
                <label for="three-years-interest-rate" class="form-label">3 Years Interest Rate</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="three-years-interest-rate" name="three-years-interest-rate" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["three_years_interest_rate"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div>  
                <label for="four-years-interest-rate" class="form-label">4 Years Interest Rate</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="four-years-interest-rate" name="four-years-interest-rate" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["four_years_interest_rate"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div> 
                <label for="five-years-interest-rate" class="form-label">5 Years Interest Rate</label>
                <div class="input-group mb-3">
                    <input required type="number" step="0.01" class="form-control" id="five-years-interest-rate" name="five-years-interest-rate" aria-label="Amount (to the nearest peso)" value="<?= Formatter::formatPercentageWithoutSymbol($firstRow["five_years_interest_rate"]) ?>" placeholder="0.00">
                    <span class="input-group-text">%</span>
                </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update-rates-submit">Update</button>
            </form>
        </div>
        </div>
    </div>
</div>