<?php 
    use App\Helpers\TableHelper;
    use App\Utils\Formatter;
    use App\Helpers\DateHelper;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
    
    $firstRow = reset($phasePricingTable);
?>
<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="row">
    <div class="col d-flex justify-content-end my-3">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#pricing-update-phase-modal"><i class="bi bi-tag-fill"></i> Update Pricing</button>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#rates-update-phase-modal"><i class="bi bi-percent"></i> Update Rates</button>
        </div>
    </div>
</div>

<div class="table-responsive shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th class="text-center" rowspan="4">Phase</th>
                <th class="text-center" rowspan="4">Lot Type</th>
                <th class="text-center" rowspan="4">Number of Lot(s)</th>
                <th class="text-center" rowspan="4">Lot Price</th>
                <th class="text-center" rowspan="4">Total Purchase Price (VAT & MCF Included)</th>
                <th class="text-center" rowspan="1">Option 1</th>
                <th class="text-center" rowspan="1">Option 2</th>
                <th class="text-center" rowspan="1" colspan="7">Option 3 (Installment)</th>
            </tr>
            <tr>
                <th class="text-center" rowspan="1">Cash Sale</th>
                <th class="text-center" rowspan="1">6 Months</th>
                <th class="text-center" rowspan="3"><?= Formatter::formatPercentage($firstRow["down_payment_rate"], 0) ?> Down Payment</th>
                <th class="text-center" rowspan="3">Balance</th>
                <th class="text-center">1 Year</th>
                <th class="text-center">2 Years</th>
                <th class="text-center">3 Years</th>
                <th class="text-center">4 Years</th>
                <th class="text-center">5 Years</th>
            </tr>
            <tr>
                <th class="text-center" rowspan="2"><?= Formatter::formatPercentage($firstRow["cash_sale_discount"], 0) ?> Discount</th>
                <th class="text-center" rowspan="2"><?= Formatter::formatPercentage($firstRow["six_months_discount"], 0) ?> Discount</th>
                <th class="text-center" rowspan="1"><?= Formatter::formatPercentage($firstRow["one_year_interest_rate"], 0) ?> Interest</th>
                <th class="text-center" rowspan="1"><?= Formatter::formatPercentage($firstRow["two_years_interest_rate"], 0) ?> Interest</th>
                <th class="text-center" rowspan="1"><?= Formatter::formatPercentage($firstRow["three_years_interest_rate"], 0) ?> Interest</th>
                <th class="text-center" rowspan="1"><?= Formatter::formatPercentage($firstRow["four_years_interest_rate"], 0) ?> Interest</th>
                <th class="text-center" rowspan="1"><?= Formatter::formatPercentage($firstRow["five_years_interest_rate"], 0) ?> Interest</th>
            </tr>
            <tr>
                <th class="text-center" colspan="5">Monthly Amortization</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($phasePricingTable as $row) {
                    $row["lot_price"] = Formatter::formatCurrency($row["lot_price"]);
                    $row["total_purchase_price"] = Formatter::formatCurrency($row["total_purchase_price"]);
                    $row["cash_sale"] = Formatter::formatCurrency($row["cash_sale"]);
                    $row["six_months"] = Formatter::formatCurrency($row["six_months"]);
                    $row["down_payment"] = Formatter::formatCurrency($row["down_payment"]);
                    $row["balance"] = Formatter::formatCurrency($row["balance"]);
                    $row["monthly_amortization_one_year"] = Formatter::formatCurrency($row["monthly_amortization_one_year"]);
                    $row["monthly_amortization_two_years"] = Formatter::formatCurrency($row["monthly_amortization_two_years"]);
                    $row["monthly_amortization_three_years"] = Formatter::formatCurrency($row["monthly_amortization_three_years"]);
                    $row["monthly_amortization_four_years"] = Formatter::formatCurrency($row["monthly_amortization_four_years"]);
                    $row["monthly_amortization_five_years"] = Formatter::formatCurrency($row["monthly_amortization_five_years"]);

                    TableHelper::startRow();
                    TableHelper::cell($row["phase"]);
                    TableHelper::cell($row["lot_type"]);
                    TableHelper::cell($row["number_of_lots"]);
                    TableHelper::cell($row["lot_price"]);
                    TableHelper::cell($row["total_purchase_price"]);
                    TableHelper::cell($row["cash_sale"]);
                    TableHelper::cell($row["six_months"]);
                    TableHelper::cell($row["down_payment"]);
                    TableHelper::cell($row["balance"]);
                    TableHelper::cell($row["monthly_amortization_one_year"]);
                    TableHelper::cell($row["monthly_amortization_two_years"]);
                    TableHelper::cell($row["monthly_amortization_three_years"]);
                    TableHelper::cell($row["monthly_amortization_four_years"]);
                    TableHelper::cell($row["monthly_amortization_five_years"]);
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
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("pricing-update-phase-modal", "phase");
    autofocusModal("rates-update-phase-modal", "vat");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>", true);
</script>