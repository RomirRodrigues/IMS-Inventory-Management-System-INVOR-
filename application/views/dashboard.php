<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-black text-slate-200">
  <!-- Content Header (Page header) -->
  <section class="content-header px-4 md:px-6 pt-4 md:pt-6 pb-2 border-b border-white/[0.08]">
    <h1 class="text-xl md:text-2xl font-thin tracking-widest text-white uppercase flex items-center gap-2">
      Dashboard Overview
    </h1>
    <ol class="breadcrumb bg-transparent px-0 py-1 text-xs text-slate-500">
      <li><a href="<?php echo base_url('dashboard'); ?>" class="text-slate-400 hover:text-white"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active text-sky-400">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content px-3 md:px-6 py-4 md:py-6">

    <!-- Quick Action Bar -->
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="metric-card p-3 md:p-4 flex flex-wrap items-center gap-2 bg-slate-950/90 border border-slate-800 rounded-xl">
          <span class="text-xs uppercase tracking-widest text-slate-400 font-light flex items-center gap-1.5 w-full md:w-auto mb-1 md:mb-0">
            <iconify-icon icon="solar:cpu-bolt-linear" width="18" height="18" class="text-amber-400"></iconify-icon>
            Quick Actions:
          </span>
          <a href="<?php echo base_url('orders/create'); ?>" class="btn btn-primary btn-sm flex-grow md:flex-grow-0 inline-flex items-center justify-center gap-1.5"><i class="fa fa-plus-circle"></i> Create Order</a>
          <a href="<?php echo base_url('products/create'); ?>" class="btn btn-success btn-sm flex-grow md:flex-grow-0 inline-flex items-center justify-center gap-1.5"><i class="fa fa-cube"></i> Add Product</a>
          <a href="<?php echo base_url('products'); ?>" class="btn btn-info btn-sm flex-grow md:flex-grow-0 inline-flex items-center justify-center gap-1.5"><i class="fa fa-list"></i> Products</a>
          <a href="<?php echo base_url('forecast'); ?>" class="btn btn-warning btn-sm flex-grow md:flex-grow-0 inline-flex items-center justify-center gap-1.5"><i class="fa fa-magic"></i> AI Forecast</a>
        </div>
      </div>
    </div>

    <!-- Metric Stat Cards (Fully Responsive 1-Col Mobile, 4-Col Desktop) -->
    <div class="row mb-4">
      <div class="col-xs-12 col-sm-6 col-lg-3 mb-3">
        <div class="metric-card p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="metric-value text-2xl md:text-3xl font-light text-white"><?php echo $total_products; ?></div>
              <div class="metric-label text-xs text-slate-400 uppercase tracking-wider mt-1">Total Products</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center">
              <iconify-icon icon="solar:box-linear" width="22" height="22" class="text-sky-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('products/'); ?>" class="block mt-3 text-xs text-sky-400 hover:text-white transition-colors">Manage Catalog &rarr;</a>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-lg-3 mb-3">
        <div class="metric-card p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="metric-value text-2xl md:text-3xl font-light text-white"><?php echo $total_paid_orders; ?></div>
              <div class="metric-label text-xs text-slate-400 uppercase tracking-wider mt-1">Paid Orders</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center">
              <iconify-icon icon="solar:bag-check-linear" width="22" height="22" class="text-emerald-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('orders/'); ?>" class="block mt-3 text-xs text-emerald-400 hover:text-white transition-colors">View Order Ledger &rarr;</a>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-lg-3 mb-3">
        <div class="metric-card p-4 <?php echo ($total_low_stock > 0) ? 'border-rose-500/40' : ''; ?>">
          <div class="flex justify-between items-start">
            <div>
              <div class="metric-value text-2xl md:text-3xl font-light <?php echo ($total_low_stock > 0) ? 'text-rose-400' : 'text-white'; ?>"><?php echo $total_low_stock; ?></div>
              <div class="metric-label text-xs text-slate-400 uppercase tracking-wider mt-1">Low Stock Alerts</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center">
              <iconify-icon icon="solar:danger-triangle-linear" width="22" height="22" class="text-amber-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('products/'); ?>" class="block mt-3 text-xs text-amber-400 hover:text-white transition-colors">Check Stock Health &rarr;</a>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-lg-3 mb-3">
        <div class="metric-card p-4">
          <div class="flex justify-between items-start">
            <div>
              <div class="metric-value text-xl md:text-2xl font-light text-white truncate max-w-[180px]"><?php echo $currency . ' ' . number_format($total_revenue, 2); ?></div>
              <div class="metric-label text-xs text-slate-400 uppercase tracking-wider mt-1">Total Revenue</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
              <iconify-icon icon="solar:wallet-money-linear" width="22" height="22" class="text-purple-400"></iconify-icon>
            </div>
          </div>
          <a href="<?php echo base_url('reports/'); ?>" class="block mt-3 text-xs text-purple-400 hover:text-white transition-colors">Financial Analytics &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Sales Chart & System Matrix Summary -->
    <div class="row mb-4">
      <div class="col-md-8 mb-4">
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl p-4">
          <div class="box-header pb-2 border-b border-slate-800">
            <h3 class="box-title text-sm md:text-base text-white font-light flex items-center gap-2">
              <i class="fa fa-line-chart text-sky-400"></i> Revenue Flow Velocity (<?php echo $selected_year; ?>)
            </h3>
          </div>
          <div class="box-body pt-3">
            <div class="chart relative h-[220px] md:h-[270px]">
              <canvas id="monthlySalesChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl p-4">
          <div class="box-header pb-2 border-b border-slate-800">
            <h3 class="box-title text-sm md:text-base text-white font-light flex items-center gap-2">
              <i class="fa fa-pie-chart text-amber-400"></i> System Matrix Summary
            </h3>
          </div>
          <div class="box-body pt-3">
            <ul class="divide-y divide-slate-800/80 text-xs">
              <li class="flex justify-between py-2.5 text-slate-300">
                <span>Total Catalog Items</span>
                <code><?php echo $total_products; ?></code>
              </li>
              <li class="flex justify-between py-2.5 text-slate-300">
                <span>Low Stock Threshold (&le; 5)</span>
                <span class="badge bg-amber-500/20 text-amber-300 border border-amber-500/30"><?php echo $total_low_stock; ?></span>
              </li>
              <li class="flex justify-between py-2.5 text-slate-300">
                <span>Out of Stock Items</span>
                <span class="badge bg-rose-500/20 text-rose-300 border border-rose-500/30"><?php echo $total_out_of_stock; ?></span>
              </li>
              <li class="flex justify-between py-2.5 text-slate-300">
                <span>Active Store Outlets</span>
                <code><?php echo $total_stores; ?></code>
              </li>
              <li class="flex justify-between py-2.5 text-slate-300">
                <span>Registered Operatives</span>
                <code><?php echo $total_users; ?></code>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile-Optimized Tables Row: Stock Alerts & Recent Orders -->
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl p-4">
          <div class="box-header pb-2 border-b border-slate-800 flex justify-between items-center">
            <h3 class="box-title text-sm md:text-base text-white font-light flex items-center gap-2">
              <i class="fa fa-bell-o text-rose-400"></i> Critical Stock Alerts
            </h3>
            <a href="<?php echo base_url('products'); ?>" class="btn btn-xs btn-primary">View All</a>
          </div>
          <div class="box-body p-0 table-responsive">
            <table class="table table-hover text-xs">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>SKU</th>
                  <th>Qty</th>
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
                        <span class="badge <?php echo ($item['qty'] <= 0) ? 'bg-rose-500/20 text-rose-300' : 'bg-amber-500/20 text-amber-300'; ?>">
                          <?php echo $item['qty']; ?>
                        </span>
                      </td>
                      <td><?php echo $currency . ' ' . number_format((float)$item['price'], 2); ?></td>
                      <td>
                        <?php if($item['qty'] <= 0): ?>
                          <span class="px-2 py-0.5 rounded text-[10px] bg-rose-500/20 text-rose-300 border border-rose-500/30">Out of Stock</span>
                        <?php else: ?>
                          <span class="px-2 py-0.5 rounded text-[10px] bg-amber-500/20 text-amber-300 border border-amber-500/30">Low Stock</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-slate-500 py-4">All catalog inventory healthy!</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="box bg-slate-950/80 border border-white/10 rounded-xl p-4">
          <div class="box-header pb-2 border-b border-slate-800 flex justify-between items-center">
            <h3 class="box-title text-sm md:text-base text-white font-light flex items-center gap-2">
              <i class="fa fa-shopping-bag text-emerald-400"></i> Recent Orders
            </h3>
            <a href="<?php echo base_url('orders'); ?>" class="btn btn-xs btn-primary">View All</a>
          </div>
          <div class="box-body p-0 table-responsive">
            <table class="table table-hover text-xs">
              <thead>
                <tr>
                  <th>Bill No</th>
                  <th>Customer</th>
                  <th>Date</th>
                  <th>Amount</th>
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
                          <span class="px-2 py-0.5 rounded text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Paid</span>
                        <?php else: ?>
                          <span class="px-2 py-0.5 rounded text-[10px] bg-amber-500/20 text-amber-300 border border-amber-500/30">Unpaid</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-slate-500 py-4">No recent transactions.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#dashboardMainMenu").addClass('active');

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
