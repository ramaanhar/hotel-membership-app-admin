<div class="container-fluid">

    <a href="<?= base_url("admin/managemember") ?>" style="text-decoration: none;">
        <div class="row justify-content-start">
            <div class="col-inline">
                <i class="fas fa-fw fa-arrow-left"></i>
            </div>
            <div class="col-inline ml-3">
                <span>BACK TO MANAGE MEMBER</span>
            </div>
        </div>
    </a>
    <br />
    <h1 class="h3 mb-4 ml-3 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8 ml-3">

            <?= form_open_multipart('admin/addmember'); ?>
            <div class="form-group row">
                <div class="col-lg-3">
                    <label for="name"> Full name </label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= set_value('name') ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3">
                    <label for="nik"> Citizen ID number </label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-user" id="nik" name="nik" value="<?= set_value('nik') ?>">
                    <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3">
                    <label for="address"> Address </label>
                </div>
                <div class="col-lg-9">
                    <textarea class="form-control form-control-user" id="address" name="address"><?= set_value('address') ?></textarea>
                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3">
                    <label for="gender">Gender </label>
                </div>
                <div class="col-sm-9">
                    <div class="row ml-2">
                        <div class="col-sm-6 ml-6">
                            <input type="radio" class="form-check-input" id="gender1" name="gender" value="Male" <?= set_radio('gender', 'Male') ?>>
                            <label class="form-check-label" for="gender1"> Male </label>
                        </div>
                        <div class="col-sm-6 ml-6">
                            <input type="radio" class="form-check-input" id="gender2" name="gender" value="Female" <?= set_radio('gender', 'Female') ?>>
                            <label class="form-check-label" for="gender2"> Female </label>
                        </div>
                    </div>
                    <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3">
                    <label for="phone">Phone number </label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-user" id="phone" name="phone" value="<?= set_value('phone') ?>">
                    <?= form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3">
                    <label for="email">Email address </label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email') ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3">
                    <label for="username">Username </label>
                </div>
                <div class="col-lg-9">
                    <input type="text" class="form-control form-control-user" id="username" name="username" value="<?= set_value('username') ?>">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-5">
                    <label for="password1">Password </label>
                </div>
                <div class="col-lg-7">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-5">
                    <label for="password2">Repeat Password </label>
                </div>
                <div class="col-lg-7">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2">
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#ConfirmModal">
                Register Member Account
            </button>


            <!-- Syntax modal -->
            <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- header modal-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Confirm member data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid text-center">

                                <p>Are you sure to submit this member data and create it into a new account?</p>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            </form>
        </div>
    </div>
</div>



<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->