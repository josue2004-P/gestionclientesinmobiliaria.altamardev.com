<?php

namespace App\Contexts\Public\Application\UseCases\Contact;

use App\Contexts\Public\Domain\Repositories\ContactMessageRepositoryInterface;

class SubmitContactMessageUseCase
{
    private ContactMessageRepositoryInterface $repository;

    public function __construct(ContactMessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data): void
    {
        $data['nombre'] = strip_tags(trim($data['nombre']));
        $data['email'] = strtolower(trim($data['email']));
        $data['mensaje'] = strip_tags(trim($data['mensaje']));

        $this->repository->save($data);
    }
}