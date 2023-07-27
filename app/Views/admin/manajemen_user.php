<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div ng-controller="manajemenUserController">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Manajemen User</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Input pengguna</h4>
                    <form class="forms-sample" ng-submit="save()">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.nama" placeholder="Nama pengguna">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.username" placeholder="Username pengguna">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control form-control-sm" ng-model="model.password" placeholder="Password pengguna">
                        </div>
                        <div class="form-group">
                            <label for="akses">User Akses</label>
                            <select class="form-control form-control-sm" ng-model="model.akses">
                                <option value="">---Select User Akses---</option>
                                <option value="Manajer">Manajer</option>
                                <option value="Admin">Admin</option>
                                <option value="Front Office">Front Office</option>
                            </select>
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
                                    <td>Nama Pengguna</td>
                                    <td>Username</td>
                                    <td>User Akses</td>
                                    <td width="10%"><i class="mdi mdi-settings"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.username}}</td>
                                    <td>{{item.akses}}</td>
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