<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Authentication</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/admin/images/favicon.png" />
    <link rel="stylesheet" href="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.css">
</head>

<body ng-app="appsLogin" ng-controller="ctrlLogin">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="<?= base_url() ?>/assets/admin/images/logo.svg" alt="logo">
                            </div>
                            <h4>Sign in to continue.</h4>
                            <form class="pt-3" ng-submit="login()">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" ng-model="model.username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" ng-model="model.password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <!-- <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div> -->
                                    <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                                </div>
                                <!-- <div class="mb-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="ti-facebook mr-2"></i>Connect using facebook
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ?>/assets/admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>/libs/angular/angular.js"></script>
    <script src="<?= base_url() ?>/js/services/pesan.services.js"></script>

    <script src="<?= base_url() ?>/assets/admin/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/template.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/settings.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/todolist.js"></script>
    <script src="<?= base_url() ?>/libs/loading/dist/loadingoverlay.min.js"></script>

    <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- endinject -->
    <script>
        angular.module("appsLogin", ['message.service'])
            .controller("ctrlLogin", ctrlLogin);

        function ctrlLogin($scope, $q, $http, pesan) {
            $scope.role = [];
            $scope.model = {};
            console.log($scope.model);
            sessionStorage.clear();
            $scope.login = () => {
                $.LoadingOverlay("show");
                var def = $q.defer();
                $http({
                    method: 'POST',
                    url: "<?= base_url() ?>" + "/auth/login",
                    data: $scope.model,
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(res => {
                    if (res) {
                        document.location.href = "<?= base_url() ?>" + "/dashboard";
                        def.resolve(user);
                    }
                }, err => {
                    def.reject(err.data.messages.error);
                    pesan.error(err.data.messages.error);
                    $.LoadingOverlay("hide");
                });
                return def.promise;
            }
            $scope.setRole = (item) => {
                AuthService.setRole(item).then((res) => {
                    document.location.href = helperServices.url;
                })
            }
        }
    </script>
</body>

</html>