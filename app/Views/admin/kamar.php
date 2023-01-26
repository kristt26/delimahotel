<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div ng-controller="kamarController">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Data Kamar</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input data Kamar</h4>
                    <form class="forms-sample" ng-submit="save()">
                        <div class="form-group">
                            <label for="nama">Jenis Kamar</label>
                            <select class="form-control form-control-sm" ng-options="item.nama for item in datas.jenis" ng-model="jenis" ng-change="model.jenis_kamar_id=jenis.id; model.nama=jenis.nama"></select>
                            <!-- <input type="text" class="form-control form-control-sm" ng-model="model.nama" placeholder="Nama Jenis Kamar"> -->
                        </div>
                        <div class="form-group">
                            <label>Kode Kamar</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.kode_kamar" placeholder="Kode Kamar">
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
                                    <td>Jenis Kamar</td>
                                    <td>Kode Kamar</td>
                                    <td><i class="mdi mdi-settings"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.kamar">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.kode_kamar}}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" ng-click="edit(item)"><i class="mdi mdi-pencil"></i></button>
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

<?= $this->endSection() ?>