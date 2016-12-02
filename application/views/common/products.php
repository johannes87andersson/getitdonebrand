<style>
    /* animate menu */
    .menu-main li > a:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: #000;
        visibility: hidden;
        -webkit-transform: scaleX(0);
        transform: scaleX(0);
        -webkit-transition: all 0.3s ease-in-out 0s;
        transition: all 0.3s ease-in-out 0s;
    }
    .menu-main li > a:hover:before {
        visibility: visible;
        -webkit-transform: scaleX(1);
        transform: scaleX(1);
    }
    .menu-main li a {
        color: #000;
    }
</style>
<div class="container" style="position: relative;">
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($products) {
                foreach ($products as $key => $val) {
                    ?>
                    <div class="product">
                        <a href="/common/store/<?php echo str_replace(array(" "), array("-"), strtolower($val["prod_name"])); ?>">
                            <img class="hover-product img-thumbnail img-responsive" src="/web/uploads/thumbnail/small/<?php echo $val["filename"] ?>" alt="No images to show" />
                        </a>
                        <div class="text lead product-text"><?php echo $val["prod_name"]; ?></div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
        <div class="clearfix"></div>
    </div>
</div>