<?= $this->extend('layout/client') ?>
<?= $this->section('content') ?>

<!-- Hero Section Begin -->
<div ng-controller='bookingController'>
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Booking Hotel</h2>
                        <div class="">
                            <span style="font-size: 25px;">{{text}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="room-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" ng-show="setView=='Booking'">
                    <div class="col-lg-12" ng-repeat="item in datas">
                        <div class="room-details-item">
                            <img src="<?= base_url() ?>/photo/{{item.fasilitas[0].photo}}" alt="">
                            <div class="rd-text">
                                <div class="rd-title">
                                    <h3>{{item.nama}}</h3>
                                    <div class="rdt-right">
                                        <!-- <div class="rating">
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star-half_alt"></i>
                                    </div> -->
                                        <button class="btn btn-primary" ng-click="booking(item, 'room')">Booking Now</button>
                                        <!-- <a href="#">Booking Now</a> -->
                                    </div>
                                </div>
                                <h2>Rp. {{item.price}}<span>/Pernight</span></h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="r-o">Size:</td>
                                            <td>{{item.ukuran}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Capacity:</td>
                                            <td>{{item.kapasitas}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Bed:</td>
                                            <td>{{item.bad}}</td>
                                        </tr>
                                        <tr>
                                            <td class="r-o">Services:</td>
                                            <td>{{item.service}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8" ng-show="setView=='Biodata'">
                    <div class="col-lg-12">
                        <h3>Contact Info</h3>
                        <br>
                        <form ng-submit="next()">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap:</label>
                                        <input type="text" class="form-control" ng-model="model.biodata.nama">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Jenis Kalamin:</label>
                                        <div class="form-group">
                                            <select class="form-control" style="width: 100% !important;" ng-model="model.biodata.gender">
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Phone:</label>
                                        <input type="text" class="form-control" ng-model="model.biodata.telp">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Email:</label>
                                        <input type="text" class="form-control" ng-model="model.biodata.email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Alamat:</label>
                                        <textarea class="form-control" rows="3" ng-model="model.biodata.alamat"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-info pull-right">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Stay</h3>
                        <div class="form-group">
                            <label for="">Check In:</label>
                            <input type="date" class="form-control" readonly ng-model="model.checkin">
                        </div>
                        <div class="form-group">
                            <label for="">Check Out:</label>
                            <input type="date" class="form-control" readonly ng-model="model.checkout">
                        </div>
                        <div class="form-group" ng-show="model.nama">
                            <label for="">Jenis Kamar:</label>
                            <input type="text" class="form-control" readonly ng-model="model.nama">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>