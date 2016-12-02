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

                        <hr />

                        <div class="form-group">
                            <div class="prod-images">
                                <div class="prod-img">
                                    <input id="file1" type="file" />
                                    <div class="prod-text">Upload Image</div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <hr />

                        <div class="form-group text-center">
                            <table class="table table-hover table-bordered" id="product_table">
                                <tr>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Chest (Inches/cm)</th>
                                    <th class="text-center">Length (Inches/cm)</th>
                                </tr>
                            </table>
                            <button class="btn btn-warning pull-right" id="table-create-row">New Row</button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <textarea name="ckeditor_field" class="form-control" id="prod_text"></textarea>
                        </div>

                        <hr />

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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><div id="prod_title">Product Saved</div></h4>
            </div>
            <div class="modal-body">
                <div id="prod_text">Product is successfully saved</div>
            </div>
            <div class="modal-footer">
                <!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>