<?php
namespace SchoolStore\Persistence\MySql;

use function foo\func;
use SchoolStore\Domain\Entity\AttributeEntity;
use SchoolStore\Domain\Entity\CategoryEntity;
use SchoolStore\Domain\Entity\ProductEntity;
use SchoolStore\Domain\Entity\ValueEntity;
use SchoolStore\Domain\Repository\AttributeRepositoryInterface;
use SchoolStore\Domain\Repository\CategoryRepositoryInterface;
use SchoolStore\Domain\Repository\ProductRepositoryInterface;
use SchoolStore\Domain\Repository\ValueRepositoryInterface;

class ProductTable extends AbstractTable implements ProductRepositoryInterface
{
    protected $table = 'products';
    protected $categoryRepository;
    protected $valueRepository;
    protected $attributeRepository;

    /**
     * ProductTable constructor.
     * @param \PDO $gateway
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ValueRepositoryInterface $valueRepository
     * @param AttributeRepositoryInterface $attributeRepository
     */
    public function __construct(
        \PDO $gateway,
        CategoryRepositoryInterface $categoryRepository,
        ValueRepositoryInterface $valueRepository,
        AttributeRepositoryInterface $attributeRepository
    )
    {
        parent::__construct($gateway);

        $this->categoryRepository = $categoryRepository;
        $this->valueRepository = $valueRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return array_map(function($product) {
            return $this->loadFromArray($product);
        }, parent::getAll());
    }

    /**
     * @param $categoryId
     * @return array
     */
    public function getByCategoryId($categoryId)
    {
        $sth = $this->gateway->prepare("select * from `{$this->table}` where category_id = :id");
        $sth->execute([':id' => $categoryId]);
        return array_map(function($product) {
            return $this->loadFromArray($product);
        }, $sth->fetchAll(\PDO::FETCH_ASSOC));
    }

    /**
     * @param array $filter
     * @return array
     */
    public function getByFilter(array $filter)
    {
        $attributesMap = $this->attributeRepository->getAttributesMap();
        $whereParams = [];
        foreach ($filter as $attribute => $value) {
            $whereParams[] = sprintf('exists (SELECT id FROM `values` AS v WHERE p.id = v.product_id AND v.attribute_id = %d AND v.`value` = "%s")', $attributesMap[$attribute], $value);
        }
        $where = implode(' AND ', $whereParams);
        $sql = <<<SQL
SELECT p.* FROM products AS p
WHERE {$where}
SQL;
        $res = $this->gateway->query($sql);
        return array_map(function($product) {
            return $this->loadFromArray($product);
        }, $res->fetchAll(\PDO::FETCH_ASSOC));
    }

    /**
     * @param array $product
     * @return array
     */
    private function loadFromArray(array $product)
    {
        $category = $this->categoryRepository->getById($product['category_id']);
        $categoryEntity = new CategoryEntity(... array_values($category));

        $attributesValues = [];
        $values = $this->valueRepository->getAllByProductId($product['id']);
        foreach ($values as $value) {
            $attribute = $this->attributeRepository->getById($value['attribute_id']);
            $attributeEntity = new AttributeEntity(... array_values($attribute));
            $attributesValues[] = new ValueEntity(... [$attributeEntity, $value['id'], $value['value']]);
        }

        $params = [
            $product['id'],
            $product['name'],
            $categoryEntity,
            $attributesValues
        ];
        $entity = new ProductEntity(... $params);

        return $entity->toArray();
    }
}