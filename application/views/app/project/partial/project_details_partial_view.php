<h1 id="details_project_name"><?= $project['name']; ?></h1>
<h4 id="details_project_category"><?= $project['category_string']; ?></h4>
<h4 id="details_project_status"><span class="badge badge-default" style="background-color:<?= $project['color_code'] ?> !important;"><?= $project['status_name']; ?></span></h4>
<h4 id="details_project_progress">
    <div class="progress">
      <div class="progress-bar bg-info" role="progressbar" style="width: <?= $project['progress']; ?>%;" aria-valuenow="<?= $project['progress']; ?>" aria-valuemin="0" aria-valuemax="100"><?= $project['progress']; ?>%</div>
    </div>
</h4>