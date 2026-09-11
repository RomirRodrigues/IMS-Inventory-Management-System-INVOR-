<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      AI Demand Prediction
      <small>& Stock Reorder Forecasting</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">AI Forecasting</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="callout callout-info" style="border-radius: 6px;">
      <h4><i class="fa fa-magic"></i> AI Inventory Optimization Engine</h4>
      <p>Using Exponential Smoothing on historical sales velocity, our machine learning model predicts 30-day customer demand and calculates optimal reorder points to prevent stockouts.</p>
    </div>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-bar-chart"></i> Predictive Stock Demand & Reorder Advice</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table id="forecastTable" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Current Stock</th>
                <th>Total Units Sold</th>
                <th>Predicted 30-Day Demand</th>
                <th>AI Recommended Reorder</th>
                <th>Stockout Risk</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($forecasts as $f): ?>
                <tr>
                  <td><code><?php echo htmlspecialchars($f['sku']); ?></code></td>
                  <td><strong><?php echo htmlspecialchars($f['product_name']); ?></strong></td>
                  <td>
                    <span class="badge <?php echo ($f['current_stock'] <= 5) ? 'bg-red' : 'bg-green'; ?>">
                      <?php echo $f['current_stock']; ?> units
                    </span>
                  </td>
                  <td><?php echo $f['total_units_sold']; ?> units</td>
                  <td><strong><?php echo $f['predicted_demand_30d']; ?> units</strong></td>
                  <td>
                    <?php if($f['recommended_reorder'] > 0): ?>
                      <span class="label label-warning" style="font-size: 12px; padding: 5px 8px;">
                        +<?php echo $f['recommended_reorder']; ?> units
                      </span>
                    <?php else: ?>
                      <span class="label label-success">Sufficient Stock</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="progress progress-xs progress-striped active" style="margin-bottom: 5px;">
                      <div class="progress-bar progress-bar-<?php echo ($f['stockout_risk_pct'] >= 75) ? 'danger' : (($f['stockout_risk_pct'] >= 40) ? 'warning' : 'success'); ?>" style="width: <?php echo $f['stockout_risk_pct']; ?>%"></div>
                    </div>
                    <small><strong><?php echo $f['stockout_risk_pct']; ?>%</strong> (<?php echo $f['risk_level']; ?>)</small>
                  </td>
                  <td>
                    <a href="<?php echo base_url('products/update/'.$f['product_id']); ?>" class="btn btn-xs btn-primary btn-flat"><i class="fa fa-edit"></i> Restock</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </section>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#forecastNav").addClass('active');
    $('#forecastTable').DataTable({
      'order': [[ 6, "desc" ]]
    });
  });
</script>
