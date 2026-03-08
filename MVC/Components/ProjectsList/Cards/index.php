<?php
/** @var \Modules\Main\BaseComponent $this */

if (empty($this->params['items']))
{
    return;
}
?>


<div class="projects">
    <div class="tags-filter"></div>

    <div class="projects-grid">
        <?php foreach ($this->params['items'] as $item): ?>
            <?php  ?>
            <article class="project-card" data-tags="<?= implode(' ', $item['tags']); ?>">
                <div class="card-inner">
                    <div class="card-media">
                        <img src="<?= $item['icon_src'] ?>" alt="<?= $item['title'] ?>" loading="lazy">
                    </div>
                    <div class="card-content">
                        <h3 class="card-title"><?= $item['title'] ?></h3>
                        <p class="card-preview"><?= $item['preview_text'] ?></p>
                        <?php if(true): ?>
                            <div class="card-tags">
                                <?php foreach ($item['tags'] as $tag): ?>
                                    <span class="tag"><?= $tag ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if(count($item['links'])): ?>
                            <div class="card-links">
                                <?php foreach ($item['links'] as $link): ?>
                                    <a href="<?= $link['url'] ?>" class="btn-demo" target="_blank"><?= $link['title'] ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>