<!-- Begin Page Content -->
<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fas fa-fw fa-spa mr-2"></i>
        <?= $title; ?>
    </h1>
    <?= $this->session->flashdata('message') ?>
    <div class="row ml-0">
        <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addLevelModal">
            <i class=" fas fa-plus"></i>
            Add New Level
        </a>
    </div>
    <div class=" row">
        <div class="col-lg mt-3">
            <?= form_error('levelname', '<small class="text-danger pl-3">', '</small>'); ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of membership levels:</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive mydatatable" id="levelTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Level ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1 ?>
                            <?php foreach ($levels as $lv) : ?>
                                <tr>
                                    <th scope="row"><?= $x; ?></th>
                                    <td><?= $lv['idmembershiplevel']; ?></td>
                                    <td><?= $lv['levelname']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="<?= '#the' . $lv['idmembershiplevel'] . 'editLevelModal' ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="<?= '#the' . $lv['idmembershiplevel'] . 'deleteLevelModal' ?>">Delete</button>
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
</div>


</div>
</div>

</div>
<!-- /.container-fluid -->

<?php foreach ($levels as $lv) : ?>
    <!-- Edit facility data Modal -->
    <div class="modal fade" id="<?= 'the' . $lv['idmembershiplevel'] . 'editLevelModal'; ?>" tabindex="-1" role="dialog" aria-labelledby="editLevelModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLevelModalTitle">Edit level data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editlevel') ?>" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="idmembershiplevel">Level ID</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="idmembershiplevel" name="idmembershiplevel" value="<?= $lv['idmembershiplevel']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="levelname">Level name</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="levelname" name="levelname" value="<?= $lv['levelname']; ?>">

                                </div>
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

    <!-- Delete facility Modal -->
    <div class="modal fade" id="<?= 'the' . $lv['idmembershiplevel'] . 'deleteLevelModal'; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLevelModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLevelModalTitle">Delete level data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/deletelevel') ?>" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p class="text-center"> Are you sure to delete this level data? </p>
                            <div class="row">
                                <div class="col-lg-4">
                                    Level ID :
                                </div>
                                <div class="col-lg-8">
                                    <?= $lv['idmembershiplevel']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Name :
                                </div>
                                <div class="col-lg-8">
                                    <?= $lv['levelname']; ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control form-control-user" id='idmembershiplevel' name='idmembershiplevel' value="<?= $lv['idmembershiplevel'] ?>" readonly>
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

<!-- Add facility Modal -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addLevelModal" tabindex="-1" role="dialog" aria-labelledby="addLevelModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLevelModalTitle">Add new level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('admin/addlevel'); ?>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label for="levelname">Level name</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-user" id="levelname" name="levelname" value="<?= set_value('levelname'); ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add New Level</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->