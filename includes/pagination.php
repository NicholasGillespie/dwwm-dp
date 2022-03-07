<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>


<nav class="space-stack:composition">
  <ul role="list" class="[ cluster ][ justify:space-between ]">
    <?php if ($paginator->previous) : ?>
      <li><a href="<?= $base; ?>?page=<?= $paginator->previous; ?>">previous</a></li>
    <?php else : ?>
      <div></div>
    <?php endif; ?>
    <li>Page <?= $paginator->page; ?> of <?= $paginator->total_pages; ?></li>
    <?php if ($paginator->next) : ?>
      <li><a href="<?= $base; ?>?page=<?= $paginator->next; ?>">next</a></li>
    <?php else : ?>
      <div></div>
    <?php endif; ?>
  </ul>
</nav>