<div class="col-md-6" style="margin: 0 auto;">
<form class="form-signin" method="post" action="<?php echo $this->Url->build(['controller' => 'Usuarios', 'action' => 'cadastro']); ?>">
  <div class="text-center mb-4 p-3">
    <h1 class="h3 mb-3 font-weight-normal">Novo usuário</h1>
</div>

<div class="form-label-group">
  <input name="nome" type="text" id="inputNome" class="form-control" placeholder="Digite seu nome" required autofocus>
  <label for="inputNome">Digite seu nome</label>
</div>

  <div class="form-label-group">
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Digite seu email" required autofocus>
    <label for="inputEmail">Digite seu email</label>
  </div>

  <div class="form-label-group">
    <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha..." required>
    <label for="inputPassword">Senha...</label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; ArrayEnterprises 2019</p>
</form>
</div>
