angular.module('admin.service', [])
    // admin
    .factory('dashboardServices', dashboardServices)
    .factory('jenisServices', jenisServices)
    .factory('fasilitasServices', fasilitasServices)
    .factory('kamarServices', kamarServices)
    .factory('reservasiServices', reservasiServices)
    .factory('tambahanServices', tambahanServices)
    .factory('laundryServices', laundryServices)
    .factory('menuServices', menuServices)
    .factory('manajemenUserServices', manajemenUserServices)
    .factory('laporanServices', laporanServices)
    ;

function dashboardServices($http, $q, helperServices, AuthService) {
    var controller = helperServices.url + 'dashboard/';
    var service = {};
    service.data = [];
    service.instance = false;
    return {
        get: get,
        temp: temp,
        getLayanan:getLayanan
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function temp() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: "https://api.openweathermap.org/data/2.5/weather?lat=-2.5757434254081115&lon=140.6866555953247&units=metric&appid=346f18b7fb92963448e318862376a0ba",
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getLayanan() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'get_layanan',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }
}


function jenisServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'jenis/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.ukuran = param.ukuran;
                    data.kapasitas = param.kapasitas;
                    data.bad = param.bad;
                    data.service = param.service;
                    data.price = param.price;
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function fasilitasServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'fasilitas/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'read',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                pesan.Error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.wijk_id);
                if (data) {
                    var item = data.ksp.find(x => x.id == param.id);
                    if (item) {
                        item.ksp = param.ksp;
                    }
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.Error(err.data.messages.error);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.wijk_id);
                if (data) {
                    var index = data.ksp.indexOf(param);
                    data.ksp.splice(index, 1);
                }
                def.resolve(param);
            },
            (err) => {
                def.reject(err);
                pesan.Error(err.data.messages.error);
            }
        );
        return def.promise;
    }

}

function kamarServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'kamar/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.kamar.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                pesan.Error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.wijk_id);
                if (data) {
                    var item = data.ksp.find(x => x.id == param.id);
                    if (item) {
                        item.ksp = param.ksp;
                    }
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.Error(err.data.messages.error);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.wijk_id);
                if (data) {
                    var index = data.ksp.indexOf(param);
                    data.ksp.splice(index, 1);
                }
                def.resolve(param);
            },
            (err) => {
                def.reject(err);
                pesan.Error(err.data.messages.error);
            }
        );
        return def.promise;
    }

}
function reservasiServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'reservasi/';
    var service = {};
    service.data = [];
    return {
        get: get,
        getAdd: getAdd,
        post: post,
        put: put,
        akses:akses,
        deleted: deleted
    };

    function akses(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'akses',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function getAdd() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store_add',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                message.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.status = "Check Out";
                }
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.tamu_id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                message.error(err.data.message)
            }
        );
        return def.promise;
    }

}
function tambahanServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'tambahan/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.ukuran = param.ukuran;
                    data.kapasitas = param.kapasitas;
                    data.bad = param.bad;
                    data.service = param.service;
                    data.price = param.price;
                }
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error)
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function laundryServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'laundry/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.ukuran = param.ukuran;
                    data.kapasitas = param.kapasitas;
                    data.bad = param.bad;
                    data.service = param.service;
                    data.price = param.price;
                }
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error)
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.error(err.data.message)
            }
        );
        return def.promise;
    }

}
function menuServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'menu/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.ukuran = param.ukuran;
                    data.kapasitas = param.kapasitas;
                    data.bad = param.bad;
                    data.service = param.service;
                    data.price = param.price;
                }
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error)
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.error(err.data.message)
            }
        );
        return def.promise;
    }

}
function manajemenUserServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'manajemen_user/';
    var service = {};
    service.data = [];
    return {
        get: get,
        post: post,
        put: put,
        deleted: deleted
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function post(param) {
        var def = $q.defer();
        $http({
            method: 'post',
            url: controller + 'post',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data.push(res.data);
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error);
                def.reject(err);
            }
        );
        return def.promise;
    }

    function put(param) {
        var def = $q.defer();
        $http({
            method: 'put',
            url: controller + 'put',
            data: param,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var data = service.data.find(x => x.id == param.id);
                if (data) {
                    data.nama = param.nama;
                    data.ukuran = param.ukuran;
                    data.kapasitas = param.kapasitas;
                    data.bad = param.bad;
                    data.service = param.service;
                    data.price = param.price;
                }
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.messages.error)
                def.reject(err);
            }
        );
        return def.promise;
    }

    function deleted(param) {
        var def = $q.defer();
        $http({
            method: 'delete',
            url: controller + "/delete/" + param.id,
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                var index = service.data.indexOf(param);
                service.data.splice(index, 1);
                def.resolve(res.data);
            },
            (err) => {
                def.reject(err);
                pesan.error(err.data.message)
            }
        );
        return def.promise;
    }

}

function laporanServices($http, $q, helperServices, AuthService, pesan) {
    var controller = helperServices.url + 'laporan/';
    var service = {};
    service.data = [];
    return {
        get: get,
    };

    function get() {
        var def = $q.defer();
        $http({
            method: 'get',
            url: controller + 'store',
            headers: AuthService.getHeader()
        }).then(
            (res) => {
                service.data = res.data;
                def.resolve(res.data);
            },
            (err) => {
                pesan.error(err.data.message);
                def.reject(err);
            }
        );
        return def.promise;
    }
}
