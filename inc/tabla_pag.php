<?php 
    $cant = 8; 
    
    if(Request::get('pag')!=null){
        $pag=Request::get('pag');
        $ini=$cant*($pag-1);
    }else{
        $pag=1;
        $ini=0;
    }  
    //Filtros
    if(Request::get("usuario")!==""){
        $usu = Request::get("usuario");
    }else{
        $usu=null;
    }
    if(Request::get("categoria")!==""){
        $cate = Request::get("categoria");
    }else{
        $cate=null;
    }
    //Todas las canciones
    $todas = Cancion::getCanciones($usu,$cate,null,null);
    //Lista de canciones
    $canciones = Cancion::getCanciones($usu,$cate,$ini,$cant);
    //Filtros activos
    $query = Server::getQuery();   
?>
<!-- Tabla -->
<table class="table table-striped table-hover">
    <thead>
        <tr>            
            <th><span class="glyphicon glyphicon-picture"></span> Img</th>
            <th><span class="glyphicon glyphicon-info-sign"></span> Canción</th>
            <th><span class="glyphicon glyphicon-headphones"></span> Reproductor</th>
            <?php if($session->isLoggeg()){ echo "<th><span class='glyphicon glyphicon-cog'></span></th>";} ?>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($canciones as $cancion) {
            $tr = "<tr> ";            
            $tr .= "<td><img src='./caratulas/".$cancion->getImagen()."' width='50px'/></td><td>"
                .$cancion->getNombre()."</td>"
                . "<td><audio src='./canciones/".$cancion->getNombre()."' controls/></td>";
            if($session->isLoggeg()){ 
                if($cancion->getUsuario() === $session->get('user')->getUserName()){
                    $tr .= '<td><a id="del" title="Eliminar" class="btn btn-danger" href="php/borrar.php?c='.$cancion->getNombre().'">'
                        . '<span class="glyphicon glyphicon-remove-circle"></span></a>'
                        . ' <a title="Publicar / Ocultar" class="btn btn-success" href="php/publica.php?c='.$cancion->getNombre().'">';
                    if($cancion->getPrivada()){
                        $tr .= '<span class="glyphicon glyphicon-share"></span>';
                    }else{
                        $tr .= '<span class="glyphicon glyphicon-ban-circle"></span>';
                    }                        
                    $tr .= '</a></td>';                                      
                }else{
                    $tr .= "<td><botton title='No es el propietario de esta canción' class='btn btn-default'>--</botton> "
                        . "<botton title='No es el propietario de esta canción' class='btn btn-default'>--</botton></td>";
                }
            }else{
                $tr .= ''; 
            }
            $tr .= "</tr> ";
            echo $tr;
        }                    
    ?>           
    </tbody>
</table> 
<!-- Paginador -->
<?php
    $numPags = ceil(count($todas)/$cant);
    if(strlen($query)>0){
        $arrayQuery = Utils::queryToArray($query);
    }
    if($pag == 1){
        $disable="disabled"; 
        $ant="#";
    }else{
        $disable=""; 
        if(strlen($query)>0){
            $arrayQuery['pag'] = $pag-1;
            $ant=Server::getSelf()."?".Utils::ArrayToQuery($arrayQuery);
        }else{
            $ant=Server::getSelf()."?pag=".($pag-1);
        }
    }
    if($pag == $numPags){
        $disnext="disabled"; 
        $sig="#";
    }else{
        $disnext=""; 
        if(strlen($query)>0){
            $arrayQuery['pag'] = $pag+1;
            $sig=Server::getSelf()."?".Utils::ArrayToQuery($arrayQuery);
        }else{
            $sig=Server::getSelf()."?pag=".($pag+1);
        }        
    }
    if($numPags>1){
        echo "<div class='col-lg-12'>"; 
        echo "<ul class='pager'>
                <li class='previous ".$disable."'><a href='".$ant."'>&larr; Anterior</a></li>
                <ul class='pagination'>";
                for($j=1;$j<=$numPags;$j++){
                  if($j == $pag){
                      $a="active";
                  }else{
                      $a="";
                  }
                  if(strlen($query)>0){
                      $arrayQuery['pag'] = $j;
                      echo "<li class='".$a."'><a href='".Server::getSelf()."?".Utils::ArrayToQuery($arrayQuery)."'>".$j."</a></li>";
                  }else{
                      echo "<li class='".$a."'><a href=".Server::getSelf()."?pag=".$j.">".$j."</a></li>";
                  }
                }  
        echo  " </ul>
                <li class='next ".$disnext."'><a href='".$sig."'>Siguiente &rarr;</a></li>
            </ul>";
        echo "</div>";
    }
    
?>