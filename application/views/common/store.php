<div class="container" style="position: relative;">
    <div class="row">
        <div class="col-md-1">
            <?php for($i = 0; $i < count($prod_img); $i++) {?>
                
            <img width="100%" class="img img-thumbnail thumb" src="/web/uploads/thumbnail/<?php echo $prod_img[$i]["filename"]?>" />
            <?php } ?>
        </div>
        <div class="col-md-7">
            <img width="100%" class="img img-thumbnail show-me" src="/web/uploads/<?php echo $prod_img[0]["filename"]?>" />
        </div>
        <div class="col-md-4">
            <?php echo $product["shopify_link"];?>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="col-md-1">

        </div>
        <div class="col-md-7">
            <table class="table table-hover">
                <tr class="text-center">
                    <th class="text-center" width="33.3%">Size</th>
                    <th class="text-center" width="33.3%">Chest (Inches)</th>
                    <th class="text-center" width="33.3%">Length (Inches)</th>
                </tr>
                <tr>
                    <td>M</td>
                    <td>2</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>L</td>
                    <td>2</td>
                    <td>3</td>
                </tr>
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
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <p class="text" style="color: white; margin-top: 50px;">
                tes textmfgdkfgnmdfmgdfgkmdfgdfkgd <br />
                tes textmfgdkfgnmdfmgdfgkmdfgdfkgd <br />
                tes textmfgdkfgnmdfmgdfgkmdfgdfkgd <br />
                tes textmfgdkfgnmdfmgdfgkmdfgdfkgd <br />
                tes textmfgdkfgnmdfmgdfgkmdfgdfkgd <br />
            </p>
        </div>
    </div>
</div>