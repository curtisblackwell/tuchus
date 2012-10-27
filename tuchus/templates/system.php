<div id="status-bar">

  <span class="icon">@</span>System Status</span>
</div>

<div id="screen">
  <h2>System Files Security Check</h2>
  <table class="table-list sortable table-security">
    <thead>
      <tr>
        <th>Folder/File</th>
        <th>Action Required</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($system_checks as $asset => $data): ?>
      <?php extract($data); ?>
      <tr>
        <td class="<?php print $status ?>"><?php print $asset ?></td>
        <td><?php if ($status_code === 200): ?><?php echo $message?><?php else:?><span class="subtle">None</span><?php endif ?></td>
        <td class="status status-<?php print $status ?>"><span class="icon">}</span><?php if ($status_code !== 200): ?>Secure<?php else: ?>Unsecure<?php endif ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>

    <h2>User Accounts Security Check</h2>
  <table class="table-list table-security">
    <thead>
      <tr>
        <th>User File</th>
        <th>Action Required</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $username => $user): ?>
      <?php $status = $user->is_password_encrypted() ? 'good' : 'warning'; ?>
      <tr>
        <td class="title <?php print $status ?>"><a href="member?name=<?php print $username ?>"><?php print $username ?></a></td>
        <td><?php if ($status == 'warning'): ?><em>Encrypt password.</em><?php else:?><span class="subtle">None</span><?php endif ?></td>
        <td class="status status-<?php print $status ?>"><span class="icon">}</span><?php print $status == 'good' ? 'Encrypted' : 'unencrypted' ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>