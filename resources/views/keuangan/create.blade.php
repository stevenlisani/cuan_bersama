<!-- Basic Modal-->
<div class="modal fade" id="addKeuangan" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Data Tambah Keuangan</h5>
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
          <form class="row g-3" action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
              <label for="inputName" class="form-label">Nama Anggota</label>
                <select class="form-select" aria-label="Default select example" name="id_anggota" required>
                  <option selected disabled>Pilih Nama Anggota</option>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id_anggota }}">{{ $anggota->nama_lengkap }}</option>
                @endforeach

                </select>
            </div>
            <div class="col-12">
              <label for="inputPassword4" class="form-label">jumlah</label>
              <input type="number" class="form-control" id="inputPassword4" placeholder="Rp 2.000" name="jumlah" required>
            </div>
            <div class="col-12">
                <label for="formFile" class="form-label">Upload Bukti Transfer</label>
                <div class="col-sm-12">
                  <input class="form-control" type="file" id="formFile" name="foto">
                </div>
              </div>
            <div class="text-start">
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
        </form><!-- Vertical Form -->
      </div>
    </div>
</div><!-- End Basic Modal-->
