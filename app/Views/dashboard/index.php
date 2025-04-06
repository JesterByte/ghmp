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
                    <h5 class="card-title"><?= $totalAvailableAssets ?></h5>
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
                    <h5 class="card-title"><?= $monthlyRevenue ?></h5>
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
                    <p class="card-text small"><a class="text-decoration-none text-dark" href="<?= BASE_URL ?>/burial-reservations">Burials</a>: <?= $pendingBurials ?> | <a class="text-decoration-none text-dark" href="<?= BASE_URL ?>/inquiries">Inquiries</a>: <?= $pendingInquiries ?></p>
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
                    <h5 class="card-title"><?= $totalInterments ?></h5>
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
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">From: john@email.com</small>
                            <small class="text-muted">30 minutes ago</small>
                        </div>
                        <p class="mb-1">Inquiry about family estate plots in Section A...</p>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">From: mary@email.com</small>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                        <p class="mb-1">Request for information about burial services and pricing...</p>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">From: peter@email.com</small>
                            <small class="text-muted">Yesterday</small>
                        </div>
                        <p class="mb-1">Questions about memorial service arrangements...</p>
                    </div>
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
                <div class="card-header">Plot Status</div>
                <div class="card-body">
                    <canvas id="plotChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Overview Chart
    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue (₱)',
                data: [150000, 180000, 220000, 250000, 200000, 230000],
                borderColor: '#198754',
                tension: 0.1
            }, {
                label: 'Services',
                data: [10, 12, 15, 14, 16, 15],
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
            }
        }
    });

    // Plot Status Chart
    new Chart(document.getElementById('plotChart'), {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Reserved', 'Occupied'],
            datasets: [{
                data: [150, 30, 820],
                backgroundColor: ['#198754', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
