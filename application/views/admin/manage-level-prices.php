<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fas fa-fw fa-money-check-alt mr-2"></i>
        <?= $title; ?>
    </h1>

    <?= $this->session->flashdata('message') ?>
    <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addLevelPriceModal">
        <i class="fas fa-plus"></i>
        Add New Level Price
    </a>
    <div class="card shadow mt-3">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of membership level prices:</h6>
        </div>
        <div class="card-body">
            <table class="table table-hover table-responsive mydatatable" id="levelsTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Level Price ID</th>
                        <th scope="col">Level Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Start date</th>
                        <th scope="col">End date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x = 1 ?>
                    <?php foreach ($levelprices as $lvp) : ?>
                        <tr>
                            <th scope="row"><?= $x; ?></th>
                            <td><?= $lvp['idmembershipprice']; ?></td>
                            <td>
                                <?php foreach ($levels as $lv) : ?>
                                    <?php if ($lv['idmembershiplevel'] == $lvp['idmembershiplevel']) : ?>
                                        <?= $lv['levelname']; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td><?= $lvp['price']; ?></td>
                            <td><?= $lvp['startdate']; ?></td>
                            <td><?= $lvp['enddate']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editLevelPriceNo<?= $lvp['idmembershipprice']; ?>">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteLevelPriceNo<?= $lvp['idmembershipprice']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php $x++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal add level price, UDAH BENER!! -->
    <div class="modal fade" id="addLevelPriceModal" tabindex="-1" role="dialog" aria-labelledby="addLevelPriceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLevelPriceModalTitle">Add new level price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('admin/addlevelprice'); ?>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="idmembershiplevel">Level ID & name</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" id="idmembershiplevel" name="idmembershiplevel" value="<?= set_value('idmembershiplevel') ?>">
                                <option id="idmembershiplevel" name="idmembershiplevel" selected="selected" value="">Select a level...</option>
                                <?php foreach ($levels as $lv) : ?>
                                    <option id="idmembershiplevel" name="idmembershiplevel" value="<?= $lv['idmembershiplevel']; ?>">
                                        <?= $lv['idmembershiplevel'] . " - " . $lv['levelname']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="rateperhour">Price</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control form-control-user" id="price" name="price" value="<?= set_value('price') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label for="startdate">Start date</label>
                        </div>
                        <div class="col-lg-9">
                            <div class="input-group date">
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
                                <input placeholder="Enter end date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="enddate" name="enddate" value="<?= set_value('enddate') ?>">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add New Level Price</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($levelprices as $lvp) : ?>
        <!-- Modal untuk Edit Price -->
        <div class="modal fade" id="editLevelPriceNo<?= $lvp['idmembershipprice']; ?>" tabindex="-1" role="dialog" aria-labelledby="editLevelPrice" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLevelPriceLabel">Edit Level Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/editlevelprice') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="idmembershipprice">Level Price ID</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form-control-user" id="idmembershipprice" name="idmembershipprice" value="<?= $lvp['idmembershipprice']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="idmembershiplevel">Level ID & name</label>
                                </div>
                                <div class="col-lg-8">
                                    <select class="form-control" id="idmembershiplevel" name="idmembershiplevel" value="<?= $lvp['idmembershiplevel'] ?>">
                                        <?php foreach ($levels as $lv) : ?>
                                            <?php if ($lv['idmembershiplevel'] == $lvp['idmembershiplevel']) : ?>
                                                <option selected="selected" id="idmembershiplevel" name="idmembershiplevel" value="<?= $lv['idmembershiplevel']; ?>">
                                                    <?= $lv['idmembershiplevel'] . " - " . $lv['levelname']; ?>
                                                </option>
                                            <?php else : ?>
                                                <option id="idmembershiplevel" name="idmembershiplevel" value="<?= $lv['idmembershiplevel']; ?>">
                                                    <?= $lv['idmembershiplevel'] . " - " . $lv['levelname']; ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="price">Price</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form-control-user" id="price" name="price" value="<?= $lvp['price'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="startdate">Start date</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <input placeholder="Enter start date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="startdate" name="startdate" value="<?= $lvp['startdate']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="enddate">End date</label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input-group date">
                                        <input placeholder="Enter end date (Format: YYYY-MM-DD)" type="text" class="form-control form-control-user datepicker" id="enddate" name="enddate" value="<?= $lvp['enddate']; ?>">
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
        <div class="modal fade" id="deleteLevelPriceNo<?= $lvp['idmembershipprice']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLevelPrice" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLevelPriceLabel">Delete Level Price</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/deletelevelprice') ?>" method="post">

                        <div class="modal-body">
                            <!-- Yang dipersiapkan sebelum masuk ke menu delete facilities price: -->
                            <!-- 1. Input yg berisi idmembershipprice dan bersifat hidden -->
                            <!-- 2. Query SQL baru untuk mengambil nama fasilitas -->
                            <input type="hidden" id="idmembershipprice" name="idmembershipprice" value="<?= $lvp['idmembershipprice']; ?>">



                            <p class="text-center">Are you sure to delete this level price?</p>
                            <div class="row">
                                <div class="col-lg-4">
                                    Level Price ID
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-7">
                                    <?= $lvp['idmembershipprice']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Level ID
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-7">
                                    <?= $lvp['idmembershiplevel']; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    Level Name
                                </div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-7">
                                    <?php foreach ($levels as $lv) : ?>
                                        <?php if ($lv['idmembershiplevel'] == $lvp['idmembershiplevel']) : ?>
                                            <?= $lv['levelname']; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
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