<?php 

if (!($this->session->has_userdata('user_id') and $this->session->has_userdata('user_type'))) {

    redirect('user/user_logout');

}elseif ($this->session->userdata('user_type') === 'paciente') {
    
    redirect('home');

}

/*****
 * 
 * TODO: FAZER QUERY PARA DELETAR RENDA DO MEDICO COM CONSULTA MARCADA E PRA PLANO DE SAUDE
 * 
 * DELIMITER $

CREATE TRIGGER salary_medical 
BEFORE INSERT ON consulta 
FOR EACH ROW 
BEGIN 

UPDATE user SET user.value = (user.value + NEW.consulta.value) WHERE user.user_id = NEW.fk_user_id_medical AND  user.user_type = 'medico';

END$ 

DELIMITER ;
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Plan Health</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<style type="text/css">
html,
body {

    overflow-x: hidden;

}

.col-md-12 {
    padding-top: 10px !important;
}
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url('user/list_user'); ?>">User</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <a class="btn btn-default" href="<?php echo base_url('user/list_user'); ?>">User: <?php echo $this->session->userdata('user_email'); ?></a>
                <?php }else { ?>
                <a class="btn btn-default" href="#"></a>
                <?php } ?>
                <a class="btn btn-outline-success my-2 my-sm-0"
                    href="<?php echo base_url('user/user_logout');?>">Logout</a>
            </div>
        </div>
    </nav>

    <div class="col-md-12">
        <?php if (isset($all_query_id)) {

            
            foreach ($all_query_id as $key) {
          
         ?>
        <form role="form" method="post" action="<?php echo base_url('query/create'); ?>">
            <fieldset>
                <div class="form-group">
                    <input type="hidden" name="user_id_medical" value="<?php echo $this->session->userdata('user_id'); ?>" />
                    <input type="hidden" name="operation" value="<?php echo $action; ?>" />
                    <input type="hidden" name="id_query" value="<?php echo $key->id_consulta; ?>" />
                    <textarea rows="8" class="form-control" placeholder="Please enter description the query"
                        name="description" type="text" autofocus value="">
                    <?php echo $key->description; ?>
                   </textarea>
                </div>

                <div class="form-group">
                    <input class="form-control" placeholder="Please enter date" name="date_query" type="date" autofocus
                        value="<?php echo $key->query_date; ?>">
                </div>

                <div class="form-group">
                    <select class="form-control" name="user_id">
                        <option value="">Click to view users</option>
                        <?php 
                        if (!empty($user_for_query)) {

                            foreach ($user_for_query as $keys) {

                         ?>
                        <option value="<?php echo $keys->user_id; ?>"><?php echo $keys->user_name; ?></option>
                        <?php 
                            }

                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <input class="form-control" type="number" placeholder="press value the query" name="value" value="<?php echo $key->value; ?>" />
                </div>

                <input class="btn btn-lg btn-success btn-block" type="submit" value="Update Query" name="register" />

            </fieldset>
        </form>

        <?php 
                
            }

        }else {
        
        ?>

        <form role="form" method="post" action="<?php echo base_url('query/create'); ?>">
            <fieldset>
                <div class="form-group">

                    <input type="hidden" name="operation" value="save" />
                    <input type="hidden" name="user_id_medical" value="<?php echo $this->session->userdata('user_id'); ?>" />
                    <textarea rows="8" class="form-control" placeholder="Please enter description the query"
                        name="description" type="text" autofocus value="">
                   </textarea>
                </div>

                <div class="form-group">
                    <input class="form-control" placeholder="Please enter date" name="date_query" type="date" autofocus
                        value="">
                </div>

                <div class="form-group">
                    <select class="form-control" name="user_id">
                        <option value="">Click to view users</option>
                        <?php 
                        if (!empty($user_for_query)) {

                            foreach ($user_for_query as $key) {

                         ?>
                        <option value="<?php echo $key->user_id; ?>"><?php echo $key->user_name; ?></option>
                        <?php 
                            }

                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <input class="form-control" type="number" placeholder="press value the query" name="value" />
                </div>

                <input class="btn btn-lg btn-success btn-block" type="submit" value="Create Query" name="register" />

            </fieldset>
        </form>

        <?php
        }
        
        if (isset($message)) {
                
        ?>
        <div class="alert alert-success">
            <?php print_r($message); ?>
        </div>

        <?php } ?>

        <div class="form-group">

            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th colspan="2">
                            <h4 class="text-center">Query Medical Details</h3>
                        </th>

                    </tr>
                </thead>
                <tbody>

                    <?php 

                    if (isset($all_query)) {

                        foreach ($all_query as $key) { 
                    
                    ?>
                    <tr>
                        <td>Description</td>
                        <td><?php echo $key['description']; ?></td>
                    </tr>
                    <tr>
                        <td>Query Date</td>
                        <td><?php echo $key['query_date']; ?></td>
                    </tr>

                    <tr>
                        <td style="padding-top: 20px;">
                            <form action="<?php echo base_url('query/delete'); ?>" method="POST">
                                <input type="hidden" name="id_query" value="<?php echo $key['id_consulta']; ?>" />
                                <button type="submit">excluir</button>
                            </form>
                        </td>
                        <td style="padding-top: 20px;">
                            <form action="<?php echo base_url('query/update'); ?>" method="POST">
                                <input type="hidden" name="id_query" value="<?php echo $key['id_consulta']; ?>" />

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

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>

</body>

</html>