<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Mata Kuliah</h3>
                <!-- <p class="text-subtitle text-muted">For user to check they list</p> -->
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Mata Kuliah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Mata Kuliah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php if ($this->session->flashdata('info')) : ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('info'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                                <div class="form-group">
                                    <label for="matkul-id">Matkul ID</label>
                                    <input type="text" disabled name="matkul_id" value="<?php echo set_value('matkul_id', $matkul->matkul_id) ?>" id="matkul-id" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama-materi">Nama Materi</label>
                                    <input type="text" value="<?php echo set_value('nama_materi', $matkul->nama_materi) ?>" name="nama_materi" id="nama-materi" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal-pengajaran">Tanggal Pengajaran</label>
                                    <input type="text" value="<?php echo set_value('tanggal_pengajaran', $matkul->tanggal_pengajaran) ?>" name="tanggal_pengajaran" id="tanggal-pengajaran" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="monitoring">Hasil Monitoring</label>
                                    <input type="file" name="monitoring" id="monitoring" class="form-control">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Foto</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-body">
                                <img src="<?php echo base_url('assets/images/') . $matkul->hasil_monitoring; ?>" width="100%" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>