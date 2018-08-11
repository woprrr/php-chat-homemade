<?php

namespace App;

use App\Controllers\ChatRoomPage;
use App\Controllers\HomePage;
use App\Controllers\LoginPage;
use App\Controllers\Register;
use App\Controllers\SendPrivateMessage;
use App\Controllers\SendPublicMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class AppKernel implements HttpKernelInterface
{

  public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true): Response
  {
    switch ($request->getPathInfo()) {
      case '/':
        $response = new HomePage();
        $response = $response->index();
        break;

      case '/login':
        $response = new LoginPage();
        $response = $response->login();
        break;

      case '/auth':
        $response = new LoginPage();
        $response = $response->authentication($request);
        break;

      case '/logout':
        $response = new LoginPage();
        $response = $response->logoutUser();
        break;

      case '/sendPrivateMessage':
        $response = new SendPrivateMessage();
        $response = $response->privateMessage($request);
        break;

      case '/sendPublicMessage':
        $response = new SendPublicMessage();
        $response = $response->publicMessage($request);
        break;

      case '/register':
        $response = new Register();
        $response = $response->registerForm();
        break;

      case '/save':
        $response = new Register();
        $response = $response->register($request);
        break;

      case '/chatroom':
        $response = new ChatRoomPage();
        $response = $response->generalRoom();
        break;

      case '/privateroom':
        $response = new ChatRoomPage();
        $response = $response->privateRoom($request);
        break;

      default:
        $response = new Response('Not found !', Response::HTTP_NOT_FOUND);
    }

    return $response;
  }

}
