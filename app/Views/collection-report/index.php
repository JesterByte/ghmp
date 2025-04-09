<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>
<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Collection Report</h5>
                <div>
                    <button type="button" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Export to Excel
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Date Range Filter -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startDate">
                </div>
                <div class="col-md-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate">
                </div>
            </div>

            <!-- Collections Table -->
            <table id="collectionsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th>Sale Type</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables will populate this -->
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Total:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/moment.js" ?>"></script>
<script src="<?= BASE_URL . "/js/dataTables.min.js" ?>"></script>
<script src="<?= BASE_URL . "/js/dataTables.bootstrap5.min.js" ?>"></script>
<script src="<?= BASE_URL . "/js/dataTables.buttons.js" ?>"></script>
<script src="<?= BASE_URL . "/js/buttons.bootstrap5.js" ?>"></script>
<script src="<?= BASE_URL . "/js/jszip.min.js" ?>"></script>
<script src="<?= BASE_URL . "/js/pdfmake.min.js" ?>"></script>
<script src="<?= BASE_URL . "/js/vfs_fonts.js" ?>"></script>
<script src="<?= BASE_URL . "/js/buttons.html5.min.js" ?>"></script>
<script src="<?= BASE_URL . "/js/buttons.print.min.js" ?>"></script>
<script src="<?= BASE_URL . "/js/buttons.colVis.min.js" ?>"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = new DataTable('#collectionsTable', {
        processing: true,
        serverSide: false,
        ajax: {
            url: '<?= BASE_URL ?>/collection-report/get-collections',
            type: 'GET',
            data: function(d) {
                return {
                    ...d,
                    start_date: $('#startDate').val(),
                    end_date: $('#endDate').val()
                };
            }
        },
        columns: [
            { data: 'id', visible: false },
            { 
                data: 'payment_date',
                render: function(data) {
                    return moment(data).format('MMM D, YYYY');
                }
            },
            { 
                data: 'payment_amount',
                render: function(data) {
                    return '₱' + parseFloat(data || 0).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
            },
            { data: 'payment_type' },
            { data: 'sale_type' }
        ],
        dom: 'frtip', // Removed 'B' from dom
        order: [[1, 'desc']],
        footerCallback: function(row, data, start, end, display) {
            const api = this.api();
            const total = api
                .column(2, { search: 'applied' })
                .data()
                .reduce((a, b) => parseFloat(a || 0) + parseFloat(b || 0), 0);
            
            $(api.column(2).footer()).html('₱' + total.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
        },
        buttons: [
            {
                extend: 'excelHtml5',
                title: '<?= $fileName ?>',
                exportOptions: {
                    columns: ':visible:not(:first-child)'
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row c[r^="C"]', sheet).each(function() {
                        // Format amount column as currency
                        if($(this).text().startsWith('₱')) {
                            $(this).attr('t', 'n');
                            $(this).text($(this).text().replace('₱', ''));
                        }
                    });
                }
            },
            {
                extend: 'pdfHtml5',
                title: '<?= $fileName ?>',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: ':visible:not(:first-child)'
                },
                customize: function(doc) {
                    // Format PDF
                    doc.defaultStyle.fontSize = 10;
                    doc.styles.tableHeader.fontSize = 11;
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');
                }
            }
        ]
    });

    // Register buttons instance
    table.buttons().container()
        .appendTo('#collectionsTable_wrapper .col-md-6:eq(0)');

    // Date range change handler
    $('#startDate, #endDate').on('change', function() {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();
        
        // Validate dates
        if (startDate && endDate && startDate > endDate) {
            alert('Start date cannot be later than end date');
            return;
        }
        
        table.ajax.reload();
    });

    // Filter button handler
    $('.btn-primary').on('click', filterData);
    $('#startDate, #endDate').on('change', filterData);

    function filterData() {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();
        
        // Validate dates
        if (startDate && endDate && startDate > endDate) {
            alert('Start date cannot be later than end date');
            return;
        }
        
        table.ajax.reload();
    }

    // Export button handlers
    $('.btn-success').on('click', function() {
        table.buttons('.buttons-excel').trigger();
    });

    $('.btn-danger').on('click', function() {
        table.buttons('.buttons-pdf').trigger();
    });
});
</script>