<?php if (!empty($article->errors)) : ?>
  <ul>
    <?php foreach ($article->errors as $error) : ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="post" class="stack">
  <div class="sidebar">
    <div class="stack">
      <label for=" title">Title</label>
      <input class="space-stack:element-small" name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($article->title); ?>">
    </div>
    <div class="[ stack ][ space-stack:composition ]">
      <label for="published_at">Publication date and time</label>
      <input class="space-stack:element-small" type="datetime-local" name="published_at" id="published_at" value="<?= htmlspecialchars($article->published_at); ?>">
    </div>
  </div>
  <div class="[ stack ][ space-stack:composition ]">
    <label for="content">Content</label>
    <textarea class="space-stack:element-small" name="content" rows="4" cols="40" id="content" placeholder="Article content"><?= htmlspecialchars($article->content); ?></textarea>
  </div>
  <button class="space-stack:composition">Save</button>
</form>