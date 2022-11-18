@extends('layouts.app')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendance/</span> Log Book</h4>
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Basic with Icons</h5>
                    <small class="text-muted float-end">Update Profile</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('tourguide-driver.update', ['id' => $TGDriver->id]) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ $TGDriver->name }}" aria-label="{{ $TGDriver->name }}"
                                    value="{{ $TGDriver->name }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Agency</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input name="agency" value="{{ $TGDriver->agency }}"type="text" class="form-control"
                                    placeholder="ACME Inc." />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Agency</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <select name="occupation" class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option {{ $TGDriver->occupation == 'Driver' ? 'selected' : '' }} value="Driver">Driver
                                    </option>
                                    <option {{ $TGDriver->occupation == 'Tourguide' ? 'selected' : '' }} value="Tourguide">
                                        Tourguide</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>
    <!-- / Content -->
@endsection
