<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div ng-controller="menuController">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Data Menu</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah data</h4>
                    <form class="forms-sample" ng-submit="save()">
                        <div class="form-group">
                            <label for="menu">Menu Makanan</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.menu" placeholder="Nama menu makanan">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-dark">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" ng-model="model.harga" ui-number-mask="0">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <button type="button" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Tambahan</h4>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <td width="5%">No</td>
                                    <td>Nama Menu Makanan</td>
                                    <td>Harga</td>
                                    <td width="15%"><i class="mdi mdi-settings"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.menu}}</td>
                                    <td>Rp. {{item.harga | currency}}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" ng-click="edit(item)"><i class="mdi mdi-pencil"></i></button>
                                        <button class="btn btn-danger btn-sm" ng-click="delete(item)"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="fasilitas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{dataKamar.nama}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:#f1f1f1">
                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Input data fasilitas</h4>
                                    <form class="forms-sample" ng-submit="saveFasilitas(modell)">
                                        <div class="form-group">
                                            <label for="nama">Fasilitas</label>
                                            <input type="text" class="form-control form-control-sm" ng-model="modell.fasilitas" placeholder="Fasilitas" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input type="file" class="form-control form-control-sm" accept="image/*, application/pdf" id="berkas_baptis" ng-model="modell.file" base-sixty-four-input required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Daftar Fasilitas</h4>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>No</td>
                                                    <td>Fasilitas</td>
                                                    <td>Foto</td>
                                                    <td><i class="mdi mdi-settings"></i></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="item in dataKamar.fasilitas">
                                                    <td>{{$index+1}}</td>
                                                    <td>{{item.fasilitas}}</td>
                                                    <td>{{item.photo}}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" ng-click="itemFasilitas(item)"><i class="mdi mdi-pencil"></i></button>
                                                        <button class="btn btn-primary btn-sm" ng-click="setDetail(item)" data-toggle="modal" data-target="#fasilitas"><i class="mdi mdi-file"></i></button>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>