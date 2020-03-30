<?php

if(!$this->session->has_userdata('user_id')) {

  redirect('user/login_view');
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<style type="text/css">
  .container {

    padding-top: 100px;
  }

  .col-6 {

    max-width: 100% !important;
  }
</style>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">User</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Services
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url('plan'); ?>">Plan Health</a>
            <a class="dropdown-item" href="<?php echo base_url('query'); ?>">Medical consultation</a>
          </div>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
      <?php if ($this->session->has_userdata('user_email')) { ?>
      <a class="btn btn-default" href="">User: <?php echo $this->session->userdata('user_email'); ?></a>
      <?php }else { ?>
      <a class="btn btn-default" href="#"></a>
      <?php } ?>
        <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url('user/user_logout');?>">Logout</a>
      </div>
    </div>
  </nav>
  <div class="row">
    <div class="col-12">
      <div class="col-6">

        <table class="table table-bordered table-striped">


          <tr>
            <th colspan="2"><h4 class="text-center">Users Details</h3></th>

            </tr>

            <?php 
            if (empty($arr)) {

              foreach($users as $key => $val) { 


                ?>
                <tr>
                  <td>User Name</td>
                  <td><?php echo $val['user_name'];  ?></td>
                </tr>
                <tr>
                  <td>User Email</td>
                  <td><?php echo $val['user_email'];  ?></td>
                </tr>
                <tr>
                  <td>User Age</td>
                  <td><?php echo  $val['user_age'];  ?></td>
                </tr>
                <tr>
                  <td>User Mobile</td>
                  <td><?php echo  $val['user_mobile'];  ?></td>
                </tr>
                <tr>
                  <td>User Type</td>
                  <td><?php echo  $val['user_type'];  ?></td>
                </tr>
                <tr>
                  <td>Amount receivable for health plan and consultations, Day: <?php echo date("Y-m-d H:i:s"); ?></td>
                  <td><?php echo "R$".$val['value']; ?></td>
                </tr>
                <tr> 
                  <td>
                    <form action="<?php echo base_url('user/exclude_user'); ?>" method="POST">
                      <input type="hidden" name="user_id" value="<?php echo $val['user_id']; ?>"/>
                      <button type="submit">excluir</button>
                    </form>
                  </td>
                  <td>
                    <form action="<?php echo base_url('user/list_user'); ?>" method="POST">
                      <input type="hidden" name="user_id" value="<?php echo $val['user_id']; ?>"/>
                      <button type="submit">editar</button>
                    </form>
                  </td>
                </tr>
                <?php 

              } 

            }else {
              ?>

              <?php 
              foreach($arr as $key) { 


                ?>
                <tr>
                  <td>User Name</td>
                  <td><?php echo $key->user_name; ?></td>
                </tr>
                <tr>
                  <td>User Email</td>
                  <td><?php echo $key->user_email;  ?></td>
                </tr>
                <tr>
                  <td>User Age</td>
                  <td><?php echo  $key->user_age;  ?></td>
                </tr>
                <tr>
                  <td>User Mobile</td>
                  <td><?php echo  $key->user_mobile; ?></td>
                </tr>
                <tr>
                  <td>User Type</td>
                  <td><?php echo  $key->user_type; ?></td>
                </tr>
                <tr>
                  <td>Amount receivable for health plan and consultations, Day: <?php echo date("Y-m-d H:i:s"); ?></td>
                  <td><?php echo $key->value; ?></td>
                </tr>
                <tr> <td style="padding-top: 20px;"> </td></tr>
                <?php 

              } 

            }

            ?>


          </table>
        </div>
      </div>

    </div>

    <div class="col-12">
      <form role="form" method="post" action="<?php echo base_url('user/return_user_name'); ?>">
        <fieldset>
          <div class="form-group">
            <input class="form-control" placeholder="Please enter Name" name="user_name" type="text" autofocus>
          </div>
          <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block type="submit">Pesquisar</button>
          </div>
        </fieldset>
      </form>
    </div>

    <div class="col-12">
      <?php 
      if (!empty($arr)) {

        foreach ($arr as $key) {

          ?>
          <form role="form" method="post" action="<?php echo base_url('user/update_user'); ?>">
            <fieldset>
              <div class="form-group">
                <input type="hidden" name="user_id"  value="<?php echo $key->user_id; ?>" />
                <input class="form-control" placeholder="Please enter Name" name="user_name" type="text" autofocus value="<?php echo $key->user_name; ?>">
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Please enter E-mail" name="user_email" type="email" autofocus value="<?php echo $key->user_email; ?>">
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Enter Age" name="user_age" type="number" value="<?php echo $key->user_age; ?>">
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Enter 10 diMobile No" name="user_mobile" type="number" value="<?php echo $key->user_mobile; ?>">
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="press paciente or medico or master" name="user_type" type="text" value="<?php echo $key->user_type; ?>">
              </div>

              <input class="btn btn-lg btn-success btn-block" type="submit" value="Update User" name="register" >

            </fieldset>
          </form>

          <?php 
        }

      }else {

        ?>
        <form role="form" method="post" action="">
          <fieldset>
            <div class="form-group">
              <input type="hidden" name="user_id"  value="" />
              <input class="form-control" placeholder="Please enter Name" name="user_name" type="text" autofocus value="">
            </div>

            <div class="form-group">
              <input class="form-control" placeholder="Please enter E-mail" name="user_email" type="email" autofocus value="">
            </div>

            <div class="form-group">
              <input class="form-control" placeholder="Enter Age" name="user_age" type="number" value="">
            </div>

            <div class="form-group">
              <input class="form-control" placeholder="Enter 10 diMobile No" name="user_mobile" type="number" value="">
            </div>

            <input class="btn btn-lg btn-success btn-block" type="submit" value="Update User" name="register" >

          </fieldset>
        </form>

        <?php 

      }
      ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
  </html>