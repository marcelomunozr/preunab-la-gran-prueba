<div id="header">

    <div id="top-bar" class="navbar">     
        <div class="logo"><span style="color: orange">UNAB</span> | la gran prueba</div>
        <a href="/admin/login/out" class="loggedUser pull-right">Cerrar Sesion</a>       
    </div>

    <ul id="main-menu" class="nav nav-tabs">

        <li class="<?php if ($activeTab == 'dashboard') { ?>active<?php } ?>"><a href="/admin/dashboard">Resumen</a></li>            
        <li class="<?php if ($activeTab == 'questions') { ?>active<?php } ?>"><a href="/admin/questions">Preguntas</a></li>
        <li class="<?php if ($activeTab == 'players') { ?>active<?php } ?>"><a  href="#">Jugadores</a></li>
        <li class="<?php if ($activeTab == 'reports') { ?>active<?php } ?>"><a href="#">Reportes</a></li>

    </ul>
</div>