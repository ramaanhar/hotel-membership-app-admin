<!-- Begin Page Content -->
<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fas fa-fw fa-spa mr-2"></i>
        <?= $title; ?>
    </h1>
    <?= $this->session->flashdata('message') ?>
    <div class="row ml-0">
        <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addFacilityModal">
            <i class=" fas fa-plus"></i>
            Add New Facility
        </a>
    </div>
    <div class="row">
        <div class="col-lg mt-3">
            <?= form_error('namefacilities', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of facilities:</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive mydatatable" id="facilitiesTable">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Facility ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1 ?>
                            <?php foreach ($facilities as $f) : ?>
                                <tr>
                                    <th scope="row"><?= $x; ?></th>
                                    <td><?= $f['idfacilities']; ?></td>
                                    <td><?= $f['namefacilities']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="<?= '#the' . $f['idfacilities'] . 'editFacilityModal' ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="<?= '#the' . $f['idfacilities'] . 'deleteFacilityModal' ?>">Delete</button>
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

<?php foreach ($facilities as $f) : ?>
    <!-- Edit facility data Modal -->
    <div class="modal fade" id="<?= 'the' . $f['idfacilities'] . 'editFacilityModal'; ?>" tabindex="-1" role="dialog" aria-labelledby="editFacilityModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFacilityModalTitle">Edit facility data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editfacility') ?>" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="idfacilities">Facility ID</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="idfacilities" name="idfacilities" value="<?= $f['idfacilities']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="name">Facility name</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-user" id="namefacilities" name="namefacilities" value="<?= $f['namefacilities']; ?>">

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
    <div class="modal fade" id="<?= 'the' . $f['idfacilities'] . 'deleteFacilityModal'; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteFacilityModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFacilityModalTitle">Delete facility data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/deletefacility') ?>" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <p class="text-center"> Are you sure to delete this facility data? </p>
                            <div class="row">
                                <div class="col-lg-4">
                                    Facility ID :
                                </div>
                                <div class="col-lg-8">
                                    <?= $f['idfacilities']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Facility name :
                                </div>
                                <div class="col-lg-8">
                                    <?= $f['namefacilities']; ?>
                                </div>
                            </div>

                        </div>


                        <input type="hidden" class="form-control form-control-user" id='idfacilities' name='idfacilities' value="<?= $f['idfacilities'] ?>" readonly>
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
<div class="modal fade" id="addFacilityModal" tabindex="-1" role="dialog" aria-labelledby="addFacilityModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacilityModalTitle">Add new facility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('admin/addfacility'); ?>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label for="name"> Facility name</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-user" id="namefacilities" name="namefacilities" value="<?= set_value('namefacilities') ?>">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add New Facility</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->