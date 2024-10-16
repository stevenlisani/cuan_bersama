@extends('layouts-anggota.dashboard')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Home</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Home</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-12">
            <div class="row">

              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Profit</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ number_format($total_profit) }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Tabungan<span>| {{Auth::user()->name}}</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bank"></i>
                      </div>
                      <div class="ps-3">
                        <h6>Rp {{number_format($total_tabungan) }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Revenue Card -->

              <!-- Revenue Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Total Tabungan<span>| Seluruh Anggota</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bank2"></i>
                      </div>
                      <div class="ps-3">
                        <h6>Rp {{number_format($total_tabungan_all) }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Revenue Card -->

                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card yellow-card">

                    <div class="card-body">
                        <h5 class="card-title">Tabungan <span>| Prosses</span></h5>

                        <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-gear-wide"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $tabungan_prosses }}</h6>
                        </div>
                        </div>
                    </div>

                    </div>
                </div><!-- End Sales Card -->

              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title">Tabungan <span>| Diterima</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-circle-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $tabungan_terima }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

              <!-- Sales Card -->
              <div class="col-xxl-4 col-md-6">
                <div class="card info-card red-card">

                  <div class="card-body">
                    <h5 class="card-title">Tabungan <span>| Ditolak</span></h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-dash-circle-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $tabungan_tolak }}</h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Sales Card -->

              <!-- Reports -->
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Pie Chart</h5><hr>
                      <h6 class="card-title text-danger">Notes : Jumlah Harga Dalam Nilai 1 : 1.000</h6>

                      <!-- Pie Chart -->
                      <div id="pieChart"></div>

                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            let series = [];
                            <?php foreach ($series as $value) { ?>
                                series.push(<?php echo number_format($value, 0, ',', '.'); ?>);
                            <?php } ?>

                            new ApexCharts(document.querySelector("#pieChart"), {
                                series: series,
                                chart: {
                                    height: 350,
                                    type: 'pie',
                                    toolbar: {
                                        show: true
                                    }
                                },
                                labels: <?php echo json_encode($labels); ?>
                            }).render();
                        });
                      </script>
                      <!-- End Pie Chart -->

                    </div>
                  </div>
            </div> <!-- End Reports -->

            </div>
          </div><!-- End Left side columns -->

        </div>
      </section>

  </main><!-- End #main -->
  @endsection
