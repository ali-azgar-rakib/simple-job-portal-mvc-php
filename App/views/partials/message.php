<?php

use Framework\Session; ?>
<?php $message = Session::getFlushMessage('success_message');  ?>
<?php if ($message !== null): ?>
  <div class="message bg-green-100 p-3 my-3">
    <?= $message ?>
    <?php $message = null; ?>
  </div>
<?php endif; ?>
