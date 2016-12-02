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
        <div class="col-md-1">
            <?php if ($prod_img) { ?>
                <?php for ($i = 0; $i < count($prod_img); $i++) { ?>

                    <img class="img img-thumbnail thumb" src="/web/uploads/thumbnail/<?php echo $prod_img[$i]["filename"] ?>" />
                    <?php
                }
            } else {
                ?>

            <?php } ?>

        </div>
        <div class="col-md-7">
            <?php if ($prod_img[0]["filename"] != NULL) { ?>
            <img class="img img-thumbnail show-me" src="/web/uploads/thumbnail/medium/<?php echo $prod_img[0]["filename"] ?>" />
            <?php } else { ?> 
                Seems there´s no uploaded images yet
            <?php } ?>
        </div>
        <div class="col-md-4">
            <?php echo $product["shopify_link"]; ?>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="col-md-1">

        </div>
        <div class="col-md-7">
            <table class="table table-hover">
                <tr class="text-center">
                    <th class="text-center" width="33.3%">Size</th>
                    <th class="text-center" width="33.3%">Chest (Inches / cm)</th>
                    <th class="text-center" width="33.3%">Length (Inches / cm)</th>
                </tr>
                <?php
                if (count($prod_size) > 0) {
                    for ($i = 0; $i < count($prod_size); $i++) {?>
                <tr>
                    <td><?php echo $prod_size[$i]["size"]; ?></td>
                    <td><?php echo $prod_size[$i]["chest"]; ?></td>
                    <td><?php echo $prod_size[$i]["length"]; ?></td>
                </tr>
                    <?php
                    }
                }
                ?>
            </table>
        </div>
        <div class="col-md-4">
            <p class="text">

            </p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container-fluid big-bg">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <div class="text text-left" style="margin-top: 50px;">
                <?php
                if (strlen($product["prod_desc"]) > 0) {
                    echo $product["prod_desc"];
                }
                ?>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>