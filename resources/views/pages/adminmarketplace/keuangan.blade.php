@extends('layouts.Admin.adminmarketplace')

@section('content')
{{-- HEADER --}}
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fas fa-warehouse"></i></div>
                            KEUANGAN
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN PAGE CONTENT --}}

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card card-header-actions">
                <div class="card-header ">Saldo = Rp. {{ $saldo }}
                    @if (isset($keuangan->first()->status))
                    @if ($keuangan->first()->status != 'PENDING' && $saldo > 0)
                    <a href="" class="btn btn-danger btn-datatable  mr-2" type="button" data-toggle="modal"
                        data-target="#Modaltambah">Tarik Saldo
                    </a>
                    @else
                    @if ($saldo > 0)
                    <a href="#" class="btn btn-sm btn-primary"> Penarikan dalam Proses</a>


                    @endif

                    @endif
                    @else
                    @if ($saldo > 0)
                    <a href="" class="btn btn-danger btn-datatable  mr-2" type="button" data-toggle="modal"
                        data-target="#Modaltambah">Tarik Saldo
                    </a>
                    @endif

                    @endif

                </div>
            </div>
            <div class="card-body">
                <div class="datatable">

                    @if(session('messageberhasil'))
                    <div class="alert alert-success" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messageberhasil') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    @if(session('messagehapus'))
                    <div class="alert alert-danger" role="alert"> <i class="fas fa-check"></i>
                        {{ session('messagehapus') }}
                        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif

                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" id="dataTable" width="100%"
                                    cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 30px;">No</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 80px;">tanggal</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 150px;">jumlah</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">Bank Penarikan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">status</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 200px;">keterangan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Actions: activate to sort column ascending"
                                                style="width: 77px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($keuangan as $item)
                                        <tr role="row" class="odd">
                                            <th scope="row" class="small" class="sorting_1">{{ $loop->iteration}}</th>
                                            <td>{{ $item->updated_at }}</td>
                                            <td>{{ $item->jumlah}}</td>
                                            <td>{{ $item->Bankacc->Bank->nama_bank}}
                                                {{  $item->Bankacc->nomor_rekening }} A/n
                                                {{ $item->Bankacc->nama_account }}</td>
                                            <td>{{ $item->status}}</td>
                                            <td>
                                                @if ({{ $item->status}} == 'BERHASIL')
                                                <!-- Button trigger modal -->
                                                <button class="btn btn-primary" type="button" data-toggle="modal"
                                                    data-target="#exampleModalCenter">Lihat Bukti</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                    Bukti</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="https://admin.bengkel-kuy.com/image/{{ $item['photo'] }}"
                                                                    width="100" height="80" /> </div>
                                                            <div class="modal-footer"><button class="btn btn-secondary"
                                                                    type="button" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    {{ $item->keterangan}}
                                                    @endif

                                            </td>
                                            <td>
                                                @if ($item->status == 'PENDING')
                                                <a href="" class="btn btn-danger btn-datatable  mr-2" type="button"
                                                    data-toggle="modal"
                                                    data-target="#Modalhapus-{{ $item->id_keuangan }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                                <div class="modal fade" id="Modalhapus-{{ $item->id_keuangan }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger-soft">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                    Konfirmasi Hapus Data</h5>
                                                                <button class="close" type="button" data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('keuangan-destroy', $item->id_keuangan) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-body">Apakah Anda Yakin Menghapus Data
                                                                    Penarikan {{ $item->id_penarikan }}?</div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-danger" type="submit">Ya!
                                                                        Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="tex-center">
                                                Data Keuangan Kosong
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="Modaltambah" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="staticBackdropLabel">Tarik Saldo </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('tarik-saldo') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="small mb-1">Isikan Form Dibawah Ini</label>
                    <hr>
                    </hr>
                    <div class="form-group">
                        <label class="small" for="jumlah">Jumlah</label>
                        <input class="form-control" type="text" id="kode_merk" name="jumlah" value="{{ $saldo }} "
                            readonly>
                    </div>

                    <div class="form-group">
                        <select class="form-control select2" id="kt_select2_1" name="id_bank_account" required>
                            <option value="" holder>Pilih Bank</option>
                            @foreach ($bank as $item)
                            <option value="{{ $item->id_bank_account }}">
                                {{ $item->Bank->nama_bank}} {{  $item->nomor_rekening }} A/n {{ $item->nama_account }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="Submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>

{{-- Callback Modal Jika Validasi Error --}}
@if (count($errors) > 0)
<button id="validasierror" style="display: none" type="button" data-toggle="modal" data-target="#Modaltambah">Open
    Modal</button>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="{{ asset('assets/select2.js') }}"></script>

{{-- Script Open Modal Callback --}}
<script>
    $(document).ready(function () {
        $('#validasierror').click();
        KTSelect2.init();

    });

</script>

@endsection
