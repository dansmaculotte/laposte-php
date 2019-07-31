<?php

namespace DansMaCulotte\LaPoste\Resources;

class Status
{
    /** @var string */
    public $code;

    /** @var string */
    public $date;

    /** @var string */
    public $status;

    /** @var string */
    public $message;

    /** @var string */
    public $link;

    /** @var string */
    public $type;

    public function __construct(
        string $code,
        string $message,
        string $date = null,
        string $status = null,
        string $link = null,
        string $type = null
    )
    {
        $this->code = $code;
        $this->date = $date;
        $this->status = $status;
        $this->message = $message;
        $this->link = $link;
        $this->type = $type;
    }

}
