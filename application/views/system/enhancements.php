<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header" style="padding: 25px 25px 15px 25px;">
    <h1 style="font-weight: 200; letter-spacing: -0.5px; color: #ffffff;">
      System Enhancements Matrix
      <small style="color: #64748b; font-weight: 300;">Active 21st.dev Feature Capabilities</small>
    </h1>
    <ol class="breadcrumb" style="background: transparent; top: 25px;">
      <li><a href="<?php echo base_url('dashboard'); ?>" style="color: #64748b;"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active" style="color: #38bdf8;">Enhancements</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="padding: 0 25px 25px 25px;">

    <div class="row" style="margin-bottom: 25px;">
      <div class="col-md-12">
        <p style="color: #94a3b8; font-weight: 300; font-size: 14px;">
          The inventory system has been upgraded with advanced 21st.dev features to meet enterprise scalability, remote accessibility, and real-time security needs.
        </p>
      </div>
    </div>

    <!-- 9 Roadmap Feature Cards -->
    <div class="row">
      <!-- 1. Mobile Application -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #38bdf8; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:smartphone-linear" width="22" height="22" class="text-sky-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Mobile Application API</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Native mobile app endpoints enabled for iOS & Android to manage real-time inventory and instant push notifications.
          </p>
          <span class="label label-info" style="font-size: 10px;">ACTIVE REST API</span>
        </div>
      </div>

      <!-- 2. Cloud Database Support -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #c084fc; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(192, 132, 252, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:cloud-storage-linear" width="22" height="22" class="text-purple-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Cloud Database Support</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Configured for cloud MySQL solutions (PlanetScale, Supabase, Aiven, AWS RDS) for remote access and auto backups.
          </p>
          <span class="label label-purple" style="font-size: 10px; background: #9333ea; color: #fff;">CLOUD READY</span>
        </div>
      </div>

      <!-- 3. Barcode/QR Scanning -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #f87171; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(248, 113, 113, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:qr-code-linear" width="22" height="22" class="text-rose-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Barcode / QR Scanning</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Integrated HTML5 web camera & mobile camera scanning for fast product lookup and instant order checkout.
          </p>
          <span class="label label-danger" style="font-size: 10px;">CAMERA ENABLED</span>
        </div>
      </div>

      <!-- 4. AI-Based Prediction -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #38bdf8; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:stars-minimalistic-linear" width="22" height="22" class="text-sky-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">AI-Based Prediction</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Exponential Smoothing machine learning algorithms for 30-day demand forecasting and automated reordering.
          </p>
          <a href="<?php echo base_url('forecast'); ?>" class="btn btn-xs btn-info">Open AI Engine</a>
        </div>
      </div>

      <!-- 5. Automated Notifications -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #fbbf24; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(251, 191, 36, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:bell-bing-linear" width="22" height="22" class="text-amber-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Automated Notifications</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Automated HTML email notifications for low stock warnings, order confirmation receipts, and critical system events.
          </p>
          <span class="label label-warning" style="font-size: 10px;">EMAIL SYSTEM ACTIVE</span>
        </div>
      </div>

      <!-- 6. Multi-Language Support -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #f87171; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(248, 113, 113, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:global-linear" width="22" height="22" class="text-rose-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Multi-Language Support</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Multi-language switcher enabled for English, Spanish, French, and Hindi with persistent session memory.
          </p>
          <span class="label label-danger" style="font-size: 10px;">4 LANGUAGES ACTIVE</span>
        </div>
      </div>

      <!-- 7. Advanced Analytics -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #38bdf8; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:chart-2-linear" width="22" height="22" class="text-sky-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Advanced Analytics</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Reporting with trend analysis, Chart.js line velocity metrics, and customizable dashboard summary boxes.
          </p>
          <a href="<?php echo base_url('reports'); ?>" class="btn btn-xs btn-primary">View Reports</a>
        </div>
      </div>

      <!-- 8. API Integration -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #34d399; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(52, 211, 153, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:code-circle-linear" width="22" height="22" class="text-emerald-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">API Integration Layer</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            RESTful APIs for integration with third-party systems like accounting software, e-commerce stores, and ERP.
          </p>
          <code style="font-size: 11px;">/api/v1/products</code>
        </div>
      </div>

      <!-- 9. Enhanced Security & 2FA -->
      <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
        <div class="metric-card" style="border-left: 3px solid #f87171; height: 100%;">
          <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 38px; height: 38px; border-radius: 10px; background: rgba(248, 113, 113, 0.1); display: flex; align-items: center; justify-content: center;">
              <iconify-icon icon="solar:shield-check-linear" width="22" height="22" class="text-rose-400"></iconify-icon>
            </div>
            <h4 style="margin: 0; color: #ffffff; font-weight: 400; font-size: 16px;">Enhanced Security & 2FA</h4>
          </div>
          <p style="color: #94a3b8; font-size: 12px; font-weight: 300; line-height: 1.6;">
            Google Single Sign-On (SSO), Two-Factor 6-digit PIN authentication, rate-limiting, and password encryption.
          </p>
          <span class="label label-success" style="font-size: 10px;">2FA & GOOGLE SSO READY</span>
        </div>
      </div>
    </div>

  </section>
</div>
