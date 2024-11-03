<h1>File manager</h1>

<?php foreach ($list as $file):
    if ($file != '.' && $file != '..') : ?>
        <div class="item">
            <a href="/images/<?= $file ?>" target="_blank"><?= $file ?></a>
            <div class="actions">
                <a href="/filemanager/delete/<?= urlencode($file) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
            </div>
        </div>
<?php endif;
endforeach; ?>