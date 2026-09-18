<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header" style="padding: 25px 25px 15px 25px;">
    <h1 style="font-weight: 200; letter-spacing: -0.5px; color: #ffffff;">
      AI Demand Prediction
      <small style="color: #64748b; font-weight: 300;">Smart Inventory Forecasting & Reorder Engine</small>
    </h1>
    <ol class="breadcrumb" style="background: transparent; top: 25px;">
      <li><a href="<?php echo base_url('dashboard'); ?>" style="color: #64748b;"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active" style="color: #fbbf24;">AI Forecast</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="padding: 0 25px 25px 25px;">

    <div class="metric-card" style="margin-bottom: 25px; border-left: 4px solid #fbbf24; background: rgba(15, 15, 15, 0.9);">
      <h4 style="color: #ffffff; font-weight: 300; display: flex; align-items: center; gap: 8px; margin-top: 0;">
        <iconify-icon icon="solar:stars-minimalistic-linear" width="22" height="22" class="text-amber-400"></iconify-icon>
        Neural Inventory Optimization Engine
      </h4>
      <p style="color: #94a3b8; font-weight: 300; font-size: 13px; margin-bottom: 0;">
        Using Double Exponential Smoothing on historical velocity vectors, the predictive model calculates 30-day customer demand and generates automated reorder advice to prevent stockouts.
      </p>
    </div>

    <div class="box">
      <div class="box-header">
        <h3 class="box-title"><i class="fa fa-bar-chart" style="color: #fbbf24;"></i> Predictive Stock Velocity & Risk Matrix</h3>
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
                <th>Predicted 30d Demand</th>
                <th>AI Recommended Reorder</th>
                <th>Stockout Risk Score</th>
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
                  <td><strong style="color: #38bdf8;"><?php echo $f['predicted_demand_30d']; ?> units</strong></td>
                  <td>
                    <?php if($f['recommended_reorder'] > 0): ?>
                      <span class="label label-warning" style="font-size: 12px; padding: 5px 8px;">
                        +<?php echo $f['recommended_reorder']; ?> units
                      </span>
                    <?php else: ?>
                      <span class="label label-success">Stock Optimal</span>
                    <?php endif; ?>
                  </td>
                  <td style="min-width: 140px;">
                    <div class="progress progress-xs progress-striped active" style="margin-bottom: 5px; background: #1a1a1a;">
                      <div class="progress-bar progress-bar-<?php echo ($f['stockout_risk_pct'] >= 75) ? 'danger' : (($f['stockout_risk_pct'] >= 40) ? 'warning' : 'success'); ?>" style="width: <?php echo $f['stockout_risk_pct']; ?>%"></div>
                    </div>
                    <small style="color: #cbd5e1;"><strong><?php echo $f['stockout_risk_pct']; ?>%</strong> (<?php echo $f['risk_level']; ?>)</small>
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
