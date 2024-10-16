@if (Auth::user()->role == 'Admin')

<!-- Basic Modal-->
<div class="modal fade" id="optionExport" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Filter Untuk Export</h5>
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
          <form class="row g-3" action="{{ route('keuangan.export-filter') }}" method="POST" target="_blank">
            @csrf
            <div class="col-12">
              <label for="inputName" class="form-label">Nama Anggota</label>
                <select class="form-select" aria-label="Default select example" name="id_anggota">
                  <option selected disabled>Pilih Nama Anggota</option>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id_anggota }}">{{ $anggota->nama_lengkap }}</option>
                @endforeach

                </select>
            </div>
            <div class="col-12">
              <label class="form-label">Tanggal</label>
                <div class="d-flex justify-content-between">
                    <div class="col-5">
                        <input type="date" class="form-control" name="date_start">
                    </div>
                    <div class="col-2 text-center">
                        <h6>Sampai</h6>
                    </div>
                    <div class="col-5">
              <input type="date" class="form-control" name="date_end">
                    </div>
            </div>
            </div>
            <div class="text-start mt-4 ms-2">
                <div class="col-10">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-danger">Export With Filter</button>
                        </form><!-- Vertical Form -->
                              <a href="{{ route('keuangan.export') }}" class="btn btn-success" target="_blank">Export All Data</a>
                      </div>
                  </div>
              </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Basic Modal-->

@elseif (Auth::user()->role == 'Anggota')
<!-- Basic Modal-->
<div class="modal fade" id="optionExport" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Filter Untuk Export</h5>
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
          <form class="row g-3" action="{{ route('anggota-keuangan.export-filter') }}" method="POST" target="_blank">
            @csrf
            <div class="col-12">
              <label class="form-label">Tanggal</label>
                <div class="d-flex justify-content-between">
                    <div class="col-5">
                        <input type="date" class="form-control" name="date_start">
                    </div>
                    <div class="col-2 text-center">
                        <h6>Sampai</h6>
                    </div>
                    <div class="col-5">
              <input type="date" class="form-control" name="date_end">
                    </div>
            </div>
            </div>
            <div class="text-start mt-4 ms-2">
                <div class="col-10">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-danger">Export With Filter</button>
                        </form><!-- Vertical Form -->
                              <a href="{{ route('anggota-keuangan.export') }}" class="btn btn-success" target="_blank">Export All Data</a>
                      </div>
                  </div>
              </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div><!-- End Basic Modal-->
@endif
