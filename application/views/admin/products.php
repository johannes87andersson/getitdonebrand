<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-left">Samtliga produkter</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <?php
                        if ($products) {
                            foreach ($products as $key => $val) {
                                ?>
                                <li class="list-group-item"><a href="#" class="load_product" id="<?php echo $val["prod_id"] ?>"><?php echo $val["prod_name"]; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-left">Redigera denna produkt</h3>
                </div>
                <div class="panel-body text text-left">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="prod_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="prod_price" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="prod_shopify_link" style="resize: vertical;" placeholder="Shopify link"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="prod-images">
                                <div class="prod-img">
                                    <input id="file1" type="file" />
                                    <div class="prod-text">Upload Image</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default save-product-cred" id="">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <div class="text text-right">
                <a class="btn btn-warning">Skapa</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>