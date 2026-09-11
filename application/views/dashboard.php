<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control Panel & Inventory Overview</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Quick Action Bar -->
    <div class="row" style="margin-bottom: 15px;">
      <div class="col-md-12">
        <div class="box box-solid bg-gray-light" style="border-radius: 6px; padding: 10px 15px; margin-bottom: 10px;">
          <strong style="font-size: 14px; margin-right: 15px; color: #333;"><i class="fa fa-bolt text-yellow"></i> Quick Actions:</strong>
          <a href="<?php echo base_url('orders/create'); ?>" class="btn btn-sm btn-primary btn-flat" style="margin-right: 8px;"><i class="fa fa-plus-circle"></i> Create Order</a>
          <a href="<?php echo base_url('products/create'); ?>" class="btn btn-sm btn-success btn-flat" style="margin-right: 8px;"><i class="fa fa-cube"></i> Add Product</a>
          <a href="<?php echo base_url('products'); ?>" class="btn btn-sm btn-info btn-flat" style="margin-right: 8px;"><i class="fa fa-list"></i> View Products</a>
          <a href="<?php echo base_url('reports'); ?>" class="btn btn-sm btn-warning btn-flat"><i class="fa fa-bar-chart"></i> View Sales Reports</a>
        </div>
      </div>
    </div>

    <!-- Small boxes (Stat boxes) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $total_products; ?></h3>
            <p>Total Products</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url('products/'); ?>" class="small-box-footer">Manage Products <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $total_paid_orders; ?></h3>
            <p>Paid Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url('orders/'); ?>" class="small-box-footer">Manage Orders <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box <?php echo ($total_low_stock > 0) ? 'bg-red' : 'bg-yellow'; ?>">
          <div class="inner">
            <h3><?php echo $total_low_stock; ?></h3>
            <p>Low Stock Items (<= 5)</p>
          </div>
          <div class="icon">
            <i class="ion ion-alert-circled"></i>
          </div>
          <a href="<?php echo base_url('products/'); ?>" class="small-box-footer">Check Inventory <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3><?php echo $currency . ' ' . number_format($total_revenue, 2); ?></h3>
            <p>Total Sales Revenue</p>
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <a href="<?php echo base_url('reports/'); ?>" class="small-box-footer">Sales Report <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Sales & Inventory Overview Charts -->
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-line-chart text-blue"></i> Monthly Sales Revenue Overview (<?php echo $selected_year; ?>)</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="monthlySalesChart" style="height: 260px;"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-exclamation-triangle text-yellow"></i> Stock Status Summary</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Total Products in System</b> <span class="pull-right label label-info"><?php echo $total_products; ?></span>
              </li>
              <li class="list-group-item">
                <b>Low Stock Threshold (<= 5)</b> <span class="pull-right label label-warning"><?php echo $total_low_stock; ?></span>
              </li>
              <li class="list-group-item">
                <b>Out of Stock Items</b> <span class="pull-right label label-danger"><?php echo $total_out_of_stock; ?></span>
              </li>
              <li class="list-group-item">
                <b>Active Stores</b> <span class="pull-right label label-success"><?php echo $total_stores; ?></span>
              </li>
              <li class="list-group-item">
                <b>Registered Users</b> <span class="pull-right label label-primary"><?php echo $total_users; ?></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Tables Row: Low Stock Alerts & Recent Orders -->
    <div class="row">
      <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-bell text-red"></i> Low Stock Alerts</h3>
            <div class="box-tools pull-right">
              <a href="<?php echo base_url('products'); ?>" class="btn btn-xs btn-default">View All</a>
            </div>
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
                    <td colspan="5" class="text-center text-muted">All products have sufficient stock!</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-shopping-cart text-green"></i> Recent Orders</h3>
            <div class="box-tools pull-right">
              <a href="<?php echo base_url('orders'); ?>" class="btn btn-xs btn-default">View All</a>
            </div>
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
                    <td colspan="5" class="text-center text-muted">No orders found.</td>
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

    // Chart.js Monthly Sales
    var monthlySalesData = <?php echo $monthly_sales; ?>;
    var canvas = document.getElementById('monthlySalesChart');
    if (canvas) {
      var ctx = canvas.getContext('2d');
      var chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Sales Revenue (<?php echo $currency; ?>)',
            data: monthlySalesData,
            backgroundColor: 'rgba(60, 141, 188, 0.7)',
            borderColor: 'rgba(60, 141, 188, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    }
  }); 
</script>
