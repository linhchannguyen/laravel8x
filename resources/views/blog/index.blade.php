<ul>
    <?php foreach ($posts->toArray() as $value) { ?>
        <li><?= $value['title'] . ' - ' . $value['description'] ?></li>
    <?php } ?>
</ul>