<?php

namespace App\Controllers\Admin;

use App\Core\Csrf;
use App\Core\Flash;
use App\Core\View;
use App\Repositories\ClientsRepository;
use App\Repositories\ServiceOrderRepository;
use App\Services\ServiceOrderService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceOrderController
{
    private View $view;
    private ServiceOrderRepository $repo;
    private ServiceOrderService $service;
    private ClientsRepository $clientsRepo;

    public function __construct()
    {
        $this->view = new View();
        $this->repo = new ServiceOrderRepository();
        $this->service = new ServiceOrderService();
        $this->clientsRepo = new ClientsRepository();
    }

    public function index(Request $request): Response
    {
        $page = max(1, (int)$request->query->get('page', 1));
        $perPage = 5;
        $total = $this->repo->countAll();
        $serviceOrders = $this->repo->paginate($page, $perPage);
        $pages = (int)ceil($total / $perPage);
        $html = $this->view->render('admin/service_orders/index', compact('serviceOrders', 'page', 'pages'));
        return new Response($html);
    }

    public function create(): Response
    {
        $clients = $this->clientsRepo->findAll();
        $html = $this->view->render('admin/service_orders/create', [
            'csrf' => Csrf::token(), 
            'errors' => [],
            'clients' => $clients
        ]);
        return new Response($html);
    }

    public function store(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $errors = $this->service->validate($request->request->all());
        if ($errors) {
            $clients = $this->clientsRepo->findAll();
            $html = $this->view->render('admin/service_orders/create', [
                'csrf' => Csrf::token(), 
                'errors' => $errors, 
                'old' => $request->request->all(),
                'clients' => $clients
            ]);
            return new Response($html, 422);
        }
        $serviceOrder = $this->service->make($request->request->all());
        $id = $this->repo->create($serviceOrder);
        return new RedirectResponse('/admin/service-orders/show?id=' . $id);
    }

    public function show(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $serviceOrder = $this->repo->find($id);
        if (!$serviceOrder) return new Response('Ordem de Serviço não encontrada', 404);
        $html = $this->view->render('admin/service_orders/show', ['serviceOrder' => $serviceOrder]);
        return new Response($html);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $serviceOrder = $this->repo->find($id);
        if (!$serviceOrder) return new Response('Ordem de Serviço não encontrada', 404);
        $clients = $this->clientsRepo->findAll();
        $html = $this->view->render('admin/service_orders/edit', [
            'serviceOrder' => $serviceOrder, 
            'csrf' => Csrf::token(), 
            'errors' => [],
            'clients' => $clients
        ]);
        return new Response($html);
    }

    public function update(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $data = $request->request->all();
        
        $errors = $this->service->validate($data);
        if ($errors) {
            $clients = $this->clientsRepo->findAll();
            $html = $this->view->render('admin/service_orders/edit', [
                'serviceOrder' => array_merge($this->repo->find((int)$data['id']), $data), 
                'csrf' => Csrf::token(), 
                'errors' => $errors,
                'clients' => $clients
            ]);
            return new Response($html, 422);
        }
        $serviceOrder = $this->service->make($data);
        if (!$serviceOrder->id) return new Response('ID inválido', 422);
        $this->repo->update($serviceOrder);
        return new RedirectResponse('/admin/service-orders/show?id=' . $serviceOrder->id);
    }

    public function delete(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $id = (int)$request->request->get('id', 0);
        if ($id > 0) $this->repo->delete($id);
        return new RedirectResponse('/admin/service-orders');
    }
}

