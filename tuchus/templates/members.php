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

  <span class="icon">,</span> Members
</div>

<div id="screen">
  
  <a href="<?php print $app->urlFor('member')."?new=1"; ?>" class="btn">New Member</a>
  <table class="sortable table-list">
    <thead>
      <tr>
        <th>Username</th>
        <th class="web">First Name</th>
        <th class="web">Last Name</th>
        <?php /* ?><th>Role</th><?php */ ?>
        <th style="width:26px;"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($members as $name => $member): ?>
      <tr>
        <td class="title"><a href="<?php print $app->urlFor('member')."?name={$name}"; ?>"><?php print $name; ?></a></td>
        <td class="web"><?php print $member->get_first_name(); ?></td>
        <td class="web"><?php print $member->get_last_name(); ?></td>
        <?php /* ?><td><?php print $member->get_roles_list(); ?></td><?php */ ?>
        <td class="action"><a onclick="return confirm('Are you sure? This cannot be undone.');" href="<?php print $app->urlFor('deletemember')."?name={$name}"; ?>"><span class="icon">u</span></a></td>
      </tr>
      <?php endforeach ?>

    </tbody>
  </table>

</div>