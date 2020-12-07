<?php

namespace App\View;


class Task extends Base {

    public function container($data = [])
    {
        ?>
             <?php $this->header(); ?>
                <section class="bg-light block">
                    <div class="container">
                        <div class="container-block">
                        
                            <form action="/update-task" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name<span class="req"> *</span></label>
                                    <input type="text" value="<?php echo $data['name'] ?>" name="name" class="form-control">
                                    <input type="hidden" value="<?php echo $data['id'] ?>" name="id" class="form-control">
                                    <input type="hidden" name="token" value="<?php echo $data['token']; ?>">
                                    <span class="prompt">Min 2, max 40</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email<span class="req"> *</span></label>
                                    <input type="email" value="<?php echo $data['email'] ?>" name="email" class="form-control">
                                    <span class="prompt">Example: vasya@mail.ru</span>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Task<span class="req"> *</span></label>
                                    <textarea name="task"  class="form-control"><?php echo $data['task'] ?></textarea>
                                    <span class="prompt">Min 20, max 500</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Status</label>
                                    <select name="status" class="form-control" id="exampleFormControlSelect1">
                                        <option <?php echo $data['status']==0 ? 'selected' : '' ?> value="0">Processing</option>
                                        <option <?php echo $data['status']==1 ? 'selected' : '' ?> value="1">Done</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button> <span><?php if (isset($_SESSION['valid'])): ?>
                                        <span class="error_message"><?php echo $_SESSION['valid']; ?></span>
                                        <?php unset($_SESSION['valid']); ?>
                                    <?php endif; ?></span>
                                
                            </form>
                            
                        </div>
                    </div>
                </section>
             <?php $this->footer(); ?>
        <?php
    }
}