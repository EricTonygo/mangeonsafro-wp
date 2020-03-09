<?php if (isset($_SESSION["activation_success_process"])): ?>
    <div class="alert alert-success" role="alert">
        <?php
        echo $_SESSION["activation_success_process"];
        unset($_SESSION["activation_success_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>                  
<?php elseif (isset($_SESSION["activation_faillure_process"])): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo $_SESSION["activation_faillure_process"];
        unset($_SESSION["activation_faillure_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif (isset($_SESSION["activation_warning_process"])): ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo $_SESSION["activation_warning_process"];
        unset($_SESSION["activation_warning_process"]);
        ?>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif ?>
