<?php

namespace App\Controllers\Admin;

use App\Core\Csrf;
use App\Core\Flash;
use App\Core\View;
use App\Repositories\SupplierRepository;
use App\Services\SupplierService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierController
{
    private View $view;
    private SupplierRepository $repo;
    private SupplierService $service;

    public function __construct()
    {
        $this->view = new View();
        $this->repo = new SupplierRepository();
        $this->service = new SupplierService();
    }

    public function index(Request $request): Response
    {
        $page = max(1, (int)$request->query->get('page', 1));
        $perPage = 5;
        $total = $this->repo->countAll();
        $suppliers = $this->repo->paginate($page, $perPage);
        $pages = (int)ceil($total / $perPage);
        $html = $this->view->render('admin/suppliers/index', compact('suppliers', 'page', 'pages'));
        return new Response($html);
    }

    public function create(): Response
    {
        $html = $this->view->render('admin/suppliers/create', ['csrf' => Csrf::token(), 'errors' => []]);
        return new Response($html);
    }

    public function store(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $errors = $this->service->validate($request->request->all());
        if ($errors) {
                $html = $this->view->render('admin/suppliers/create', ['csrf' => Csrf::token(), 'errors' => $errors, 'old' => $request->request->all()]);
            return new Response($html, 422);
        }
        $supplier = $this->service->make($request->request->all());
        $id = $this->repo->create($supplier);
        return new RedirectResponse('/admin/suppliers/show?id=' . $id);
    }

    public function show(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $supplier = $this->repo->find($id);
        if (!$supplier) return new Response('Fornecedor não encontrado', 404);
        $html = $this->view->render('admin/suppliers/show', ['supplier' => $supplier]);
        return new Response($html);
    }

    public function edit(Request $request): Response
    {
        $id = (int)$request->query->get('id', 0);
        $supplier = $this->repo->find($id);
        if (!$supplier) return new Response('Fornecedor não encontrado', 404);
        $html = $this->view->render('admin/suppliers/edit', ['supplier' => $supplier, 'csrf' => Csrf::token(), 'errors' => []]);
        return new Response($html);
    }

    public function update(Request $request): Response
    {
        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $data = $request->request->all();
        
        $errors = $this->service->validate($data);
        if ($errors) {
            $html = $this->view->render('admin/suppliers/edit', ['supplier' => array_merge($this->repo->find((int)$data['id']), $data), 'csrf' => Csrf::token(), 'errors' => $errors]);
            return new Response($html, 422);
        }
        $supplier = $this->service->make($data);
        if (!$supplier->id) return new Response('ID inválido', 422);
        $this->repo->update($supplier);
        return new RedirectResponse('/admin/suppliers/show?id=' . $supplier->id);
    }

    public function delete(Request $request): Response
    {

        if (!Csrf::validate($request->request->get('_csrf'))) return new Response('Token CSRF inválido', 419);
        $id = (int)$request->request->get('id', 0);
        if ($id > 0) $this->repo->delete($id);
        return new RedirectResponse('/admin/suppliers');
    }
}

