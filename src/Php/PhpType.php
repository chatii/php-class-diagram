<?php

declare(strict_types=1);

namespace Smeghead\PhpClassDiagram\Php;

final class PhpType
{
    private string $name;
    private string $meta;
    /** @var string[] */
    private array $namespace;
    private string $alias;
    private bool $nullable;

    /**
     * @param string[] $namespace Namespace
     * @param \PhpParser\Node\Identifier|null $alias Alias
     */
    public function __construct(array $namespace, string $meta, string $name, $alias = null, bool $nullable = false)
    {
        $this->namespace = $namespace;
        $this->meta = $meta;
        $this->name = $name;
        $this->alias = is_object($alias) ? $alias->name : '';
        $this->nullable = $nullable;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMeta(): string
    {
        return $this->meta;
    }

    public function getMetaName(): string
    {
        switch ($this->meta) {
            case 'Stmt_Interface':
                return 'interface';
            case 'Stmt_Enum':
                return 'enum';
            case 'Stmt_Trait':
                return 'class';
            default:
                return 'class';
        }
    }

    /**
     * @return string[] namespace
     */
    public function getNamespace(): array
    {
        return $this->namespace;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getNullable(): bool
    {
        return $this->nullable;
    }

    public function equals(PhpType $other): bool
    {
        if (str_replace('[]', '', $this->name) !== str_replace('[]', '', $other->name)) {
            return false;
        }
        if ($this->namespace !== $other->namespace) {
            return false;
        }
        return true;
    }
}
