<?php 

if (!($this->session->has_userdata('user_id') and $this->session->has_userdata('user_type')) and !($this->session->userdata('user_type') == 'medico' 
or $this->session->userdata('user_type') == 'master')) {

  redirect('user/login_view');

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Plan Health</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<style type="text/css">

  html, body {

    overflow-x: hidden;

  }

  .col-md-12 {
    padding-top: 10px !important;
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
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Services
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Plan Health</a>
            <a class="dropdown-item" href="<?php echo base_url('query'); ?>">Medical consultation</a>
          </div>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
        <?php if ($this->session->has_userdata('user_email')) {

         ?>
        <a class="btn btn-default" href="">User: <?php echo $this->session->userdata('user_email'); ?></a>
        <?php }else { ?>
        <a class="btn btn-default" href="#"></a>
        <?php } ?>
        <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url('user/user_logout');?>">Logout</a>
      </div>
    </div>
  </nav>

  <div class="col-md-12">
    <?php if (isset($plansUpdate)) {

      foreach ($plansUpdate as $key) {

     ?>
    <form role="form" method="post" action="<?php echo base_url('plan/create'); ?>">
      <fieldset>
        <div class="form-group">
       
          <input type="hidden" name="operation" value="update" /> 
          <input type="hidden" name="id_plan"  value="<?php echo $key->id_plano; ?>" />
          <input class="form-control" placeholder="Please enter Accommodation" name="accomodation" type="text" autofocus value="<?php echo $key->acomodacao; ?>">
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Please enter Segmentation" name="segmentation" type="text" autofocus value="<?php echo $key->segmentacao; ?>">
        </div>

        <div class="form-group">
          <select class="form-control" name="refund">
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
          </select>
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Medical Network" name="medical_network" type="text" value="<?php echo $key->rede_medica; ?>">
        </div>

        <input class="btn btn-lg btn-success btn-block" type="submit" value="Create Plan" name="register" >

      </fieldset>
    </form>

      <?php 
      
          }
          
        } else {
      
      ?>

    <form role="form" method="post" action="<?php echo base_url('plan/create'); ?>">
      <fieldset>
        <div class="form-group">
       
          <input type="hidden" name="operation" value="" /> 
          <input type="hidden" name="acomodacao"  value="" />
          <input class="form-control" placeholder="Please enter Accommodation" name="accomodation" type="text" autofocus value="">
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Please enter Segmentation" name="segmentation" type="text" autofocus value="">
        </div>

        <div class="form-group">
          <select class="form-control" name="refund">
            <option value="sim">Sim</option>
            <option value="nao">Não</option>
          </select>
        </div>

        <div class="form-group">
          <input class="form-control" placeholder="Medical Network" name="medical_network" type="text" value="">
        </div>

        <input class="btn btn-lg btn-success btn-block" type="submit" value="Create Plan" name="register" >

      </fieldset>
    </form>

    <?php } ?>

    <div class="form-group">

      <table class="table table-bordered table-striped">

        <thead>
          <tr>
            <th colspan="2"><h4 class="text-center">Plan Details</h3></th>

            </tr>
          </thead>
          <tbody>

           <?php 

           if (isset($plans)) {
   
            foreach ($plans as $key) { ?>

           <tr>
            <td>Plan Accomodation</td>
            <td><?php echo $key['acomodacao']; ?></td>
          </tr>
          <tr>
            <td>Plan Segmentation</td>
            <td><?php echo $key['segmentacao']; ?></td>
          </tr>
          <tr>
            <td>Refund</td>
            <td><?php echo $key['reembolso']; ?></td>
          </tr>
          <tr>
            <td>Medical Network</td>
            <td><?php echo $key['rede_medica']; ?></td>
          </tr>
          <tr> 
            <td style="padding-top: 20px;">
              <form action="<?php echo base_url('plan/delete'); ?>" method="POST">
                <input type="hidden" name="id_plan" value="<?php echo $key['id_plano']; ?>"/>
                <button type="submit">excluir</button>
              </form>
            </td>
            <td style="padding-top: 20px;">
              <form action="<?php echo base_url('plan/update'); ?>" method="POST">
                <input type="hidden" name="id_plan" value="<?php echo $key['id_plano']; ?>"/>
                <input type="hidden" name="operation" value="update"/>
                <button type="submit">editar</button>
              </form>
            </td>
          </tr>

        <?php 
        
            }
          } 
        
        ?>

        </tbody>

      </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
  </html>