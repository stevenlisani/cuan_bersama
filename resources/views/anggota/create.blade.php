<!-- Basic Modal-->
<div class="modal fade" id="addAnggota" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Data Tambah Anggota</h5>
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
          <form class="row g-3" action="{{ route('anggota.store') }}" method="POST">
            @csrf
            <div class="col-12">
              <label for="inputName" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" name="nama_lengkap">
            </div>
            <div class="col-12">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
            </div>
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Nomer Telepon</label>
              <input type="text" class="form-control" id="inputPassword4" placeholder="Nomer Telepon" name="no_tlp">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Jl.Indonesia No..." name="alamat">
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
