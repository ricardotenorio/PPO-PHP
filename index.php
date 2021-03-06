<?php 
	require __DIR__ . "/vendor/autoload.php";
	require __DIR__ . "/src/config.php";

	use Ppo\Controller\Test;
	use CoffeeCode\Router\Router;

    session_start();

	$router = new Router(ROOT);

	$router->namespace("Ppo\Controller");
	$router->group("");
	$router->get("/", "WebController:home", "web.home");

	$router->group("login");
	$router->get("/", "LoginController:page", "login.page");
	$router->post("/", "LoginController:loginAction", "login.loginAction");
	$router->get("/logout", "LoginController:logoutAction", "login.logoutAction");

	$router->group("signup");
	$router->get("/", "SignupController:page", "signup.page");
	$router->post("/", "SignupController:signupAction", "signup.signupAction");

	$router->group("postagens");
	$router->get("/", "PostagensController:page", "postagens.page");
	$router->get("/create", "PostagensController:createPostagemPage", "postagens.create");
	$router->post("/create", "PostagensController:createPostagemAction", "postagens.createAction");
	$router->get("/edit/{postagem_id}", "PostagensController:editPostagemPage", "postagens.edit");
	$router->post("/edit/{postagem_id}", "PostagensController:editPostagemAction", "postagens.editAction");
	$router->get("/minhas-postagens", "PostagensController:minhasPostagensPage", "postagens.usuario");
	$router->post("/delete", "PostagensController:deletePostagemAction", "postagens.delete");
	$router->post("/add", "PostagensController:addPostagemAction", "postagens.add");

	$router->group("disciplina");
	$router->get("/", "DisciplinaController:page", "disciplina.page");
	$router->get("/{disciplina}", "DisciplinaController:page", "disciplina.page");

	$router->group("lista");
	$router->get("/", "ListaController:page", "lista.page");
	$router->get("/create", "ListaController:createListaPage", "lista.create");
	$router->post("/create", "ListaController:createListaAction", "lista.createAction");
	$router->get("/favoritos", "ListaController:favoritosPage", "lista.favoritosPage");
	$router->post("/favoritos/remove", "ListaController:removePostagemAction", "lista.removePostagemAction");

	$router->dispatch();

	if ($router->error()) {
		$router->redirect("web.home", ["error" => $router->error()]);
	}
