<?php
/** @param Navigation $this->params */
$items = $this->params['items'];


/* BUILD PARAMS */
$depth = $prev_depth = $items[0]['depth'];
$level = 0;

/* MAIN MENU */
echo '<div class="sidebar-list">';
for ($i = 0, $len = count($items); $i < $len; ++$i)
{
    $item = $this->params['items'][$i];
    $depth = $item['depth'];

    if ($depth < $prev_depth)
    {
        $level--;
        echo '</div></div></div>';
    }

    if ($i < $len - 1 && $depth < $items[$i + 1]['depth'])
    {
        $level++;
        echo '<div class="sidebar-list__expand">';
    }

    $active = $item['is_active'] ? 'active' : '';
    echo "<a class='sidebar-list__item {$active}' href='{$item['url']}'>{$item['name']}</a>";

    if ($i < $len - 1 && $depth < $items[$i + 1]['depth'])
    {
        echo '<div class="sidebar-list__sublist">';
        echo '<div class="sidebar-list">';
    }

    $prev_depth = $depth;
}

for ($i = 0; $i < $level; ++$i)
{
    echo '</div></div></div>';
}
echo '</div>';
?>