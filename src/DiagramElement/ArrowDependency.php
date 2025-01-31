<?php

declare(strict_types=1);

namespace Smeghead\PhpClassDiagram\DiagramElement;

use Smeghead\PhpClassDiagram\Php\PhpClass;

final class ArrowDependency extends Arrow
{
    protected string $figure = '..>';

    public function toString(PhpClass $toClass): string
    {
        if (strpos($this->getTo()->getName(), '[]') === false) {
            return sprintf('  %s %s %s', $this->getFrom()->getClassNameAlias(), $this->figure, $toClass->getClassNameAlias());
        }
        return sprintf('  %s "1" %s "*" %s', $this->getFrom()->getClassNameAlias(), $this->figure, str_replace('[]', '', $toClass->getClassNameAlias()));
    }
}
