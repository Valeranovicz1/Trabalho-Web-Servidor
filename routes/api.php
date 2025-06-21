<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuporteController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\CarrinhoController;
use App\Models\Conexao;

Route::get('/', function () {
    require_once __DIR__ . '/view/login/Login.php';
});

Route::post('/', [\App\Http\Controllers\LoginController::class, 'login']);

Route::get('/registro', function () {
    require_once __DIR__ . '/view/login/Registro.php';
});
Route::post('/registro', ['RegisterController', 'register']);


Route::get('/loja', function () {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['tipo']) || $_SESSION['usuario']['tipo'] !== 'cliente') {

        header('Location: /?erro=acesso-negado');
        exit;
    }

    $imgPathPrefix = '';

    $jogoController = new JogoController();

    $jogosAcao = $jogoController->listaJogosCategoria('Ação');
    $jogosFPS = $jogoController->listaJogosCategoria('FPS');

    require_once __DIR__ . '/view/painel/painelCliente.php';
});



Route::match(['get', 'post'], '/painel/painelEmpresa.php', function () {
    require_once __DIR__ . '/view/painel/painelEmpresa.php';
});



Route::get('/biblioteca', function () {
    
    require_once __DIR__ . '/view/navCliente/biblioteca.php';
});


Route::get('/carrinho', function () {
    $carrinhoController = new CarrinhoController();
    $idsJogosNoCarrinho = $carrinhoController->getJogosCarrinho(); // Pega os IDs da sessão

    $cartItems = [];
    $totalCarrinho = 0.0;
    // Defina seu $imgPathPrefix aqui se necessário para as imagens
    // $imgPathPrefix = '/Trabalho-Web-Servidor/'; // Exemplo

    if (!empty($idsJogosNoCarrinho)) {
        $db = Conexao::get();
        $stmt = $db->prepare("SELECT id_jogo, nome, imagem, preco, categoria FROM jogos WHERE id_jogo = :id_jogo");

        foreach ($idsJogosNoCarrinho as $idJogo) {
            $stmt->bindParam(':id_jogo', $idJogo, PDO::PARAM_INT);
            $stmt->execute();
            $item = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($item) {
                // Ajuste o caminho da imagem conforme necessário
                if (!empty($item['imagem'])) {
                    // Se $item['imagem'] é 'storage/imagens_jogos/arquivo.jpg'
                    // e a raiz do site é '/Trabalho-Web-Servidor/', o caminho completo seria:
                    // $item['imagem'] = '/Trabalho-Web-Servidor/' . $item['imagem'];
                    // Se a raiz do site já é a pasta do projeto, $item['imagem'] pode estar correto.
                } else {
                    $item['imagem'] = '/Trabalho-Web-Servidor/assets/img/placeholder.png'; // Exemplo de placeholder
                }
                $cartItems[] = $item;
                $totalCarrinho += (float)$item['preco'];
            }
        }
    }
    require_once __DIR__ . '/view/navCliente/Carrinho.php';
});


Route::get('/suporte', function () {
    require_once __DIR__ . '/view/navCliente/Suporte.php';
});


Route::get('/sobre', function () {
    require_once __DIR__ . '/view/navCliente/Sobre.php';
});

Route::post('/suporte', [\App\Http\Controllers\SuporteController::class, 'enviarMensagem']);

Route::get('/minha-conta', function () {
    require_once __DIR__ . '/view/navCliente/MinhaConta.php';
});

Route::get('/editar-conta', function () {
    require_once __DIR__ . '/view/navCliente/EditarConta.php';
});

Route::post('/editar-conta', [\App\Http\Controllers\ClienteController::class, 'editarPerfil']);

Route::get('/logout', function () {
    session_start();
    session_destroy();
    header('Location: /');
    exit;
});


Route::match(['get', 'post'], '/painelEmpresa', function () {
    require_once __DIR__ . '/view/painel/painelEmpresa.php';
});

Route::post('/api/carrinho/adicionar', function() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verifica se o usuário está logado e é um cliente
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['tipo']) || $_SESSION['usuario']['tipo'] !== 'cliente') {
        http_response_code(403); // Forbidden
        echo json_encode(['success' => false, 'message' => 'Acesso negado. Faça login como cliente para adicionar itens ao carrinho.']);
        exit;
    }

    // Pega o ID do jogo do corpo da requisição POST (assumindo que será enviado como JSON)
    $requestData = json_decode(file_get_contents('php://input'), true);
    $idJogo = $requestData['game_id'] ?? null;

    if ($idJogo === null || !is_numeric($idJogo) || (int)$idJogo <= 0) {
        http_response_code(400); // Bad Request
        echo json_encode(['success' => false, 'message' => 'ID do jogo inválido fornecido.']);
        exit;
    }

    $idJogo = (int)$idJogo;

    $carrinhoController = new CarrinhoController(); // Usa o namespace correto
    $resultadoAdicao = $carrinhoController->adicionarAoCarrinho($idJogo);

    $response = ['success' => false, 'message' => ''];
    $httpStatusCode = 200;

    if (isset($_SESSION['mensagem_sucesso'])) {
        $response['success'] = true;
        $response['message'] = $_SESSION['mensagem_sucesso'];
        unset($_SESSION['mensagem_sucesso']);
    } elseif (isset($_SESSION['mensagem_info'])) {
        // Consideramos "já no carrinho" como um tipo de sucesso informativo
        $response['success'] = true;
        $response['message'] = $_SESSION['mensagem_info'];
        unset($_SESSION['mensagem_info']);
    } elseif (isset($_SESSION['mensagem_erro'])) {
        $response['message'] = $_SESSION['mensagem_erro'];
        $httpStatusCode = 400; // Ou 500, dependendo do tipo de erro
        unset($_SESSION['mensagem_erro']);
    } elseif ($resultadoAdicao === false) { // Fallback se o controller não setou mensagem
        $response['message'] = 'Ocorreu um erro desconhecido ao adicionar o jogo ao carrinho.';
        $httpStatusCode = 500;
    }
    
    // Para feedback no cliente, podemos incluir o total de itens no carrinho
    $response['total_items'] = count($_SESSION['carrinho'] ?? []);

    http_response_code($httpStatusCode);
    header('Content-Type: App\Httplication/json');
    echo json_encode($response);
    exit;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
