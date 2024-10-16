@extends('layouts-anggota.harga-coin')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Harga Coin</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Harga Coin</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Harga-Harga Coin Crypto</h5>

                {{-- <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Symbol</th>
                        <th>Price (USD)</th>
                        <th>1h %</th>
                        <th>24h %</th>
                        <th>7d %</th>
                        <th>Volume (24h)</th>
                        <th>Market Cap</th>
                        <th>Sparkline</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($crypto as $crypto)
            <tr>
                <td>{{ $crypto['rank'] }}</td>
                <td>{{ $crypto['name'] }}</td>
                <td>{{ $crypto['symbol'] }}</td>
                <td>{{ $crypto['price'] }}</td>
                <td>{{ $crypto['price_change_1h'] }}%</td>
                <td>{{ $crypto['price_change_24h'] }}%</td>
                <td>{{ $crypto['price_change_7d'] }}%</td>
                <td>{{ $crypto['volume_24h'] }}</td>
                <td>{{ $crypto['market_cap'] }}</td>
                <td>
                    @foreach($crypto['sparkline'] as $spark)
                        {{ $spark }},
                    @endforeach
                </td>
            </tr>
        @endforeach
                  </tbody>
                </table>
                <!-- End Table with stripped rows --> --}}
                <script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<gecko-coin-price-chart-widget locale="en" outlined="true" coin-id="bitget-token" initial-currency="usd"></gecko-coin-price-chart-widget>

                <!-- CoinGecko Widget 1 -->
                <script src="https://widgets.coingecko.com/gecko-coin-list-widget.js"></script>
                <gecko-coin-list-widget locale="en" outlined="true" coin-ids="" initial-currency="usd"></gecko-coin-list-widget>
                <!-- ENd CoinGecko Widget 1 -->

                <!-- CoinGecko Widget 2 -->
                <script src="https://widgets.coingecko.com/gecko-coin-list-widget.js"></script>
<gecko-coin-list-widget locale="en" outlined="true" coin-ids="bitget-token,the-open-network,dogs-2,cats-2,hamster-kombat" initial-currency="usd"></gecko-coin-list-widget>
                <!-- ENd CoinGecko Widget 2 -->

            </div>

          </div>
        </div>
      </section>



  </main><!-- End #main -->
  @endsection
