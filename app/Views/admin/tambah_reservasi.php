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
                                <input type="text" class="form-control form-control-sm" ng-model="model.no_identitas" minlength="16" maxlength="16" placeholder="No harus sesuai yang tertera" required>
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
            </div>

        </div>
        <div class="col-md-3" ng-if="view=='biodata'">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pilihan Kamar</h4>
                    <form class="forms-sample" ng-submit="next('biodata')">
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label><sup class="text-danger">*</sup> Jenis Kamar</label>
                                <select class="form-control form-control-sm" ng-options="item.nama for item in datas.jenis" ng-model="jenis" ng-change="itemKamar.nama=jenis.nama;itemKamar.price=jenis.price" required>
                                </select>
                            </div>
                            <div class="form-group  col-md-7">
                                <label><sup class="text-danger">*</sup> Kamar Kosong</label>
                                <select class="form-control form-control-sm" ng-options="item.kode_kamar for item in jenis.kamar" ng-model="kamar" ng-change="itemKamar.kamar_id=kamar.id;itemKamar.kode_kamar=kamar.kode_kamar" required>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Tanggal Check In</label>
                                <input type="date" class="form-control form-control-sm" ng-model="itemKamar.checkin" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Check Out</label>
                                <input type="date" class="form-control form-control-sm" ng-model="itemKamar.checkout" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea rows="4" class="form-control form-control-sm" ng-model="itemKamar.catatan" required>Tambahkan catatan disini</textarea>
                        </div>
                        <button type="button" class="btn btn-primary mr-2" ng-click="tambah(itemKamar)">Tambah</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9" ng-if="view=='biodata'">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Booking</h4>
                    <h4 class="card-title">Total Tagihan: Rp. {{getTotal('All') | currency}}</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Kamar</th>
                                    <th>No. Kamar</th>
                                    <th>Tanggal Check In</th>
                                    <th>Tanggal Check Out</th>
                                    <th>Catatan</th>
                                    <th>Harga Kamar</th>
                                    <th>Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in model.kamar">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td>{{item.kode_kamar}}</td>
                                    <td>{{item.checkin | date: 'yyyy-MM-dd'}}</td>
                                    <td>{{item.checkout | date: 'yyyy-MM-dd'}}</td>
                                    <td>{{item.catatan}}</td>
                                    <td>Rp. {{item.price | currency}}</td>
                                    <td>Rp. {{totalKamar(item) | currency}}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">Total</td>
                                    <td>Rp. {{getTotal('kamar') | currency}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in model.menu">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.menu}}</td>
                                            <td>{{item.jumlah}}</td>
                                            <td>{{item.harga}}</td>
                                            <td>{{item.jumlah*item.harga}}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </td>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in model.laundry">
                                            <td>{{$index+1}}</td>
                                            <td>{{item.laundry}}</td>
                                            <td>{{item.jumlah}}</td>
                                            <td>{{item.harga}}</td>
                                            <td>{{item.jumlah*item.harga}}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" ng-click="hapusLayanan('laundry', item)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </td>
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
                    <button type="button" class="btn btn-primary mr-2" ng-click="save()">Simpan</button>
                    <button type="button" class="btn btn-warning mr-2" ng-click="batal()">Batal</button>
                    <button type="button" class="btn btn-info mr-2" data-toggle="modal" data-target="#layananTambahan">Layanan Tambahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="layananTambahan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Layanan Tambahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" ng-submit="saveFasilitas(modell)">
                        <div class="form-group">
                            <label for="nama">Pilih Layanan</label>
                            <select class="form-control form-control-sm" ng-model="itemLayanan" required>
                                <option value="menu">Makanan</option>
                                <option value="laundry">Laundry</option>
                            </select>
                        </div>
                        <div class="form-group" ng-if="itemLayanan=='menu'">
                            <label for="nama">Pilih Menu</label>
                            <select class="form-control form-control-sm" ng-options="item.menu for item in datas.menu" ng-model="setLayanan" ng-change="setItemLayanan(setLayanan)" required>
                            </select>
                        </div>
                        <div class="form-group" ng-if="itemLayanan=='menu'">
                            <label>Jumlah</label>
                            <input type="number" class="form-control form-control-sm" ng-model="data.jumlah" required>
                        </div>
                        <div class="form-group" ng-if="itemLayanan=='laundry'">
                            <label for="nama">Pilih Jenis Laundry</label>
                            <select class="form-control form-control-sm" ng-options="item.laundry for item in datas.laundry" ng-change="setItemLayanan(setLayanan)" ng-model="setLayanan" required>
                            </select>
                        </div>
                        <div class="form-group" ng-if="itemLayanan=='laundry'">
                            <label>Jumlah</label>
                            <input type="number" class="form-control form-control-sm" ng-model="data.jumlah" required>
                        </div>
                        <button type="button" class="btn btn-primary mr-2" ng-click="addLayanan(itemLayanan)">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>