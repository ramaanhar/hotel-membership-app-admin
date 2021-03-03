<!-- Begin Page Content -->
<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fas fa-fw fa-users mr-2"></i>
        <?= $title; ?>
    </h1>
    <?= $this->session->flashdata('message') ?>
    <div class="row ml-0">
        <a href="<?= base_url('admin/addmember'); ?>" class="btn btn-primary btn-lg">
            <i class="fas fa-user-plus"></i>
            Add New Member
        </a>
    </div>
    <div class="row">
        <div class="col-lg mt-3">

            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
            <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of members:</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive mydatatable">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Member ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1 ?>
                            <?php foreach ($member as $m) : ?>
                                <tr>
                                    <th scope="row"><?= $x; ?></th>
                                    <td><?= $m['iduser']; ?></td>
                                    <td><?= $m['name']; ?></td>
                                    <td><?= $m['email']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="<?= '#' . $m['username'] . 'editMemberModal' ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="<?= '#' . $m['username'] . 'deleteMemberModal' ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php $x++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php foreach ($member as $m) : ?>
    <!-- Edit User data Modal -->
    <div class="modal fade" id="<?= $m['username'] . 'editMemberModal'; ?>" tabindex="-1" role="dialog" aria-labelledby="editMemberModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMemberModalTitle">Edit user data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editmember') ?>" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="iduser">Member ID</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="iduser" name="iduser" value="<?= $m['iduser']; ?>" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="name">Full name</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= $m['name']; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="nik">Citizen ID card number</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="nik" name="nik" value="<?= $m['nik_ktp']; ?>" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="address">Address</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control form-control-user" id="address" name="address"><?= $m['address']; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="gender">Gender</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="gender" name="gender" value="<?= $m['gender']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="phone">Phone number</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="phone" name="phone" value="<?= $m['phone']; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= $m['email'] ?>" readonly>
                                </div>
                                <!-- <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?> -->
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete member Modal -->
    <div class="modal fade" id="<?= $m['username'] . 'deleteMemberModal'; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteMemberModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMemberModalTitle">Delete member data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/deletemember') ?>" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p class="text-center"> Are you sure to delete this member data? </p>
                            <div class="row">
                                <div class="col-lg-4">
                                    Member ID :
                                </div>
                                <div class="col-lg-8">
                                    <?= $m['iduser']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Name :
                                </div>
                                <div class="col-lg-8">
                                    <?= $m['name']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Email :
                                </div>
                                <div class="col-lg-8">
                                    <?= $m['email']; ?>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" class="form-control form-control-user" id='iduser' name='iduser' value="<?= $m['iduser'] ?>" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<!-- End of Main Content -->