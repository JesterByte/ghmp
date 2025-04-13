<?php 
    use App\Utils\Formatter;
?>
<div class="container">
    <!-- Overview Cards Section -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Available Assets</span>
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title"> <a href="<?= BASE_URL ?>/map" class="text-light"><?= $totalAvailableAssets ?></a></h5>
                    <p class="card-text small">Lots: <?= $availableLots ?> | Estates: <?= $availableEstates ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Monthly Revenue</span>
                    ₱
                </div>
                <div class="card-body">
                    <h5 class="card-title"> <a href="<?= BASE_URL ?>/collection-report" class="text-light"><?= $currentMonthRevenue ?></a></h5>
                    <p class="card-text small">
                        <?php if ($monthlyRevenueTrend === 'up'): ?>
                            <i class="bi bi-arrow-up-circle text-success"></i>
                        <?php elseif ($monthlyRevenueTrend === 'down'): ?>
                            <i class="bi bi-arrow-down-circle text-danger"></i>
                        <?php else: ?>
                            <i class="bi bi-dash-circle text-white"></i>
                        <?php endif; ?>
                        <?= $revenueChange ?>% vs last month
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pending Services</span>
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $totalPendingServices ?></h5>
                    <p class="card-text small"><a class="text-dark" href="<?= BASE_URL ?>/burial-reservations">Burials</a>: <?= $pendingBurialsCard ?> | <a class="text-dark" href="<?= BASE_URL ?>/inquiries">Inquiries</a>: <?= $pendingInquiriesCard ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Total Interments</span>
                    <i class="bi bi-flower1"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title"> <a href="<?= BASE_URL ?>/deceased" class="text-dark"><?= $totalInterments ?></a></h5>
                    <p class="card-text small">This month: <?= $currentMonthInterments ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Upcoming Burial Services</span>
                    <a href="<?= BASE_URL ?>/burial-reservations" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach($latestBurials as $burial): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 d-flex align-items-center gap-2">
                                    <?= htmlspecialchars($burial['full_name']) ?>
                                    <?php if($burial['status'] === 'Pending'): ?>
                                        <span class="badge text-bg-warning">Pending</span>
                                    <?php elseif($burial['status'] === 'Approved' && $burial['payment_status'] === 'Pending'): ?>
                                        <span class="badge text-bg-primary">For Payment</span>
                                    <?php elseif($burial['status'] === 'Approved' && $burial['payment_status'] === 'Paid'): ?>
                                        <span class="badge text-bg-success">Ready</span>
                                    <?php endif; ?>
                                </h6>
                                <small class="text-muted"><?= Formatter::formatRelativeDate($burial['burial_date']) ?></small>
                            </div>
                            <p class="mb-1">Asset: <?= htmlspecialchars($burial['plot_id']) ?> | Time: <?= $burial['burial_time'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Recent Inquiries</span>
                    <a href="<?= BASE_URL ?>/inquiries" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach($latestInquiries as $inquiry): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <small class="text-muted">From: <?= htmlspecialchars($inquiry['email']) ?></small>
                                <small class="text-muted"><?= Formatter::formatRelativeDate($inquiry['created_at']) ?></small>
                            </div>
                            <p class="mb-1"><?= htmlspecialchars(strlen($inquiry['message']) > 100 ? substr($inquiry['message'], 0, 100) . '...' : $inquiry['message']) ?></p>
                        </div>
                    <?php endforeach; ?>
                    <?php if(empty($latestInquiries)): ?>
                        <div class="list-group-item">
                            <p class="mb-1 text-center text-muted">No recent inquiries</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">Monthly Overview</div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">Asset Status</div>
                <div class="card-body">
                    <canvas id="plotStatusChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="revenue-display">
    <?= $currentMonthRevenue ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Overview Chart
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode($chartLabels) ?>,
            datasets: [{
                label: 'Revenue (₱)',
                data: <?= json_encode($chartRevenue) ?>,
                borderColor: '#198754',
                tension: 0.1
            }, {
                label: 'Services',
                data: <?= json_encode($chartServices) ?>, // Changed from monthlyServices
                borderColor: '#0dcaf0',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Revenue & Services Trend'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Plot Status Chart
    new Chart(document.getElementById('plotStatusChart'), {
        type: 'doughnut',
        data: {
            labels: [
                'Available (' + <?= $plotStats['available'] ?> + ')', 
                'Reserved (' + <?= $plotStats['reserved'] ?> + ')', 
                'Sold (' + <?= $plotStats['sold'] ?> + ')',
                'Sold & Occupied (' + <?= $plotStats['occupied'] ?> + ')'
            ],
            datasets: [{
                data: [
                    <?= $plotStats['available'] ?>, 
                    <?= $plotStats['reserved'] ?>, 
                    <?= $plotStats['sold'] ?>,
                    <?= $plotStats['occupied'] ?>
                ],
                backgroundColor: [
                    '#198754',  // green for available
                    '#ffc107',  // yellow for reserved
                    '#dc3545',  // red for sold
                    '#6c757d'   // gray for sold & occupied
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        // Increase padding between legend items
                        padding: 20,
                        // Optional: Use a smaller font size if needed
                        font: {
                            size: 11
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Total Assets: <?= $plotStats['total'] ?>'
                }
            }
        }
    });
});
</script>
