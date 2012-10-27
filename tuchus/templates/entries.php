<div id="status-bar">

  <?php if ($flash['success']): ?>
  <div id="flash-msg" class="success">
    <span class="icon">8</span>
    <span class="msg"><?php print $flash['success']; ?></p>
  </div>
  <?php endif ?>

  <?php if ($flash['error']): ?>
  <div id="flash-msg" class="error">
    <span class="icon">c</span>
    <span class="msg"><?php print $flash['error']; ?></p>
  </div>
  <?php endif ?>

  <span class="icon">n</span> Entries <em>in</em> <?php print $path; ?>
</div>

<div id="screen">

  <a href="<?php print $app->urlFor('publish')."?path={$path}&new=true"; ?>" class="btn">New Entry</a>
  <table class="table-list sortable">
    <thead>
      <tr>
        <th>Title</th>
        <th>Slug</th>
        <th>Status</th>
        <?php if ($type == 'date'): ?>
          <th>Date</th>
        <?php elseif ($type == 'number'): ?>
          <th>Number</th>
        <?php endif; ?>
        <th style="width:26px;">View</th>
        <th style="width:26px;">Delete</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($entries as $slug => $entry): ?>
    <?php $status = isset($entry['status']) ? $entry['status'] : 'live'; ?>
      <tr>
        <td class="title"><a href="<?php print $app->urlFor('publish')."?path={$path}/{$slug}"; ?>"><?php print (isset($entry['title']) && $entry['title'] <> '') ? $entry['title'] : Statamic_Helper::prettify($entry['slug']) ?></a></td>
        <td class="slug"><?php print $entry['slug'] ?></td>
        <td class="status status-<?php print $status ?>"><span class="icon">}</span><?php print ucwords($status) ?></td>
        <?php if ($type == 'date') { ?>
          <td><span class="hidden"><?php print date("Y-m-d", @$entry['datestamp']) ?></span><?php print @$entry['date']?></td>
        <?php } else if ($type == 'number') { ?>
          <td><?php print $entry['numeric'] ?></td>
        <?php } ?>
        <td class="action"><div class="page-view"><a href="<?php print $entry['url'] ?>" class="tip" title="View Entry"><span class="icon">M</span></a></div></td>
        <td class="action"><a class="confirm" href="<?php print $app->urlFor('deleteentry')."?path={$path}/{$slug}"; ?>" class="tip" title="Delete Entry"><span class="icon">u</span></a></td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table>

</div>