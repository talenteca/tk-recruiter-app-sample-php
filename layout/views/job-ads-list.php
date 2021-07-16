<table>
  <thead>
    <tr>
      <th>Job Ad ID</th>
      <th>Title</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($job_ads as $job_ad_id => $job_ad): ?>
    <tr>
      <td>
        <?=$job_ad_id?>
      </td>
      <td>
        <?=$job_ad['title']?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
