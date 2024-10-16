@extends('layouts-anggota.profile')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

      <div class="row">
        <div class="col-xl-12">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>

                </ul>
                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profile Details</h5>



                    <div class="row">
                      <div class="col-lg-3 col-md-4 label mb-4">Full Name </div>
                      <div class="col-lg-9 col-md-8 mb-4">: {{Auth::user()->name}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label mb-4">Email </div>
                      <div class="col-lg-9 col-md-8 mb-4">: {{Auth::user()->email}}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label mb-4">Nomer Telepon</div>
                      <div class="col-lg-9 col-md-8 mb-4">: {{ $nomer_telepon }}</div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label mb-4">Alamat</div>
                      <div class="col-lg-9 col-md-8 mb-4">: {{ $alamat }}</div>
                    </div>



                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                    <!-- Profile Edit Form -->
                    <form action="{{ route('anggota-profile.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="name" type="text" class="form-control" id="name" value="{{Auth::user()->name}}">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="email" value="{{Auth::user()->email}}">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="inputPassword4" class="col-md-4 col-lg-3 col-form-label">Nomer Telepon</label>
                        <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="inputPassword4" placeholder="Nomer Telepon" name="no_tlp" value="{{$nomer_telepon}}">
                    </div>
                    </div>

                      <div class="row mb-3">
                        <label for="inputAddress" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                        <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="inputAddress" placeholder="Jl.Indonesia No..." name="alamat" value="{{ $alamat }}">
                    </div>
                    </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form><!-- End Profile Edit Form -->

                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form action="{{ route('anggota-change.password', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password" type="password" class="form-control" id="currentPassword">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="newpassword" type="password" class="form-control" id="newPassword">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        </div>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                      </div>
                    </form><!-- End Change Password Form -->

                  </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>


      </div>

    </section>

  </main><!-- End #main -->
  @endsection
