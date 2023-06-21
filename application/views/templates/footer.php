<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<form id="delete" method="POST">
    <input type="hidden" name="data_type">
    <input type="hidden" name="data_id">
    <input type="hidden" name="_method" value="DELETE">
</form>
<form id="form-logout" method="POST" action="<?= base_url('logout'); ?>">
    <input type="hidden" name="logout" value="TRUE">
    <input type="hidden" name="_method" value="DELETE">
</form>
<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; <?php echo date('Y') ?>
        <div class="bullet"></div>
        Developed By <a target="_blank" rel="noreferrer" >Amilia</a>
    </div>
    <div class="footer-right">

    </div>
</footer>
</div>
</div>
