<?php if (isset($_SESSION["success_process"])): ?>
    <div class="alert alert-success" role="alert">
        <?php
        echo $_SESSION["success_process"];
        unset($_SESSION["success_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>                  
<?php elseif (isset($_SESSION["faillure_process"])): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION["faillure_process"];
        unset($_SESSION["faillure_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif (isset($_SESSION["warning_process"])): ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo $_SESSION["warning_process"];
        unset($_SESSION["warning_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif (isset($_SESSION["reset_password_success_process"])): ?>
    <div class="alert alert-success" role="alert">
        <?php
        echo $_SESSION["reset_password_success_process"];
        unset($_SESSION["reset_password_success_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>                  
<?php elseif (isset($_SESSION["reset_password_faillure_process"])): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION["reset_password_faillure_process"];
        unset($_SESSION["reset_password_faillure_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif (isset($_SESSION["reset_password_warning_process"])): ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo $_SESSION["reset_password_warning_process"];
        unset($_SESSION["reset_password_warning_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>