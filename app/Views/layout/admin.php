<!DOCTYPE html>
<html lang="en" ng-app="apps">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dani Hotel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/admin/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/admin/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="<?= base_url() ?>/assets/admin/images/logo.svg" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?= base_url() ?>/assets/admin/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <?= view('layout/menu')?>
            </nav>
            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">
                    <!-- Content Begin -->
                    <?= $this->renderSection('content') ?>
                    <!-- Content END -->
                </div>


                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script src="<?= base_url() ?>/libs/angular/angular.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.8.2/angular-sanitize.min.js" integrity="sha512-JkCv2gG5E746DSy2JQlYUJUcw9mT0vyre2KxE2ZuDjNfqG90Bi7GhcHUjLQ2VIAF1QVsY5JMwA1+bjjU5Omabw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.30/angular-ui-router.min.js" integrity="sha512-HdDqpFK+5KwK5gZTuViiNt6aw/dBc3d0pUArax73z0fYN8UXiSozGNTo3MFx4pwbBPldf5gaMUq/EqposBQyWQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.min.js" integrity="sha512-jZoujmRqSbKvkVDG+hf84/X11/j5TVxwBrcQSKp1W+A/fMxmYzOAVw+YaOf3tWzG/SjEAbam7KqHMORlsdF/eA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="<?= base_url() ?>/assets/admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>/assets/admin/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/admin/vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>/assets/admin/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/template.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/settings.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url() ?>/assets/admin/js/file-upload.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/typeahead.js"></script>
    <script src="<?= base_url() ?>/assets/admin/js/select2.js"></script>

    <script src="<?= base_url() ?>/js/apps.js"></script>
    <script src="<?= base_url() ?>/js/services/helper.services.js"></script>
    <script src="<?= base_url() ?>/js/services/auth.services.js"></script>
    <script src="<?= base_url() ?>/js/services/admin.services.js"></script>
    <script src="<?= base_url() ?>/js/services/pesan.services.js"></script>
    <script src="<?= base_url() ?>/js/controllers/admin.controllers.js"></script>

    <script src="<?= base_url() ?>/libs/angular-ui-select2/src/select2.js"></script>
    <script src="<?= base_url() ?>/libs/angular-datatables/dist/angular-datatables.js"></script>
    <script src="<?= base_url() ?>/libs/angular-locale_id-id.js"></script>
    <script src="<?= base_url() ?>/libs/input-mask/angular-input-masks-standalone.min.js"></script>
    <script src="<?= base_url() ?>/libs/jquery.PrintArea.js"></script>
    <script src="<?= base_url() ?>/libs/angular-base64-upload/dist/angular-base64-upload.min.js"></script>
    <script src="<?= base_url() ?>/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/btn.js"></script>
    <script src="<?= base_url() ?>/libs/datatables/print.js"></script>
</body>

</html>