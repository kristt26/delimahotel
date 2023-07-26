<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div ng-controller="reservasiController">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Data Reservasi</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav class="d-flex justify-content-between">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" ng-click="setTabs('Reservasi')" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Reservasi</a>
                        <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pesan Langsung</a> -->
                        <a class="nav-item nav-link" id="nav-contact-tab" ng-click="setTabs('Inap')" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Daftar Inap</a>
                    </div>
                    <button class="btn btn-primary btn-rounded btn-icon" onclick="document.location.href='<?= base_url('reservasi/pesanan_add') ?>'"><i class="ti-plus" aria-hidden="true"></i></button>
                </nav>
                <hr>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Daftar Reservasi</h4>
                                        <!-- <button type="button" class="btn btn-primary">Reservasi</button> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>Tamu</td>
                                                    <td>Check In</td>
                                                    <td>Check Out</td>
                                                    <td>Jenis Kamar</td>
                                                    <td>No. Kamar</td>
                                                    <td>Lama Tinggal</td>
                                                    <td class="text-center">Biaya Kamar<br>(Rp.)</td>
                                                    <td class="text-center">Biaya Makanan<br>(Rp.)</td>
                                                    <td class="text-center">Biaya Laundry<br>(Rp.)</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in reservasi">
                                                    <td>{{$index+1}}</td>
                                                    <td>{{item.nama}}</td>
                                                    <td>{{item.checkin}}</td>
                                                    <td>{{item.checkout}}</td>
                                                    <td>{{item.jenis_kamar}}</td>
                                                    <td>{{item.kode_kamar}}</td>
                                                    <td>{{item.lamanya}} Hari</td>
                                                    <td class="text-right">{{item.total | currency}}</td>
                                                    <td class="text-right">{{item.totalMenu | currency}}</td>
                                                    <td class="text-right">{{item.totalLaundry | currency}}</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" ng-click="viewDetail(item)" data-toggle="modal" data-target="#fasilitas"><i class="mdi mdi-playlist-check"></i></button>
                                                        <button class="btn btn-warning btn-sm" ng-click="edit('CheckOut', item)" data-toggle="modal" data-target="#fasilitas"><i class="mdi mdi-logout"></i></button>
                                                        <button class="btn btn-danger btn-sm" ng-click="cek('Cancel', item)"><i class="mdi mdi-close-octagon-outline"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Daftar Inap</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>Tamu</td>
                                                    <td>Check In</td>
                                                    <td>Check Out</td>
                                                    <td>Jenis Kamar</td>
                                                    <td>No. Kamar</td>
                                                    <td><i class="mdi mdi-settings"></i></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in inap">
                                                    <td>{{$index+1}}</td>
                                                    <td>{{item.nama}}</td>
                                                    <td>{{item.checkin}}</td>
                                                    <td>{{item.checkout}}</td>
                                                    <td>{{item.jenis_kamar}}</td>
                                                    <td>{{item.kode_kamar}}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm" ng-click="edit(item)" data-toggle="modal" data-target="#fasilitas"><i class="mdi mdi-file"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
        Launch
    </button>

    <!-- Modal -->
    <div class="modal fade" id="akses" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Butuh Akses yang lebih tinggi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form ng-submit="login(password)">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <input type="text" class="form-control" ng-model="password" placeholder="Enter you password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fasilitas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Total Tagihan: Rp. {{getTotal('All') | currency}}</h4>
                    <div class="row mb-3 mt-3">
                        <div class="col-md-6">
                            <h4>Tambahan Makanan</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Menu</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in model.menu">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.menu}}</td>
                                            <td>{{item.jumlah}}</td>
                                            <td>{{item.harga}}</td>
                                            <td>{{item.jumlah*item.harga}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">Total biaya makanan</td>
                                            <td>{{getTotal('menu')}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Tambahan Laundry</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Laundry</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in model.laundry">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.laundry}}</td>
                                            <td>{{item.jumlah}}</td>
                                            <td>{{item.harga}}</td>
                                            <td>{{item.jumlah*item.harga}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">Total biaya makanan</td>
                                            <td>{{getTotal('laundry')}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>