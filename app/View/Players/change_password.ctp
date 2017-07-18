<div style="display: block">
    <div class="ingresa-form">
        <div class="txt-center">
        	<h2>Cambiar contraseña</h2>
        </div>
        <?php if($error == 0){ ?>
        <form action="#" id="FormPassword" method="POST">
            <input type="hidden" id="HiddenEmail" name="" value="" />
            <input id="FormEmail" name="data[Form][email]" type="text" placeholder="Confirme su e-mail" required>
            <input id="FormPassword" name="data[Form][new_password]" type="password" placeholder="Contraseña nueva" required>
            <input id="FormPasswordRep" name="data[Form][new_password_rep]" type="password" placeholder="Repetir Contraseña" required>
            <input type="submit" value="Cambiar contraseña" class="submit">
            <p class="txt-center"><small><a href="#" class="estoy-registrado">¿Ya estás registrado?</a> / <a href="#" class="la-olvide">¿Olvidaste tu contraseña?</a></small></p>
        	<?= $this->Session->flash();?>
        </form>
        <?php }else{ ?>
        	<?= $this->Session->flash();?>
        <?php } ?>
    </div>
</div>