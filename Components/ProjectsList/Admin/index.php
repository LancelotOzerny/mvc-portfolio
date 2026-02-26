<?php
/** @var \Modules\Main\BaseComponent $this */

$projects = $this->params['projects'];
?>

<?php if(count($projects)): ?>
<div class="projects-crud-list">
    <?php foreach ($projects as $project): ?>
    <div class="crud-project__wrapper">
        <div class="crud-project">
            <header>
                <p class="crud-project__title text--weight-4">[<?= $project['id'] ?>] <?= $project['title'] ?></p>

                <div class="crud-project__control">
                    <a href="#" class="btn square btn--info icon icon-edit"></a>
                    <a href="#" class="btn square btn--danger icon icon-delete"></a>
                </div>
            </header>

            <div class="crud-project__main">
                <img class="crud-project__icon" src="<?= $project['icon_src'] ?>" alt="Unity Developer Toolkit">
                <div><?= $project['preview_text'] ?></div>
            </div>

            <footer>
                <div class="tags">
                <?php if(isset($project['tags']) && count($project['tags'])): ?>
                    <?php foreach ($project['tags'] as $tag): ?>
                        <span class="tag"><?= $tag ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>

                <p class="text--left"><?= $project['created_at'] ?></p>

                <div class="crud-project__links">
                <?php if(isset($project['links']) && count($project['links'])): ?>
                    <?php foreach ($project['links'] as $link): ?>
                        <a href="<?= $link['url'] ?>" class="btn btn--secondary"><?= $link['title'] ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </footer>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>