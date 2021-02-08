<?php

namespace App;

class Request
{
    const STATUS_REQUESTED = 1;
    const STATUS_IN_REVIEW = 2;
    const STATUS_ACCEPTED = 3;
    const STATUS_CANCELLED = 4;

    /**
     * @var int
     */
    public $status;
    /**
     * @var string
     */
    public $requestedBy;
    /**
     * @var User
     */
    public $reviewer;
    /**
     * @var \DateTimeImmutable
     */
    public $requestedAt;
    
    public function __construct(
        RequestService $requestService,
        $requestedBy,
        \DateTime $requestedAt
    ) {
        if ($requestService->canUserRequestThings($requestedBy) === false) {
            return null;
        } else {
            $this->requestedBy = $requestedBy->getProfile()->getName();
            $this->requestedAt = $requestedAt;   
        }
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getRequestedBy()
    {
        return $this->requestedBy;
    }

    public function getReviewer()
    {
        return $this->reviewer;
    }

    public function getRequestedAt()
    {
        return $this->requestedAt;
    }
}
