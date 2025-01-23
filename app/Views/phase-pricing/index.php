<?php 
    use App\Helpers\TableHelper;
    use App\Utils\Formatter;
    
    $firstRow = reset($phasePricingTable);
?>
<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="row">
    <div class="col d-flex justify-content-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pricing-update-phase-modal">Update Pricing</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rates-update-phase-modal">Update Rates</button>
        </div>
    </div>
</div>

<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th rowspan="4">Phase</th>
                <th rowspan="4">Lot Type</th>
                <th rowspan="4">Number of Lot(s)</th>
                <th rowspan="4">Lot Price</th>
                <th rowspan="4">Total Purchase Price (VAT & MCF Included)</th>
                <th rowspan="1">Option 1</th>
                <th rowspan="1">Option 2</th>
                <th rowspan="1" colspan="7">Option 3 (Installment)</th>
            </tr>
            <tr>
                <th rowspan="1">Cash Sale</th>
                <th rowspan="1">6 Months</th>
                <th rowspan="3"><?= Formatter::formatPercentage($firstRow["down_payment_rate"], 0) ?> Down Payment</th>
                <th rowspan="3">Balance</th>
                <th>1 Year</th>
                <th>2 Years</th>
                <th>3 Years</th>
                <th>4 Years</th>
                <th>5 Years</th>
            </tr>
            <tr>
                <th rowspan="2"><?= Formatter::formatPercentage($firstRow["cash_sale_discount"], 0) ?> Discount</th>
                <th rowspan="2"><?= Formatter::formatPercentage($firstRow["six_months_discount"], 0) ?> Discount</th>
                <th rowspan="1"><?= Formatter::formatPercentage($firstRow["one_year_interest_rate"], 0) ?> Interest</th>
                <th rowspan="1"><?= Formatter::formatPercentage($firstRow["two_years_interest_rate"], 0) ?> Interest</th>
                <th rowspan="1"><?= Formatter::formatPercentage($firstRow["three_years_interest_rate"], 0) ?> Interest</th>
                <th rowspan="1"><?= Formatter::formatPercentage($firstRow["four_years_interest_rate"], 0) ?> Interest</th>
                <th rowspan="1"><?= Formatter::formatPercentage($firstRow["five_years_interest_rate"], 0) ?> Interest</th>
            </tr>
            <tr>
                <th colspan="5">Monthly Amortization</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($phasePricingTable as $phasePricingRow) {
                    $phasePricingRow["lot_price"] = Formatter::formatCurrency($phasePricingRow["lot_price"]);
                    $phasePricingRow["total_purchase_price"] = Formatter::formatCurrency($phasePricingRow["total_purchase_price"]);
                    $phasePricingRow["cash_sale"] = Formatter::formatCurrency($phasePricingRow["cash_sale"]);
                    $phasePricingRow["six_months"] = Formatter::formatCurrency($phasePricingRow["six_months"]);
                    $phasePricingRow["down_payment"] = Formatter::formatCurrency($phasePricingRow["down_payment"]);
                    $phasePricingRow["balance"] = Formatter::formatCurrency($phasePricingRow["balance"]);
                    $phasePricingRow["monthly_amortization_one_year"] = Formatter::formatCurrency($phasePricingRow["monthly_amortization_one_year"]);
                    $phasePricingRow["monthly_amortization_two_years"] = Formatter::formatCurrency($phasePricingRow["monthly_amortization_two_years"]);
                    $phasePricingRow["monthly_amortization_three_years"] = Formatter::formatCurrency($phasePricingRow["monthly_amortization_three_years"]);
                    $phasePricingRow["monthly_amortization_four_years"] = Formatter::formatCurrency($phasePricingRow["monthly_amortization_four_years"]);
                    $phasePricingRow["monthly_amortization_five_years"] = Formatter::formatCurrency($phasePricingRow["monthly_amortization_five_years"]);

                    TableHelper::startRow();
                    TableHelper::cell($phasePricingRow["phase"]);
                    TableHelper::cell($phasePricingRow["lot_type"]);
                    TableHelper::cell($phasePricingRow["number_of_lots"]);
                    TableHelper::cell($phasePricingRow["lot_price"]);
                    TableHelper::cell($phasePricingRow["total_purchase_price"]);
                    TableHelper::cell($phasePricingRow["cash_sale"]);
                    TableHelper::cell($phasePricingRow["six_months"]);
                    TableHelper::cell($phasePricingRow["down_payment"]);
                    TableHelper::cell($phasePricingRow["balance"]);
                    TableHelper::cell($phasePricingRow["monthly_amortization_one_year"]);
                    TableHelper::cell($phasePricingRow["monthly_amortization_two_years"]);
                    TableHelper::cell($phasePricingRow["monthly_amortization_three_years"]);
                    TableHelper::cell($phasePricingRow["monthly_amortization_four_years"]);
                    TableHelper::cell($phasePricingRow["monthly_amortization_five_years"]);
                    TableHelper::endRow();
                }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-update-phase-pricing.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-update-phase-rates.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table");
</script>