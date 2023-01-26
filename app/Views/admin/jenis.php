<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div ng-controller="jenisController">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Data Jenis Kamar</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input data Jenis Kamar</h4>
                    <form class="forms-sample" ng-submit="save()">
                        <div class="form-group">
                            <label for="nama">Nama Jenis</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.nama" placeholder="Nama Jenis Kamar">
                        </div>
                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.ukuran" placeholder="Ukuran Kamar">
                        </div>
                        <div class="form-group">
                            <label>Kapasitas</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.kapasitas" placeholder="Daya tampung maksimal">
                        </div>
                        <div class="form-group">
                            <label>Service</label>
                            <textarea class="form-control form-control-sm" rows="3" ng-model='model.service'></textarea>
                        </div>
                        <div class="form-group">
                            <label>Jenis Tempat Tidur</label>
                            <select class="form-control form-control-sm" ng-model="model.bad">
                                <option value="Single Bads"> Single Bads</option>
                                <option value="King Bads"> King Bads</option>
                            </select>
                            <!-- <input type="text" class="form-control form-control-sm" ng-model="model.bad" placeholder="Jenis Tempat Tidur"> -->
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="text" class="form-control" ng-model="model.price">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">0.00</span>
                                    </div>
                                </div>
                            </div>
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
                    <h4 class="card-title">Daftar Jenis Kamar</h4>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama Jenis Kamar</td>
                                    <td>Ukuran Kamar</td>
                                    <td>Kapasitas</td>
                                    <td>Jenis Tempat Tidur</td>
                                    <td>Service</td>
                                    <td>Harga</td>
                                    <td><i class="mdi mdi-settings"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.ukuran}}</td>
                                    <td>{{item.kapasitas}}</td>
                                    <td>{{item.bad}}</td>
                                    <td>{{item.service}}</td>
                                    <td>{{item.price}}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" ng-click="edit(item)"><i class="mdi mdi-pencil"></i></button>
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
                                    <form class="forms-sample" ng-submit="save()">
                                        <div class="form-group">
                                            <label for="nama">Fasilitas</label>
                                            <input type="text" class="form-control form-control-sm" ng-model="modell.fasilitas" placeholder="Fasilitas">
                                        </div>
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input type="text" class="form-control form-control-sm" ng-model="modell.file" placeholder="Ukuran Kamar">
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
                                                    <td>{{item.foto}}</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" ng-click="edit(item)"><i class="mdi mdi-pencil"></i></button>
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