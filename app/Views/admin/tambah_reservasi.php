<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<div ng-controller="addController">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Tambah Reservasi</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <!-- Biodata -->
                <div class="card-body" ng-if="view==''">
                    <h4 class="card-title">Biodata Tamu</h4>
                    <form class="forms-sample" ng-submit="next('biodata')">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label><sup class="text-danger">*</sup> Jenis Identitas</label>
                                <select class="form-control form-control-sm" ng-model="model.jenis_identitas" required>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Pasport">Pasport</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label><sup class="text-danger">*</sup> No. Identitas</label>
                                <input type="text" class="form-control form-control-sm" ng-model="model.no_identitas" placeholder="No harus sesuai yang tertera" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="nama"><sup class="text-danger">*</sup> Nama</label>
                                <input type="text" class="form-control form-control-sm" ng-model="model.nama" placeholder="Nama sesuai kartu" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><sup class="text-danger">*</sup> Jenis Kelamin</label>
                                <select class="form-control form-control-sm" ng-model="model.gender" required>
                                    <option value="L">Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label><sup class="text-danger">*</sup> Tepl/Hp</label>
                                <input type="text" class="form-control form-control-sm" ng-model="model.telp" placeholder="No kontak yang bisa dihubungi" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-sm" ng-model="model.email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><sup class="text-danger">*</sup> Alamat</label>
                            <textarea rows="4" class="form-control form-control-sm" ng-model="model.alamat" required>Alamat sesuai kartu identitas</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Next</button>
                    </form>
                </div>
                <!-- Pilih Kamar -->
                <div class="card-body" ng-if="view=='biodata'">
                    <h4 class="card-title">Pilihan Kamar</h4>
                    <form class="forms-sample" ng-submit="next('biodata')">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label><sup class="text-danger">*</sup> Jenis Identitas</label>
                                <select class="form-control form-control-sm" ng-model="model.jenis_identitas" required>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="Pasport">Pasport</option>
                                </select>
                            </div>
                            <div class="form-group  col-md-4">
                                <label><sup class="text-danger">*</sup> No. Identitas</label>
                                <input type="text" class="form-control form-control-sm" ng-model="model.no_identitas" placeholder="No harus sesuai yang tertera" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="nama"><sup class="text-danger">*</sup> Nama</label>
                                <input type="text" class="form-control form-control-sm" ng-model="model.nama" placeholder="Nama sesuai kartu" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><sup class="text-danger">*</sup> Jenis Kelamin</label>
                                <select class="form-control form-control-sm" ng-model="model.gender" required>
                                    <option value="L">Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label><sup class="text-danger">*</sup> Tepl/Hp</label>
                                <input type="text" class="form-control form-control-sm" ng-model="model.telp" placeholder="No kontak yang bisa dihubungi" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-sm" ng-model="model.email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label><sup class="text-danger">*</sup> Alamat</label>
                            <textarea rows="4" class="form-control form-control-sm" ng-model="model.alamat" required>Alamat sesuai kartu identitas</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Next</button>
                    </form>
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
                                    <!-- <h4 class="card-title">Input data fasilitas</h4> -->
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