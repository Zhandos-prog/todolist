<?php

namespace App\View\Errors;

class NotFound extends \App\View\Base {

    public function container()
    {
        ?>
            <?php $this->header(); ?>

            <section class="bg-light block">
                <div class="container">
                    <div class="block_404">
                        <h4>404|Not Found</h4>
                    </div>
                </div>
            </section>
            <?php $this->footer() ?>

        <?php
        
    }
}
