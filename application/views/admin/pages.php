<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-left">Samtliga sidor</h3>
                </div>
                <div class="panel-body">
                    <p class="text">Klicka på den sida du vill redigera</p>
                    <ul class="list-group load-pages-link">
                        <?php foreach ($pages as $key => $val) { ?>
                            <li class="list-group-item"><a load_page="<?php echo $val["page_id"] ?>" href="#"><?php echo $val["page_title"] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-left">Redigera denna sida</h3>
                </div>
                <div class="panel-body">
                    <form>
                        <div class="form-group">
                            <span class="pull-left info-text">[Page title]</span>
                            <input type="text" class="form-control" id="page_title" placeholder="Sidans titel">
                        </div>
                        <div class="form-group">
                            <span class="pull-left info-text">[Keywords, make sure this keywords repeats 4-5 times]</span>
                            <div class="pull-left btn btn-danger btn-xs info-text-btn">Auto genereate [comming soon]</div>
                            <input type="text" class="form-control" id="page_keywords" placeholder="Meta nyckelord">
                        </div>
                        <div class="form-group">
                            <span class="pull-left info-text">[Description describes this page]</span>
                            <input type="text" class="form-control" id="page_description" placeholder="Meta beskrivning">
                        </div>
                        <div class="form-group">
                            <textarea name="ckeditor_field" class="form-control" id="page_text"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default pull-left save-page-cred">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <a class="btn btn-warning pull-left">Ny sida</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>