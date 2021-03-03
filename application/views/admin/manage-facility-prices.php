<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fas fa-fw fa-tags mr-2"></i>
        <?= $title; ?>
    </h1>

    <?= $this->session->flashdata('message') ?>
    <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addFacilityPriceModal">
        <i class="fas fa-plus"></i>
        Add New Facility Price
    </a>
    <div class="card shadow mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of facility prices:</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover table-responsive mydatatable" id="facilitiesTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Facility Price ID</th>
                        <th scope="col">Facility Name</th>
                        <th scope="col">Rate per Hour</th>
                        <th scope="col">Rate per Packet</th>
                        <th scope="col">Start date</th>
                        <th scope="col">End date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x = 1 ?>
                    <?php foreach ($facilityprices as $fp) : ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $fp['idfacilitiesprice']; ?></td>
                            <td>
                                <?php foreach ($facilities as $f) : ?>
                                    <?php if ($f['idfacilities'] == $fp['idfacilities']) : ?>
                                        <?= $f['namefacilities']; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td><?= $fp['rateperhour']; ?></td>
                            <td><?= $fp['rateperpackage']; ?></td>
                            <td><?= $fp['startdate']; ?></td>
                            <td><?= $fp['enddate']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editFacilityPriceNo<?= $fp['idfacilitiesprice']; ?>">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteFacilityPriceNo<?= $fp['idfacilitiesprice']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php $x++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal add facility price, UDAH BENER!! -->
    <div class="modal fade" id="addFacilityPriceModal" tabindex="-1" role="dialog" aria-labelledby="addFacilityPriceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFacilityPriceModalTitle">Add new facility price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('admin/addfacilityprice'); ?>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="idfacilities">Facility ID</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" id="idfacilities" name="idfacilities" value="<?= set_value('idfacilities') ?>">
                                <option id="idfacilities" name="idfacilities" selected="selected" value="">Select a facility...</option>
                                <?php foreach ($facilities as $f) : ?>
                                    <option id="idfacilities" name="idfacilities" value="<?= $f['idfacilities']; ?>"><?= $f['idfacilities'] . " - " . $f['namefacilities']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="rateperhour">Rate per hour</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-user" id="rateperhour" name="rateperhour" value="<?= set_value('rateperhour') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="rateperpackage">Rate per package</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-user" id="rateperpackage" name="rateperpackage" value="<?= set_value('rateperpackage') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="startdate">Start date</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <input placeholder="Enter start date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="startdate" name="startdate" value="<?= set_value('startdate') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="enddate">End date</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <input placeholder="Enter end date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="enddate" name="enddate" value="<?= set_value('enddate') ?>">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add New Facility Price</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($facilityprices as $fp) : ?>
        <!-- Modal untuk Edit Price -->
        <div class="modal fade" id="editFacilityPriceNo<?= $fp['idfacilitiesprice']; ?>" tabindex="-1" role="dialog" aria-labelledby="editFacilityPrice" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFacilityPriceLabel">Edit Facility Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/editfacilityprice') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="idfacilitiesprice">Facility Price ID</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-user" id="idfacilitiesprice" name="idfacilitiesprice" value="<?= $fp['idfacilitiesprice']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="idfacilities">Facility ID</label>
                                </div>
                                <div class="col-lg-9">
                                    <select class="form-control" id="idfacilities" name="idfacilities" value="<?= $fp['idfacilities'] ?>">
                                        <?php foreach ($facilities as $f) : ?>
                                            <?php if ($f['idfacilities'] == $fp['idfacilities']) : ?>
                                                <option selected="selected" id="idfacilities" name="idfacilities" value="<?= $f['idfacilities']; ?>">
                                                    <?= $f['idfacilities'] . " - " . $f['namefacilities']; ?>
                                                </option>
                                            <?php else : ?>
                                                <option id="idfacilities" name="idfacilities" value="<?= $f['idfacilities']; ?>">
                                                    <?= $f['idfacilities'] . " - " . $f['namefacilities']; ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="rateperhour">Rate per hour</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-user" id="rateperhour" name="rateperhour" value="<?= $fp['rateperhour']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="rateperpackage">Rate per package</label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control form-control-user" id="rateperpackage" name="rateperpackage" value="<?= $fp['rateperpackage'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="startdate">Start date</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input placeholder="Enter start date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="startdate" name="startdate" value="<?= $fp['startdate']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label for="enddate">End date</label>
                                </div>
                                <div class="col-lg-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                        <input placeholder="Enter end date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="enddate" name="enddate" value="<?= $fp['enddate']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Edit Price -->

        <!-- Modal untuk Delete Price -->
        <div class="modal fade" id="deleteFacilityPriceNo<?= $fp['idfacilitiesprice']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteFacilityPrice" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteFacilityPriceLabel">Delete Facility Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/deletefacilityprice') ?>" method="post">

                        <div class="modal-body">
                            <!-- Yang dipersiapkan sebelum masuk ke menu delete facilities price: -->
                            <!-- 1. Input yg berisi idfacilitiesprice dan bersifat hidden -->
                            <!-- 2. Query SQL baru untuk mengambil nama fasilitas -->
                            <input type="hidden" id="idfacilitiesprice" name="idfacilitiesprice" value="<?= $fp['idfacilitiesprice']; ?>">
                            <?php
                            $idfacilities = $fp['idfacilities'];
                            $nameFilter = $this->db->query(
                                "SELECT namefacilities  
                                FROM facilities   
                                JOIN facilities_price  
                                ON `facilities`.`idfacilities` = `facilities_price`.`idfacilities`
                                WHERE `facilities`.`idfacilities` = $idfacilities
                                "
                            )->row_array();
                            $name = $nameFilter['namefacilities']
                            ?>


                            <p class="text-center">Are you sure to delete this facility price?</p>
                            <div class="row">
                                <div class="col-lg-4">
                                    Facility Price ID
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-7">
                                    <?= $fp['idfacilitiesprice']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Facility ID
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-7">
                                    <?= $fp['idfacilities']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Facility Name
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-7">
                                    <?= $name; ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhir Modal Edit Price -->
    <?php endforeach; ?>


</div>