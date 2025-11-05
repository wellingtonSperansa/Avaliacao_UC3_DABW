<?php

namespace App\Controllers\Admin;

use App\Core\Csrf;
use App\Core\Flash;
use App\Core\View;
use App\Repositories\ClientsRepository;
use App\Services\ClientsService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientsController
{
    private View $view;
    private ClientsRepository $repo;
    private ClientsService $service;

    public function __construct()
    {
        $this->view = new View();
        $this->repo = new ClientsRepository();
        $this->service = new ClientsService();
    }

    public function index(Request $request): Response
    {
        $page = max(1, (int)$request->query->get('page', 1));
        $perPage = 5;
        $total = $this->repo->countAll();
        $clients = $this->repo->paginate($page, $perPage);
        $pages = (int)ceil($total / $perPage);
        $html = $this->view->render('admin/clients/index', compact('clients', 'page', 'pages'));
        return new Response($html);
    }

    public function create(): Response
    {
        $html = $this->view->render('admin/clients/create', ['csrf' => Csrf::token(), 'errors' => []]);
        return new Response($html);
    }

    public function store(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $errors = $this->service->validate($request->request->all());
        if ($errors) {
                $html = $this->view->render('admin/clients/create', ['csrf' => Csrf::token(), 'errors' => $errors, 'old' => $request->request->all()]);
            return new Response($html, 422);
        }
        $client = $this->service->make($request->request->all());
        $id = $this->repo->create($client);
        return new RedirectResponse('/admin/clients/show?id=' . $id);
    }

    public function show(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $client = $this->repo->find($id);
        if (!$client) return new Response('Cliente não encontrado', 404);
        $html = $this->view->render('admin/clients/show', ['client' => $client]);
        return new Response($html);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $client = $this->repo->find($id);
        if (!$client) return new Response('Cliente não encontrado', 404);
        $html = $this->view->render('admin/clients/edit', ['client' => $client, 'csrf' => Csrf::token(), 'errors' => []]);
        return new Response($html);
    }

    public function update(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $data = $request->request->all();
        
        $errors = $this->service->validate($data);
        if ($errors) {
            $html = $this->view->render('admin/clients/edit', ['client' => array_merge($this->repo->find((int)$data['id']), $data), 'csrf' => Csrf::token(), 'errors' => $errors]);
            return new Response($html, 422);
        }
        $client = $this->service->make($data);
        if (!$client->id) return new Response('ID inválido', 422);
        $this->repo->update($client);
        return new RedirectResponse('/admin/clients/show?id=' . $client->id);
    }

    public function delete(Request $request): Response
    {

        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $id = (int)$request->request->get('id', 0);
        if ($id > 0) $this->repo->delete($id);
        return new RedirectResponse('/admin/clients');
    }
}
