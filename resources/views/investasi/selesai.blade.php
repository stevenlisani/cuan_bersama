<!-- Basic Modal-->
<div class="modal fade" id="selesaiInvestasi{{$investasi->id_investasi}}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Data Edit Investasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <!-- Vertical Form -->
          <form class="row g-3" action="{{ route('investasi.selesai', $investasi->id_investasi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="inputName" class="form-label">Nama Coin</label>
                <input type="text" class="form-control" id="inputName" placeholder="Nama Coin" name="coin" value="{{$investasi->coin}}" readonly disabled>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Harga Entri</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="20.01" name="harga_entri" value="{{$investasi->harga_entri}}" disabled readonly>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Nominal</label>
                <input type="number" class="form-control" id="inputPassword4" placeholder="Rp. 2.000" name="nominal" value="{{$investasi->nominal}}" disabled readonly>
              </div>
              <div class="col-12">
                <label for="profit" class="form-label">Profit</label>
                <input type="number" class="form-control" id="profit" placeholder="Nominal Profit dari Investasi" name="profit">
              </div>

              <div class="text-start mt-4">
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Change Status</button>
        </div>
        </form><!-- Vertical Form -->
      </div>
    </div>
</div><!-- End Basic Modal-->
