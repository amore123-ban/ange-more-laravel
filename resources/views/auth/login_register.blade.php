<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body{
      font-family: 'Poppins', sans-serif;
    }
    .container{
      margin: 100px auto;
      border-radius:10px;
      max-width:700px;
      box-shadow:0 0 10px rgba(0,0,0,0.1);
    }
    .form-container{
      display:flex;
      justify-content: space-between;

    }
    .form{
      width:50%;
      padding:20px;
      transition: all 0.5s ease;
    }
    .img{
      width:50%;
      transition: all 0.5s ease;
    }
    .img img, .img svg{
      width: 100%;
      height:97%;
      margin:5px;
      border-radius:10px;
      object-fit:cover;
    }
    #register-form,#image-regist{
      width:50%;
      transition: all 0.5s ease;
      transform: rotateY(180deg) scale(-1, 1);
    }
    #register-form,#image-regist{
      display:none;
      width:50%;
      transition: all 0.5s ease;
    }

    .reverse{
      flex-direction: row-reverse;
    }
     .btn {
        background: #2563eb;
        color: white;
    }
    .btn:hover{
        background: #a9adb8ff;
        color: white;
    }
    img{
      width:115px;
      margin-left:33%;
    }
  </style>
</head>
<body>
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert m-3">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
<div class="container">
   
  <div class="form-container" >

    <div class="form" id="login-form">
      <img src="/images/Ezstore.png" class=""/>
      
    <h4 class="text-center mb-3">Se connecter</h4>
    <form method="POST" action="/login">
      @csrf
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre e-mail" required>
        <label class="form-label">email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe" required>
        <label  class="form-label">Mot de passe</label>
        <p class="text-center mt-3">
          <a href="/password-forgot">Mot de passe oublié ?</a>
        </p>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn ">Connexion</button>
      </div>
        <p class="text-center mt-3">
      pas de compte ? <a type="button" class="" id="register-btn">S'inscrire</a>
    </p>
    </form>
    </div>
    <div id="image-login" class="img">
      <img src="./images/Login.gif"  />
    </div>
    <div id="register-form" class="form">
      @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
      <h4 class="text-center mb-4">S'inscrire</h4>
      <form method="POST" action="/register">
        @csrf
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="Entrer votre nom" required>
          <label class="form-label">Nom</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" name="email" placeholder="Entrer votre e-mail" required>
          <label class="form-label mb-3">Adresse e-mail</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe" required>
          <label for="password" class="form-label">Mot de passe</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Entrer votre mot de passe" required>
          <label for="password" class="form-label">Confirmer mot de passe</label>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn">Inscription</button>
        </div>
          <p class="text-center mt-3">
            Deja un compte ? <a type="button" class="" id="login-btn">Se connecter</a>
          </p>
      </form>
    </div>
    <div id="image-regist" class="img">
      <img src="./images/Signup.gif"  />
    </div>
  </div>
</div>
<script>
  document.getElementById('register-btn').addEventListener('click', function(){
    document.querySelector('.form-container').classList.add('reverse');
    document.getElementById('login-form').style.display='none';
    document.getElementById('image-login').style.display='none';
    document.getElementById('register-form').style.display='block';
    document.getElementById('image-regist').style.display='block';
  })
  document.getElementById('login-btn').addEventListener("click", function(){
    document.querySelector('.form-container').classList.remove('reverse');
    document.getElementById('register-form').style.display='none';
    document.getElementById('image-regist').style.display='none';
    document.getElementById('login-form').style.display='block';
    document.getElementById('image-login').style.display='block';
  })
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
