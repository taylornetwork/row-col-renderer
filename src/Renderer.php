<?php


namespace TaylorNetwork\RowColRenderer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Renderer
{
    /**
     * The model class.
     *
     * @var string
     */
    protected $model;

    /**
     * All items.
     *
     * @var Collection
     */
    protected $items;

    /**
     * The maximum items per row.
     *
     * @var int
     */
    protected $maxPerRow;

    /**
     * Append class in $lastRowClass to last row.
     *
     * @var bool
     */
    protected $appendOnLastRow;

    /**
     * Append this class to the last row.
     *
     * @var string
     */
    protected $lastRowClass;

    /**
     * Renderer constructor.
     *
     * @param int $maxPerRow
     */
    public function __construct(int $maxPerRow = null)
    {
        if ($maxPerRow === null) {
            if (!isset($this->maxPerRow)) {
                $this->maxPerRow = $this->config('row_col_renderer.max_per_row', 4);
            }
        } else {
            $this->maxPerRow = $maxPerRow;
        }

        if (!isset($this->appendOnLastRow)) {
            $this->appendOnLastRow = $this->config('row_col_renderer.append_on_last_row', true);
        }

        if (!isset($this->lastRowClass)) {
            $this->lastRowClass = $this->config('row_col_renderer.class_to_append', 'mb-5');
        }
    }

    /**
     * Return default on config loading errors.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        try {
            return config($key, $default);
        } catch (\Exception $exception) {
            return $default;
        }

    }

    /**
     * Get a new instance.
     *
     * @return Renderer
     */
    public static function instance(): Renderer
    {
        return new static;
    }

    /**
     * Render HTML.
     *
     * @param int $maxPerRow
     * @return string
     */
    public function render(int $maxPerRow = null): string
    {
        if ($maxPerRow) {
            $this->maxPerRow = $maxPerRow;
        }

        $numberPerRow = $this->getNumberPerRow();
        $totalRows = $this->getTotalRows();
        $itemIterator = 0;
        $html = '';

        for ($row = 1; $row <= $totalRows; $row++) {
            $itemsInThisRow = 0;

            $html .= $this->buildRow($this->getCurrentRowClasses($row + 1 > $totalRows));

            while ($itemsInThisRow < $numberPerRow) {
                if ($itemIterator === $this->getItems()->count()) {
                    break;
                }

                $html .= $this->getView($this->getItems()[$itemIterator]);
                ++$itemIterator;
                ++$itemsInThisRow;
            }

            $html .= $this->defineCloseRow();
        }

        return $html;
    }

    /**
     * Get the calculated number per row.
     *
     * @return int
     */
    public function getNumberPerRow(): int
    {
        $num = $this->getItems()->count();
        $max = $this->maxPerRow;

        if ($num <= $max) {
            return $num;
        }

        while ($num % $max !== 0) {
            --$max;
        }

        if ($max === 1) {
            $max = $this->maxPerRow;
            while ($num / $max < 1.5) {
                --$max;
            }
        }

        return $max;
    }

    /**
     * Get all items.
     *
     * @return Collection
     */
    public function getItems(): Collection
    {
        if (!isset($this->items)) {
            $model = $this->model;
            $this->items = $model::all();
        }
        return $this->items;
    }

    /**
     * Get the total number of rows.
     *
     * @return int
     */
    public function getTotalRows(): int
    {
        return (int)ceil($this->getItems()->count() / $this->getNumberPerRow());
    }

    /**
     * Build HTML row opening tag.
     *
     * @param string $currentRowClasses
     * @return string
     */
    protected function buildRow(string $currentRowClasses = null): string
    {
        return str_replace('{row_classes}', $currentRowClasses, $this->defineOpenRow());
    }

    /**
     * Open row definition.
     *
     * @return string
     */
    protected function defineOpenRow(): string
    {
        return '<div class="{row_classes}">';
    }

    /**
     * Get current row's classes.
     *
     * @param bool $isLastRow
     * @return string
     */
    protected function getCurrentRowClasses(bool $isLastRow = false): string
    {
        $classes = $this->getClasses();

        if ($isLastRow && $this->appendOnLastRow) {
            $classes[] = $this->lastRowClass;
        }

        return implode(' ', $classes);
    }

    /**
     * Get classes to add to each row.
     *
     * @return array
     */
    public function getClasses(): array
    {
        return $this->config('row_col_renderer.row_classes', ['row', 'text-center']);
    }

    /**
     * Get the view to return.
     *
     * @param Model $item
     * @return string
     */
    public function getView(Model $item): string
    {
        return null;
    }

    /**
     * Get HTML row close tag.
     *
     * @return string
     */
    protected function defineCloseRow(): string
    {
        return '</div>';
    }

    /**
     * __call.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $class = $this->config('row_col_renderer.namespace') . ucwords($name) . 'Renderer';
        if (class_exists($class)) {
            return new $class(...$arguments);
        }

        return null;
    }
}