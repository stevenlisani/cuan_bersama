<!-- Basic Modal-->
<div class="modal fade" id="check{{$keuangan->id_keuangan}}" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Data Prosses Status Tabungan</h5>
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
            <div class="col-12">
              <label for="inputName" class="form-label">Nama Anggota</label>
              <input type="text" class="form-control" id="inputEmail4" name="tanggal" required value="{{$keuangan->nama_lengkap}}" readonly >
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="inputEmail4" name="tanggal" required value="{{$keuangan->tanggal}}" readonly>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Jumlah</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="Rp 2.000" name="jumlah" required value="Rp. {{ number_format($keuangan->jumlah) }}" readonly>
              </div>
              <div class="col-12 text-center">
                <label for="inputPassword4" class="form-label">Bukti Transfer</label>
                <img class="form-control" src="{{ url('img_bukti_transfer/' . $keuangan->foto) }}"
                                                height="500">
              </div>
              <div class="text-start mt-4 ms-2">
                  <div class="col-4">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
              </div>

        </div>
      </div>
    </div>
</div><!-- End Basic Modal-->
