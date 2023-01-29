angular.module('clientctrl', [])
    // Admin
    .controller('homeController', homeController)
    .controller('bookingController', bookingController)
    ;

function homeController($scope, helperServices) {
    $scope.$emit("SendUp", "Home");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $scope.model={};
    $(".date-input").datepicker({
        minDate: 0,
        dateFormat: 'dd MM, yy'
    });
    // dashboardServices.get().then(res=>{
    //     $scope.datas = res;
    // })
    $scope.nextBooking = ()=>{
        window.localStorage.setItem('booking', JSON.stringify($scope.model));
        window.location.href = helperServices.url + "booking";
    }
}

function bookingController($scope, helperServices, jenisServices, bookingServices, pesan) {
    $scope.$emit("SendUp", "Home");
    $scope.datas = {};
    $scope.title = "Dashboard";
    $scope.model = {};
    $scope.model.biodata = {};
    $scope.setView = "Booking";
    $scope.text = 'Pilih Jenis Kamar';
    var item = JSON.parse(window.localStorage.getItem('booking'));
    $scope.model.checkin = new Date(item.checkin);
    $scope.model.checkout = new Date(item.checkout);
    
    console.log($scope.model);
    jenisServices.get().then(res=>{
        $scope.datas = res;
    })

    $scope.booking = (param, set)=>{
        if(set=='room'){
            $scope.model.jenis_kamar_id = param.id;
            $scope.model.nama = param.nama;
            $scope.setView = 'Biodata';
            $scope.text = 'Pengisian Biodata';
            console.log($scope.model);
        }
    }
    
    $scope.next = ()=>{
        var item = angular.copy($scope.model);
        item.checkin = helperServices.dateToString(item.checkin);
        item.checkout = helperServices.dateToString(item.checkout);
        bookingServices.post(item).then(res=>{
            pesan.dialog("Berasil melakukan booking").then(x=>{
                window.localStorage.removeItem('booking');
                window.location.href = helperServices.url;
            })
        })
    }
}