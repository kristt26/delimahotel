angular.module('adminctrl', [])
    // Admin
    .controller('dashboardController', dashboardController)
    .controller('jenisController', jenisController)
    .controller('kamarController', kamarController)
    .controller('reservasiController', reservasiController)

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
        $scope.jenis = $scope.datas.jenis.find(x=>x.id==item.jenis_kamar_id);
    }
    $scope.delete = (param) => {
        pesan.dialog('Yakin ingin?', 'Ya', 'Tidak').then(res => {
            kamarServices.deleted(param).then(res => {
                pesan.Success("Berhasil menghapus data");
            })
        });
    }
}
function reservasiController($scope, reservasiServices, pesan) {
    $scope.$emit("SendUp", "Data Kamar");
    $scope.datas = {};
    $scope.model = {};
    $scope.statusTabs = "Reservasi";
    reservasiServices.get().then((res) => {
        $scope.reservasi = res.filter(x=>x.status=='Reservasi');
        $scope.inap = res.filter(x=>x.status=='Terisi');
        $scope.kosong = res.filter(x=>x.status=='Kosong');
    })

    $scope.save = () => {
        pesan.dialog('Yakin ingin?', 'Yes', 'Tidak').then(res => {
            reservasiServices.put($scope.model).then(res => {
                if($scope.statusTabs=='Reservasi'){
                    $scope.inap.push(angular.copy($scope.model));
                    var index = $scope.reservasi.indexOf($scope.model);
                    $scope.reservasi.splice(index, 1);
                }else if($scope.statusTabs=='Inap'){
                    $scope.kosong.push(angular.copy($scope.model));
                    var index = $scope.inap.indexOf($scope.model);
                    $scope.inap.splice(index, 1);
                }
                $scope.model = {};
                $('#fasilitas').modal('hide');
                pesan.Success("Berhasil mengubah data");

            })
        })
    }

    $scope.edit = (item) => {
        $scope.model = item;
    }

    $scope.setTabs =(item)=>{
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
