<h2>Olá <?php echo $this->nome ?> </h2>
<p> Confirme já seu cadastro </p>
<p>Para ativar seu cadastro acesse  <a href="http://<?php echo $this->url('sonuser-activate', array('key'=>$this->activatioKey)) ?>"> AQUI</a>
