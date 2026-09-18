<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header" style="padding: 25px 25px 15px 25px;">
    <h1 style="font-weight: 200; letter-spacing: -0.5px; color: #ffffff;">
      Dashboard Overview
      <small style="color: #64748b; font-weight: 300;">Control Panel & Inventory System</small>
    </h1>
    <ol class="breadcrumb" style="background: transparent; top: 25px;">
      <li><a href="<?php echo base_url('dashboard'); ?>" style="color: #64748b;"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active" style="color: #38bdf8;">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="padding: 0 25px 25px 25px;">

    <!-- 21st.dev Quick Action Bar -->
    <div class="row" style="margin-bottom: 25px;">
      <div class="col-md-12">
        <div class="metric-card" style="padding: 16px 24px; display: flex; align-items: center; flex-wrap: wrap; gap: 12px; background: rgba(15, 15, 15, 0.9);">
          <span style="font-size: 13px; font-weight: 300; text-transform: uppercase; letter-spacing: 1.5px; color: #94a3b8; margin-right: 10px; display: flex; align-items: center; gap: 6px;">
            <iconify-icon icon="solar:cpu-bolt-linear" width="18" height="18" class="text-amber-400"></iconify-icon>
            Quick Actions:
          </span>
          <a href="<?php echo base_url('orders/create'); ?>" class="btn btn-primary btn-flat" style="display: inline-flex; align-items: center; gap: 6px;"><i class="fa fa-plus-circle"></i> Create Order</a>
          <a href="<?php echo base_url('products/create'); ?>" class="btn btn-success btn-flat" style="display: inline-flex; align-items: center; gap: 6px;"><i class="fa fa-cube"></i> Add Product</a>
          <a href="<?php echo base_url('products'); ?>" class="btn btn-info btn-flat" style="display: inline-flex; align-items: center; gap: 6px;"><i class="fa fa-list"></i> View Products</a>
          <a href="<?php echo base_url('forecast'); ?>" class="btn btn-warning btn-flat" style="display: inline-flex; align-items: center; gap: 6px;"><i class="fa fa-magic"></i> AI Forecast</a>
        </div>
      </div>
    </div>

    <!-- 21st.dev Metric Stat Cards -->
    <div class="row" style="margin-bottom: 25px;">
      <div class="col-lg-3 col-xs-6">
        <div class="metric-card">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
              <div class="metric-value"><?php echo $total_products; ?></div>
              <div class="metric-label">Total Products</div>
            </div>
            <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.2); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:box-linear" width="22" height="22" class="text-sky-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('products/'); ?>" style="display: block; margin-top: 16px; font-size: 12px; color: #38bdf8; text-decoration: none;">Manage Catalog &rarr;</a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="metric-card">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
              <div class="metric-value"><?php echo $total_paid_orders; ?></div>
              <div class="metric-label">Paid Orders</div>
            </div>
            <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(52, 211, 153, 0.1); border: 1px solid rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:bag-check-linear" width="22" height="22" class="text-emerald-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('orders/'); ?>" style="display: block; margin-top: 16px; font-size: 12px; color: #34d399; text-decoration: none;">View Order Ledger &rarr;</a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="metric-card" style="<?php echo ($total_low_stock > 0) ? 'border-color: rgba(248, 113, 113, 0.4);' : ''; ?>">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
              <div class="metric-value" style="<?php echo ($total_low_stock > 0) ? 'color: #f87171;' : ''; ?>"><?php echo $total_low_stock; ?></div>
              <div class="metric-label">Low Stock Alerts</div>
            </div>
            <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(251, 191, 36, 0.1); border: 1px solid rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:danger-triangle-linear" width="22" height="22" class="text-amber-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('products/'); ?>" style="display: block; margin-top: 16px; font-size: 12px; color: #fbbf24; text-decoration: none;">Check Stock Health &rarr;</a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="metric-card">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
              <div class="metric-value"><?php echo $currency . ' ' . number_format($total_revenue, 2); ?></div>
              <div class="metric-label">Total Revenue</div>
            </div>
            <div style="width: 42px; height: 42px; border-radius: 12px; background: rgba(192, 132, 252, 0.1); border: 1px solid rgba(192, 132, 252, 0.2); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:wallet-money-linear" width="22" height="22" class="text-purple-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('reports/'); ?>" style="display: block; margin-top: 16px; font-size: 12px; color: #c084fc; text-decoration: none;">Financial Analytics &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Sales & Inventory Overview Charts -->
    <div class="row">
      <div class="col-md-8">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-line-chart" style="color: #38bdf8;"></i> Revenue Flow Velocity (<?php echo $selected_year; ?>)</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="monthlySalesChart" style="height: 270px;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><i class="fa fa-pie-chart" style="color: #fbbf24;"></i> System Matrix Summary</h3>
          </div>
          <div class="box-body">
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.04);">
                <span>Total Catalog Items</span>
                <code><?php echo $total_products; ?></code>
              </li>
              <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.04);">
                <span>Low Stock Threshold (&le; 5)</span>
                <span class="badge bg-yellow"><?php echo $total_low_stock; ?></span>
              </li>
              <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.04);">
                <span>Out of Stock Items</span>
                <span class="badge bg-red"><?php echo $total_out_of_stock; ?></span>
              </li>
              <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.04);">
                <span>Active Store Outlets</span>
                <code><?php echo $total_stores; ?></code>
              </li>
              <li style="display: flex; justify-content: space-between; padding: 12px 0;">
                <span>Registered Operatives</span>
                <code><?php echo $total_users; ?></code>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Tables Row: Low Stock Alerts & Recent Orders -->
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="box-title"><i class="fa fa-bell-o" style="color: #f87171;"></i> Critical Stock Alerts</h3>
            <a href="<?php echo base_url('products'); ?>" class="btn btn-xs btn-primary">View All</a>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>SKU</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($low_stock_items)): ?>
                  <?php foreach($low_stock_items as $item): ?>
                    <tr>
                      <td><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                      <td><code><?php echo htmlspecialchars($item['sku']); ?></code></td>
                      <td>
                        <span class="badge <?php echo ($item['qty'] <= 0) ? 'bg-red' : 'bg-yellow'; ?>">
                          <?php echo $item['qty']; ?>
                        </span>
                      </td>
                      <td><?php echo $currency . ' ' . number_format((float)$item['price'], 2); ?></td>
                      <td>
                        <?php if($item['qty'] <= 0): ?>
                          <span class="label label-danger">Out of Stock</span>
                        <?php else: ?>
                          <span class="label label-warning">Low Stock</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-muted" style="padding: 20px;">All catalog inventory healthy!</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box">
          <div class="box-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="box-title"><i class="fa fa-shopping-bag" style="color: #34d399;"></i> Recent Orders</h3>
            <a href="<?php echo base_url('orders'); ?>" class="btn btn-xs btn-primary">View All</a>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Bill No</th>
                  <th>Customer Name</th>
                  <th>Date</th>
                  <th>Net Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($recent_orders)): ?>
                  <?php foreach($recent_orders as $order): ?>
                    <tr>
                      <td><a href="<?php echo base_url('orders/printDiv/'.$order['id']); ?>" target="_blank"><code><?php echo htmlspecialchars($order['bill_no']); ?></code></a></td>
                      <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                      <td><?php echo date('Y-m-d', (int)$order['date_time']); ?></td>
                      <td><strong><?php echo $currency . ' ' . number_format((float)$order['net_amount'], 2); ?></strong></td>
                      <td>
                        <?php if($order['paid_status'] == 1): ?>
                          <span class="label label-success">Paid</span>
                        <?php else: ?>
                          <span class="label label-warning">Unpaid</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-muted" style="padding: 20px;">No recent transactions.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#dashboardMainMenu").addClass('active');

    // 21st.dev Chart.js Monthly Sales Styling
    var monthlySalesData = <?php echo $monthly_sales; ?>;
    var canvas = document.getElementById('monthlySalesChart');
    if (canvas) {
      var ctx = canvas.getContext('2d');
      
      var gradient = ctx.createLinearGradient(0, 0, 0, 260);
      gradient.addColorStop(0, 'rgba(56, 189, 248, 0.4)');
      gradient.addColorStop(1, 'rgba(56, 189, 248, 0.0)');

      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Sales Revenue (<?php echo $currency; ?>)',
            data: monthlySalesData,
            backgroundColor: gradient,
            borderColor: '#38bdf8',
            borderWidth: 2,
            pointBackgroundColor: '#ffffff',
            pointBorderColor: '#38bdf8',
            pointRadius: 4,
            lineTension: 0.35
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              gridLines: {
                color: 'rgba(255, 255, 255, 0.05)',
                zeroLineColor: 'rgba(255, 255, 255, 0.08)'
              },
              ticks: {
                fontColor: '#94a3b8'
              }
            }],
            yAxes: [{
              gridLines: {
                color: 'rgba(255, 255, 255, 0.05)',
                zeroLineColor: 'rgba(255, 255, 255, 0.08)'
              },
              ticks: {
                beginAtZero: true,
                fontColor: '#94a3b8'
              }
            }]
          }
        }
      });
    }
  }); 
</script>
