<?php

declare(strict_types=1);

namespace verfriemelt\inserts\Entity;


use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'data_point', schema: 'docker')]
class DataPoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(name: 'value', type: Types::INTEGER)]
    public int $value;

    #[ORM\Column(name: 'created_at', type: Types::DATETIME_MUTABLE)]
    public DateTime $created;

    public function __construct(int $value)
    {
        $this->created = new DateTime();
        $this->value = $value;
    }
}
