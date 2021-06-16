<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User</h3>
                <!-- <p class="text-subtitle text-muted">For user to check they list</p> -->
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                List User
                <div style="float: right;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        + Add
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        + Upload
                    </button>
                </div>
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #FF7F50;">
                                <h5 class="modal-title" id="addModalLabel" style="color: white;">Add User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('user/insert'); ?>" method="POST">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label for="fullname">Fullname</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailaddress">Email Address</label>
                                            <input type="text" class="form-control" id="emailaddress" name="emailaddress">
                                        </div>
                                        <div class="form-group">
                                            <label for="identitynumber">Identity Number</label>
                                            <input type="text" class="form-control" id="identitynumber" name="identitynumber">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthdate">Birth Date</label>
                                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #FF7F50;">
                                <h5 class="modal-title" id="uploadModalLabel" style="color: white;">Upload User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('user/upload'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="select_file">Upload File</label>
                                            <input class="form-control" type="file" id="select_file" name="select_file">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($this->session->flashdata('info')) : ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $this->session->flashdata('info'); ?>
                </div>
            <?php elseif ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('info'); ?>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Identity Number</th>
                            <th>Address</th>
                            <th>Birth Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($items as $i) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $i['username']; ?></td>
                                <td><?= $i['fullname']; ?></td>
                                <td><?= $i['emailaddress']; ?></td>
                                <td><?= $i['identitynumber']; ?></td>
                                <td><?= $i['address']; ?></td>
                                <td><?= $i['birthdate']; ?></td>
                                <td>
                                    <!-- Button trigger modal View -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?= $i['username']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Button trigger modal View -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal<?= $i['username']; ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <!-- Button trigger modal Delete -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $i['username']; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Modal View -->
                            <div class="modal fade" id="viewModal<?= $i['username']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel">View <?= $i['username']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input type="text" class="form-control" id="username" name="username" value="<?= $i['username']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fullname">Fullname</label>
                                                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $i['fullname']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="emailaddress">Email Address</label>
                                                            <input type="text" class="form-control" id="emailaddress" name="emailaddress" value="<?= $i['emailaddress']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="identitynumber">Identity Number</label>
                                                            <input type="text" class="form-control" id="identitynumber" name="identitynumber" value="<?= $i['identitynumber']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly><?= $i['address']; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="birthdate">Birth Date</label>
                                                            <input type="text" class="form-control" id="birthdate" name="birthdate" value="<?= $i['birthdate']; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal<?= $i['username']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit <?= $i['username']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('user/update'); ?>" method="POST">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" value="<?= $i['username']; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fullname">Fullname</label>
                                                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $i['fullname']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emailaddress">Email Address</label>
                                                        <input type="text" class="form-control" id="emailaddress" name="emailaddress" value="<?= $i['emailaddress']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="identitynumber">Identity Number</label>
                                                        <input type="text" class="form-control" id="identitynumber" name="identitynumber" value="<?= $i['identitynumber']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3"><?= $i['address']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="birthdate">Birth Date</label>
                                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= $i['birthdate']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal<?= $i['username']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?= base_url('user/delete'); ?>" method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete <?= $i['username']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are your sure?</p>
                                            </div>
                                            <input type="hidden" name="username" id="username" value="<?= $i['username']; ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>