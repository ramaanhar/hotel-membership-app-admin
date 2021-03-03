<div class="container-fluid">


    <h1 class="h3 mb-4 text-gray-800">Welcome Admin <?= $user['name']; ?></h1>
    <?= $this->session->flashdata('message') ?>

    <?php
    $idmenu = '1';
    $querySubMenu = "select *
                    from `usermenu` join `roles`
                    on `usermenu`.`idrole` = `roles`.`idrole`
                    where `usermenu`.`idrole` = $idmenu
                    and `usermenu`.`isactive` = 1 
";
    $subMenu = $this->db->query($querySubMenu)->result_array();

    ?>
    <div class="row no-gutters">

        <?php foreach ($subMenu as $sm) : ?>
        <a href="<?= base_url($sm['url']); ?>" class="col-lg-3 mb-2 mr-2" style="color: white; text-decoration: none;">
            <div class="card text-white bg-gradient-danger">
                <div class="card-body text-center">
                    <i class="<?= $sm['icon'] ?> fa-5x mb-3"></i>
                    <h5 class="card-title"><?= $sm['title']; ?></h5>
                </div>
            </div>
        </a>

        <?php endforeach; ?>
    </div>



</div>
</div>