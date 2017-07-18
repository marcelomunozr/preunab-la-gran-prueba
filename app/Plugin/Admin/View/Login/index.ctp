<div id="logginBox">
            
    <?php echo $this->Session->flash(); ?>

    <form role="form" method="post">    

        <div class="form-group">
            <label for="email">Usuario</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese su email">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
        </div>               

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

