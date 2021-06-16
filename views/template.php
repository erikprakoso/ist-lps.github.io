<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendors/iconly/bold.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendors/fontawesome/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/app.css">
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>images/favicon.svg" type="image/x-icon">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>vendors/simple-datatables/style.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <!-- <a href="index.html"><img src="<?= base_url('assets/'); ?>images/logo/logo.png" alt="Logo" srcset=""></a> -->
                            <h3><?= $title; ?></h3>
                            <span class="badge bg-primary"><?= $this->session->userdata('name'); ?></span>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?php echo active_link('dashboard') ?> ">
                            <a href="<?= base_url('dashboard'); ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php echo active_link('sharepoint') ?>">
                            <a href="<?= base_url('sharepoint'); ?>" class='sidebar-link'>
                                <i class="bi bi-building"></i>
                                <span>SharePoint</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?php echo active_link('user') ?>">
                            <a href="<?= base_url('user'); ?>" class='sidebar-link'>
                                <i class="bi bi-person"></i>
                                <span>User</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="<?= base_url('logout'); ?>" class='sidebar-link'>
                                <!-- <i class="bi bi-cash"></i> -->
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">

            <?php $this->load->view($main_view); ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; POC LPS</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart" style="color: #FF7F50;"></i></span> by ist.id - SOA Developer</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url('assets/'); ?>vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets/'); ?>vendors/apexcharts/apexcharts.js"></script>
    <script src="<?= base_url('assets/'); ?>js/pages/dashboard.js"></script>

    <script src="<?= base_url('assets/'); ?>js/main.js"></script>
    <script src="<?= base_url('assets/'); ?>vendors/fontawesome/all.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendors/jquery/jquery.min.js"></script>

    <script src="<?= base_url('assets/'); ?>vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script type="text/javascript">
        var table;
        $(document).ready(function() {

            //datatables
            table = $('#table').DataTable({

                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo site_url('user/get_data_user') ?>",
                    "type": "POST"
                },


                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

        });
    </script>
</body>

</html>