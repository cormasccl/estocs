<script type="text/javascript">
        function valida () {
             var password = document.getElementById ("UserPassword");
            var password2 = document.getElementById ("UserPassword2");

          
            if (password.value != password2.value) {
                //alert ("The two passwords are different!");

                var divError = document.getElementById("msgError");
                divError.innerHTML = 'Las contraseñas no coinciden';
                divError.className = 'alert alert-danger';

                return false;
            }
        }
    </script>


<div id='content-container' class='form'>


  <?php 

  //$mensaje = $this->Session->flash();


    echo "<div id='msgError'></div>";
  
  

  echo $this->Form->create('User',array('onsubmit'=>'return valida();')); 
  echo $this->Form->input('id',array('value' => $user['User']['id'],'type'=>'hidden'))?>

  <?php 
  echo __('Hola %s',$user['User']['name'].' ('.$user['User']['username'].' )').'<br />';
  echo __('A continuación puedes introducir una nueva contraseña para acceder a la área privada de Corma.');


  echo $this->Form->input('password',array('type' => 'password','label' => __('Nueva contraseña:'),'class' => 'name'));
  echo $this->Form->input('password2',array('type' => 'password','label' => __('Repita la nueva contraseña:'),'class' => 'name'));


  echo $this->Form->submit(__('Enviar'), array('class'=>'tt-form-submit'));
  

  ?>
</div>
