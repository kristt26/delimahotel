angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('jenisController', jenisController)
    .controller('kamarController', kamarController)
    .controller('reservasiController', reservasiController)
    .controller('tambahanController', tambahanController)
    .controller('laundryController', laundryController)
    .controller('menuController', menuController)
    .controller('addController', addController)
    .controller('manajemenUserController', manajemenUserController)
    .controller('laporanController', laporanController)

    ;

function dashboardController($scope, dashboardServices) {
    $scope.$emit("SendUp", "Dashboard");
    $scope.datas = {};
    $scope.title = "Dashboard";
    // dashboardServices.get().then(res=>{
    //     $scope.datas = res;
    // })
}

function jenisController($scope, jenisServices, pesan, fasilitasServices) {
    $scope.$emit("SendUp", "Jenis Kamar");
    $scope.datas = {};
    $scope.model = {};
    $scope.dataKamar = {};
    jenisServices.get().then((res) => {
        $scope.datas = res;
        console.log(res);
    })

    $scope.setInisial = (item) => {
        $scope.model.inisial = item.substring(0, 3).toUpperCase();
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                jenisServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                jenisServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.saveFasilitas = (item) => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if (item.id) {
                fasilitasServices.put(item).then(res => {
                    $scope.dataKamar = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                fasilitasServices.post(item).then(res => {
                    $scope.dataKamar.fasilitas.push(res);
                    var id = angular.copy($scope.modell.jenis_kamar_id);
                    $scope.modell = {};
                    $scope.modell.jenis_kamar_id = id;
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.setDetail = (item) => {
        $scope.dataKamar = item;
        $scope.modell = {};
        $scope.modell.jenis_kamar_id = item.id;
        console.log($scope.modell);
    }

    $scope.itemFasilitas = (item) => {
        $scope.modell = item;
    }

    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            wijkServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}
function kamarController($scope, kamarServices, pesan) {
    $scope.$emit("SendUp", "Data Kamar");
    $scope.datas = {};
    $scope.model = {};
    kamarServices.get().then((res) => {
        $scope.datas = res;
    })

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                kamarServices.put($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                kamarServices.post($scope.model).then(res => {
                    $scope.model = {};
                    pesan.Success("Berhasil menambah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
        $scope.jenis = $scope.datas.jenis.find(x => x.id == item.jenis_kamar_id);
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            kamarServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}
function reservasiController($scope, reservasiServices, pesan, helperServices) {
    $scope.$emit("SendUp", "Data Kamar");
    $scope.datas = {};
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    reservasiServices.get().then((res) => {
        res.forEach(element => {
            element.lamanya = helperServices.selisih(element.checkin, element.checkout);
            element.total = element.lamanya * parseFloat(element.price);
            element.totalLaundry = 0;
            element.totalMenu = 0;
            element.menu.forEach(menu => {
                element.totalMenu += parseFloat(menu.jumlah) * parseFloat(menu.harga);
            });
            element.laundry.forEach(laundry => {
                element.totalLaundry += parseFloat(laundry.jumlah) * parseFloat(laundry.harga);
            });
        });
        $scope.reservasi = res.filter(x => x.status == 'Check In');
        $scope.inap = res.filter(x => x.status == 'Check Out');
        $scope.kosong = res.filter(x => x.status == 'Kosong');
    })

    $scope.viewDetail = (param) => {
        $scope.model = param;
    }

    $scope.getTotal = (param) => {
        var nilai = 0;
        if (param == 'menu') {
            $scope.model.menu.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        } else if (param == 'laundry') {
            $scope.model.laundry.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        } else {
            $scope.model.menu.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
            $scope.model.laundry.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        }
        return nilai;
    }

    $scope.cek = (cek, param) => {
        $scope.model = param;
        if (cek == 'Cancel')
            $("#akses").modal('show');
        else
            $scope.save();
    }

    $scope.login = (item) => {
        var param = {};
        param.password = item;
        reservasiServices.akses(param).then(x=>{
            $scope.delete($scope.model);
        })
    }
    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.checkout = (item) => {
        pesan.dialog('Yakin ingin check out?', "Ya", "Tidak", 'info').then(x=>{
            reservasiServices.put(item).then(res=>{

            })
        })
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin check out?', 'Yes', 'No').then(res => {
            $.LoadingOverlay("show");
            reservasiServices.put($scope.model).then(res => {
                $scope.inap.push(angular.copy($scope.model))
                var index = $scope.reservasi.indexOf($scope.model);
                $scope.reservasi.splice(index, 1);
                $scope.model = {};
                $.LoadingOverlay("hide");
                pesan.Success("Berhasil mengubah data");

            })
        })
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            reservasiServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}
function tambahanController($scope, tambahanServices, pesan) {
    $scope.$emit("SendUp", "Data Kamar");
    $scope.datas = [];
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    tambahanServices.get().then((res) => {
        $scope.datas = res;
    })

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                tambahanServices.put($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                tambahanServices.post($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = item;
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            tambahanServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}

function laundryController($scope, laundryServices, pesan) {
    $scope.$emit("SendUp", "Data Kamar");
    $scope.datas = [];
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    laundryServices.get().then((res) => {
        $scope.datas = res;
    })

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                laundryServices.put($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                laundryServices.post($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = item;
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            laundryServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}

function menuController($scope, menuServices, pesan) {
    $scope.$emit("SendUp", "Data Menu Makanan");
    $scope.datas = [];
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    menuServices.get().then((res) => {
        $scope.datas = res;
    })

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                menuServices.put($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                menuServices.post($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = item;
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            menuServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}

function manajemenUserController($scope, manajemenUserServices, pesan) {
    $scope.$emit("SendUp", "Data Menu Makanan");
    $scope.datas = [];
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    manajemenUserServices.get().then((res) => {
        $scope.datas = res;
        console.log(res);
    })

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            if ($scope.model.id) {
                manajemenUserServices.put($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            } else {
                manajemenUserServices.post($scope.model).then(res => {
                    $scope.model = {};
                    $('#fasilitas').modal('hide');
                    pesan.Success("Berhasil mengubah data");
                })
            }
        })
    }

    $scope.edit = (item) => {
        $scope.model = item;
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            manajemenUserServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}
function addController($scope, reservasiServices, pesan, helperServices) {
    $scope.$emit("SendUp", "Data Menu Makanan");
    $scope.datas = [];
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    $scope.view = "";
    $scope.itemKamar = {};
    reservasiServices.getAdd().then(res => {
        $scope.datas = res;
        var item = sessionStorage.getItem('biodata');
        if (item) {
            item = JSON.parse(item);
            $scope.model = item;
            $scope.view = item.view;
        }
    })

    $scope.next = (param) => {
        $scope.view = param;
        $scope.itemKamar.menu = [];
        $scope.itemKamar.laundry = [];
        $scope.model.view = param;
        $scope.model.tambahan = [];
        $scope.model.laundry = [];
        $scope.model.menu = [];
        $scope.model.kamar = [];
        $scope.data = {};
        sessionStorage.setItem('biodata', JSON.stringify($scope.model));
    }

    $scope.batal = () => {
        sessionStorage.removeItem('biodata')
        document.location.href = helperServices.url + "reservasi";
    }

    $scope.tambah = (param) => {
        $scope.model.kamar.push(angular.copy(param))
        sessionStorage.setItem('biodata', JSON.stringify($scope.model));
    }

    $scope.setItemLayanan = (param) => {
        $scope.data = angular.copy(param);
        $scope.data.harga = parseFloat($scope.data.harga);
        console.log($scope.data);
    }

    $scope.getTotal = (param) => {
        var nilai = 0;
        if (param == 'kamar') {
            $scope.model.kamar.forEach(element => {
                var selisih = helperServices.selisih(element.checkin, element.checkout);
                nilai += parseFloat(element.price * selisih);
            });
        } else if (param == 'menu') {
            $scope.model.menu.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        } else if (param == 'laundry') {
            $scope.model.laundry.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        } else {
            $scope.model.kamar.forEach(element => {
                var selisih = helperServices.selisih(element.checkin, element.checkout);
                nilai += parseFloat(element.price * selisih);
            });
            $scope.model.menu.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
            $scope.model.laundry.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        }
        return nilai;
    }

    $scope.totalKamar = (param) => {
        return helperServices.selisih(param.checkin, param.checkout) * param.price;
    }

    $scope.addLayanan = (layanan) => {
        console.log();
        if (layanan == 'menu') {
            $scope.model.menu.push(angular.copy($scope.data));
        } else {
            $scope.model.laundry.push(angular.copy($scope.data));
        }
        $scope.setLayanan = [];
        $scope.itemLayanan = "";
        $scope.data = {}
        sessionStorage.setItem('biodata', JSON.stringify($scope.model));
        $("#layananTambahan").modal('hide');
    }

    $scope.hapusLayanan = (layanan, data) => {
        if (layanan == 'menu') {
            var index = $scope.model.menu.indexOf(data);
            $scope.model.menu.splice(index, 1);
        } else {
            var index = $scope.model.laundry.indexOf(data);
            $scope.model.laundry.splice(index, 1);
        }
        data = {}
    }
    
    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            var param = angular.copy($scope.model);
            param.checkin = helperServices.dateTimeToString(new Date($scope.model.checkin));
            param.checkout = helperServices.dateTimeToString(new Date($scope.model.checkout));
            reservasiServices.post($scope.model).then(res => {
                sessionStorage.removeItem('biodata');
                document.location.href = helperServices.url + "/reservasi"
                // $scope.model = {};
                // $('#fasilitas').modal('hide');
                // pesan.Success("Berhasil mengubah data");
            })
        })
    }

    $scope.edit = (item) => {
        $scope.model = item;
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            menuServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }

}

function laporanController($scope, laporanServices, pesan, helperServices) {
    $scope.$emit("SendUp", "Data Kamar");
    $scope.datas = {};
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    laporanServices.get().then((res) => {
        res.forEach(element => {
            element.lamanya = helperServices.selisih(element.checkin, element.checkout);
            element.total = element.lamanya * parseFloat(element.price);
            element.totalLaundry = 0;
            element.totalMenu = 0;
            element.menu.forEach(menu => {
                element.totalMenu += parseFloat(menu.jumlah) * parseFloat(menu.harga);
            });
            element.laundry.forEach(laundry => {
                element.totalLaundry += parseFloat(laundry.jumlah) * parseFloat(laundry.harga);
            });
        });
        $scope.reservasi = res.filter(x => x.status == 'Check In');
        $scope.inap = res.filter(x => x.status == 'Check Out');
        $scope.kosong = res.filter(x => x.status == 'Kosong');
    })

    $scope.viewDetail = (param) => {
        $scope.model = param;
    }

    $scope.getTotal = (param) => {
        var nilai = 0;
        if (param == 'menu') {
            $scope.model.menu.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        } else if (param == 'laundry') {
            $scope.model.laundry.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        } else {
            $scope.model.menu.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
            $scope.model.laundry.forEach(element => {
                nilai += (parseFloat(element.harga) * parseFloat(element.jumlah));
            });
        }
        return nilai;
    }

    $scope.cek = (cek, param) => {
        $scope.model = param;
        if (cek == 'Cancel')
            $("#akses").modal('show');
        else
            $scope.save();
    }

    $scope.login = (item) => {
        var param = {};
        param.password = item;
        laporanServices.akses(param).then(x=>{
            $scope.delete($scope.model);
        })
    }
    $scope.edit = (item) => {
        $scope.model = angular.copy(item);
    }

    $scope.checkout = (item) => {
        pesan.dialog('Yakin ingin check out?', "Ya", "Tidak", 'info').then(x=>{
            laporanServices.put(item).then(res=>{

            })
        })
    }

    $scope.save = () => {
        pesan.dialog('Yakin ingin check out?', 'Yes', 'No').then(res => {
            $.LoadingOverlay("show");
            laporanServices.put($scope.model).then(res => {
                $scope.inap.push(angular.copy($scope.model))
                var index = $scope.reservasi.indexOf($scope.model);
                $scope.reservasi.splice(index, 1);
                $scope.model = {};
                $.LoadingOverlay("hide");
                pesan.Success("Berhasil mengubah data");

            })
        })
    }

    $scope.setTabs = (item) => {
        $scope.statusTabs = item;
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            laporanServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}
