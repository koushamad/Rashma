<?php

namespace App\Services;

use App\Repositories\Mongo\MessageRepository;
use Illuminate\Support\Collection;

class MessageService extends BaseService
{
    /** @var MessageRepository */
    protected $repository;

    public function __construct(
        MessageRepository $messageRepository
    ) {
        parent::__construct($messageRepository);
    }
}
