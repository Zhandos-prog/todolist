<?php

namespace App\View;

class Home extends Base {

    public function container($data = [])
    {
        ?>
            <?php $this->header(); //print_r($data);die; ?>

              <section class="bg-light block">
                <?php if(isset($_SESSION['success'])): ?>
                  <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success']; ?>
                  </div>
                  <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error']; ?>
                  </div>
                  <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                <div class="container">
                <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Create Todo</button>
                  <div class="col-sm-3">
                  
                    <form action="" method="get">
                     <select name="sort" class="form-control" id="sort">
                        <option value="default" <?php if (@$_GET['sort'] == 'default') echo 'selected'; ?>>Default</option>
                        <option value="name" <?php if (@$_GET['sort'] == 'name') echo 'selected'; ?>>Name</option>
                        <option value="email" <?php if (@$_GET['sort'] == 'email') echo 'selected'; ?>>Email</option>
                        <option value="status" <?php if (@$_GET['sort'] == 'status') echo 'selected'; ?>>Status</option>
                      </select>
                    </form>
                  </div>
                </div>
                
                <?php if (isset($_SESSION['valid'])): ?>
                    <span class="error_message"><?php echo $_SESSION['valid']; ?></span>
                <?php unset($_SESSION['valid']); ?>
                <?php endif; ?>
                  <div class="row">
                  <table class="table m-3">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($data)): ?>
                      <?php foreach($data['tasks'] as $item): ?>
                      <tr>
                        <td><?php echo $item['name']; ?> </td>
                        <td><?php echo $item['email']; ?></td>
                        <td><?php echo $item['task']; ?></td>
                      <?php if($item['status'] == 1): ?>
                        <td>Done
                          <span class="small-text"><?php if($item['admin_edit'] == 1) {echo 'Edited by admin';}?></span>
                        </td>
                      <?php else: ?>
                        <td>Processing
                          <span class="small-text"><?php if($item['admin_edit'] == 1) {echo 'Edited by admin';}?></span>
                        </td>
                      <?php endif; ?>
                        <td>
                        <div class="btn-group">
                          <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Select option
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="/edit-task/<?=$item['id'];?>">Edit</a>
                            <a id="delete-task" class="dropdown-item" href="">Delete</a>
                            <form id="delete-form" action="/delete-task/<?=$item['id'];?>" method="post">
                              <button type="submit"></button>
                            </form>
                          </div>
                        </div>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                        <p>No Tasks</p>
                    <?php endif; ?>  
                    </tbody>
                  </table>
                  </div>
                </div>
                <?php if($data['count'] > 3): ?>
                  <div class="pagination">
                    <nav aria-label="Page navigation example">
                      <ul class="pagination">
                        <?php for($i=1; $i<=$data['page']; $i++): ?>
                          <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php endfor; ?>
                      </ul>
                    </nav>
                  </div>
                <?php endif; ?>
              </section>

              <!-- task modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">New Todo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="/add-task" method="post">
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                          </div>
                          <div class="form-group">
                            <label for="recipient-email" class="col-form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="recipient-email">
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Task</label>
                            <textarea name="task" class="form-control" id="message-text"></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                      </div>

                    </form>
                       
                  </div>
                </div>
              </div>
              <!-- modal -->

            <!-- login modal -->
              <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="/auth" method="post">
                      <div class="modal-body">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="recipient-password" class="col-form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                      </div>
                    </form>
                       
                  </div>
                </div>
              </div>
              <!-- modal -->

            <?php $this->footer() ?>
        <?php
    }
}