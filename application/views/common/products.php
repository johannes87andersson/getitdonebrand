<div class="container" style="position: relative;">
    <div class="row">
        <div class="col-md-12">
            <?php if ($products) {
                foreach ($products as $key => $val) {
                    ?>
                    <div class="product">
                        <a href="/common/store/<?php echo str_replace(array(" "), array("-"), strtolower($val["prod_name"])); ?>">
                            <img class="hover-product img-thumbnail img-responsive" src="<?php echo $val["img"] ?>" alt="Responsive image" />
                        </a>
                        <div class="text lead product-text"><?php echo $val["prod_name"]; ?> <b><?php echo $val["prod_price"]; ?> <span class="price">SEK</span></b></div>
                    </div>
                <?php }
            }
            ?>

        </div>
        <div class="clearfix"></div>
    </div>
</div>