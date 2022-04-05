<?php

declare(strict_types=1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    private $identityMap = [];

    public function add($item, $product)
    {
        $key = $this->getGlobalKey($item['name'], $item['id']);
        $this->identityMap[$key] = $product;
    }

    public function get(string $itemName, int $itemId)
    {
        $key = $this->getGlobalKey($itemName, $itemId);
        if (isset($this->identityMap[$key])) {
            return $this->identityMap[$key];
        }
        throw new EmptyCacheException();
    }
    
    private function getGlobalKey(string $itemName, int $itemId)
    {
        return sprintf('%s.%d', $itemName, $itemId);
    }

    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = [];
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            if($this->get($item['name'], $item['id'])){
                $productList[] = $this->get($item['name'], $item['id']);
            }else{
                $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
                $this->add($item, new Entity\Product($item['id'], $item['name'], $item['price']));
            }
        }
        return $productList;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            if($this->get($item['name'], $item['id'])){
                $productList[] = $this->get($item['name'], $item['id']);
            }else{
                $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
                $this->add($item, new Entity\Product($item['id'], $item['name'], $item['price']));
            }
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = [
            [
                'id' => 1,
                'name' => 'PHP',
                'price' => 15300,
            ],
            [
                'id' => 2,
                'name' => 'Python',
                'price' => 20400,
            ],
            [
                'id' => 3,
                'name' => 'C#',
                'price' => 30100,
            ],
            [
                'id' => 4,
                'name' => 'Java',
                'price' => 30600,
            ],
            [
                'id' => 5,
                'name' => 'Ruby',
                'price' => 18600,
            ],
            [
                'id' => 8,
                'name' => 'Delphi',
                'price' => 8400,
            ],
            [
                'id' => 9,
                'name' => 'C++',
                'price' => 19300,
            ],
            [
                'id' => 10,
                'name' => 'C',
                'price' => 12800,
            ],
            [
                'id' => 11,
                'name' => 'Lua',
                'price' => 5000,
            ],
        ];

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
