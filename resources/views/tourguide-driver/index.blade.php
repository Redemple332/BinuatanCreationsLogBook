@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tourguide Driver/</span> List</h4>
        <!-- Striped Rows -->
        <div class="card">
            <div class="row">
                <div class="col-md-9">
                    <h5 class="card-header">Tourguide Driver Table | Total Amount:
                        Total
                        TG and Drivers: <span class="badge bg-label-primary">
                            {{ $TGDrivers->count() }}</span>
                    </h5>
                </div>
                <div class="col-md-3" style="margin-top:.4rem;">
                    <a href="{{ route('tourguide-driver.exportSummary') }}" class="btn btn-primary btn-sm mt-4"
                        id="btn-search-ba"><i class="fas fa-plus-square"></i>
                        Print Summary</a>
                    <a class="btn btn-success btn-sm mt-4" href="{{ route('tourguide-driver.exportSummary') }}"
                        id="btn-excel-ba"><i class="fa fa-file-excel"></i>
                        Exel</a>
                    <a class="btn btn-danger btn-sm mt-4" href="{{ route('tourguide-driver.pdf') }}" id="btn-pdf-ba"
                        target="_blank"><i class="fa fa-file-pdf"></i> PDF</a>
                </div>
            </div>

            <div class="row m-2">
                <form action="{{ route('tourguide-driver.index') }}" method="Get">
                    <div class="col-md-3">
                        <input type="input" class="form-control" name="search" value="{{ @Request('search') }}"
                            placeholder="Search">
                    </div>
                    <div class="col-md-3 mt-2">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Agency</th>
                            <th>Occupation</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @php
                            $grandTotal = 0;
                        @endphp
                        @forelse ($TGDrivers as $index => $item)
                            <tr>
                                <td><input class="form-check-input" name="id[]" type="checkbox" value=""
                                        id="defaultCheck3" checked />
                                    <strong>{{ $index + 1 }}</strong>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->agency }}</td>
                                <td><span
                                        class="badge {{ $item->occupation == 'Driver' ? 'bg-label-primary' : 'bg-label-warning' }} me-1">{{ $item->occupation }}</span>
                                </td>
                                @php
                                    $totalAmount = 0;
                                @endphp
                                @forelse ($item->logBooks as $item2)
                                    @php
                                        $totalAmount += $item2->logBook->individual_share;
                                    @endphp
                                @empty
                                @endforelse
                                @php
                                    $grandTotal += $totalAmount;
                                @endphp
                                <td class="text-right">{{ number_format($totalAmount, 2) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('tourguide-driver.show', ['id' => $item->id]) }}"><i
                                                    class="bx bx-grid-alt me-1"></i>
                                                View</a>
                                            <a class="dropdown-item"
                                                href="{{ route('tourguide-driver.edit', ['id' => $item->id]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item"
                                                href="{{ route('tourguide-driver.delete', ['id' => $item->id]) }}"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        <tr>
                            <td colspan="3"></td>
                            <td><b>Grand Total</b></td>
                            <td><b>{{ number_format($grandTotal, 2) }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Striped Rows -->
    </div>
@endsection
