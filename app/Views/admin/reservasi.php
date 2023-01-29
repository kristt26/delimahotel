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
    <div class="card">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" ng-click="setTabs('Reservasi')" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Reservasi</a>
                <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pesan Langsung</a> -->
                <a class="nav-item nav-link" id="nav-contact-tab" ng-click="setTabs('Inap')" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Daftar Inap</a>
            </div>
        </nav>
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
                                            <td><i class="mdi mdi-settings"></i></td>
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
    <div class="modal fade" id="fasilitas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tamu: {{model.nama}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample" ng-submit="save(modell)">
                    <div class="modal-body" style="background-color:#f1f1f1">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama">Status</label>
                                            <select class="form-control" ng-model="model.status">
                                                <option value="Reservasi">Reservasi</option>
                                                <option value="Terisi" ng-show="statusTabs =='Reservasi'">Check In</option>
                                                <option value="Kosong" ng-show="statusTabs =='Inap'">Check Out</option>
                                                <option value="Batal">Batal</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>