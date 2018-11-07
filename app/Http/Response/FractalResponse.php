<?php
namespace App\Http\Response;

use League\Fractal\Manager;
use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;

class FractalResponse
{
    private $manager;
    private $serializer;

    public function __construct(Manager $manager, SerializerAbstract $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
        $this->manager->setSerializer($serializer);
        // $this->fractal = new FractalResponse($manager, $serializer);
    }

    public function item($data, TransformerAbstract $transformer, $resourceKey = null)
    {
        $resource = new Item($data, $transformer, $resourceKey);

        return $this->manager->createData($resource)->toArray();
    }

    public function collection($data, TransformerAbstract $transformer, $resourceKey = null)
    {
        $resource = new Collection($data, $transformer, $resourceKey);
        return $this->manager->createData($resource)->toArray();
    }

    private function createDataArray(ResourceInterface $resource)
    {
        return $this->manager->createData($resource)->toArray();
    }
}