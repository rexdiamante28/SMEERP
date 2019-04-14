<div class="" id="pageActive" data-num="3"></div>

<?= $breadcrumb; ?>

<?php

    //set values
    $primary = "";
    $company_name = "";
    $company_description = "";
    $company_industry = "";

    if(!$form_empty)
    {
        $primary = en_dec('en',$form_data['id']);
        $company_name = $form_data['name'];
        $company_description = $form_data['description'];
        $company_industry = $form_data['industry'];
    }

?>

<div class="content-container">
    <div class="row">
        <form id="company_form" class="col-6 offset-sm-3" method="post" action="<?= $form_action; ?>">
            <div class="form-group hidden">
                <input type="text" name="primary" id="primary" value="<?= $primary; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input value="<?= $company_name; ?>" type="text" name="company_name" class="form-control">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="company_description" class="form-control"><?= $company_description; ?></textarea>
            </div>
            <div class="form-group">
                <label>Industry</label>
                <select class="form-control" name="company_industry">
                    <option value="">-- Select Industry --</option>
                    <?php
                        foreach ($industries as $industry) {
                            ?>
                                <option <?= $company_industry == $industry['id'] ? 'selected': ''; ?> value="<?= en_dec('en',$industry['id']); ?>"><?= $industry['name']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
        </form>
    </div><br/>
</div>