@extends('layouts.app')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendance/</span> Log Book</h4>
        @if (Session::has('message'))
            <div class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class='bx bx-bell me-2'></i>
                    <div class="me-auto fw-semibold">{{ Session::get('message') }}</div>
                    <small>0 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Amount: {{ $lastLog->amount }} | Agency: {{ $lastLog->agency }} | Date: {{ $lastLog->date }}
                </div>
            </div>
        @endif
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5>Last Log Book</h5>
                            <h5 class="card-title text-primary">Amount: {{ number_format($lastLog->amount, 2) }} 🎉 %6 is
                                {{ number_format($lastLog->share, 2) }}</h5>
                            <p class="mb-4">
                                @forelse ($lastLog->touguideDrivers as $item)
                                    {{ $item->touguideDriver->name }},
                                @empty
                                @endforelse
                                <span class="fw-bold">Agency: {{ $lastLog->agency }} | Date: {{ $lastLog->date }}</span>
                            </p>

                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/illustrations/man-with-laptop-light.png"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Log Book</h5>
                        <small class="text-muted float-end">Information</small>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('log-book.store') }}" method="Post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <div class="input-group input-group-merge">
                                    <select class="form-select name" name="name[]" multiple="multiple">
                                        @forelse ($tourguide_drivers as $item)
                                            <option value="{{ $item->id }};{{ $item->name }}">{{ $item->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="error">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agency</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                            <input name="agency" type="text" class="form-control" placeholder="Agency"
                                                value="{{ old('agency') }}" />
                                        </div>
                                        @if ($errors->has('agency'))
                                            <span class="error">{{ $errors->first('agency') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Amount</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class='bx bx-dollar'></i></span>
                                            <input name="amount" type="number" class="form-control" placeholder="Amount"
                                                value="{{ old('amount') }}" />
                                        </div>
                                        @if ($errors->has('amount'))
                                            <span class="error">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Date</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bxs-calendar'></i></span>
                                        <input name="date" class="form-control" type="date"
                                            value="{{ old('date') ?? $lastLog->date }}" id="html5-date-input" />
                                    </div>
                                    @if ($errors->has('date'))
                                        <span class="error">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">Children</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <input name="children" class="form-control" type="number"
                                            value="{{ old('children') }}" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Female</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <input name="female" class="form-control" type="number"
                                            value="{{ old('female') }}" />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Male</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                                        <input name="male" class="form-control" type="number"
                                            value="{{ old('male') }}" />

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Country</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class='bx bx-flag'></i></span>
                                        <input name="country" class="form-control" type="input"
                                            value="{{ old('country') }}" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- / Content -->
@endsection
