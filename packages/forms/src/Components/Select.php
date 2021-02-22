<?php

namespace Filament\Forms\Components;

use Illuminate\Support\Str;

class Select extends Field
{
    use Concerns\CanBeAutofocused;
    use Concerns\CanBeCompared;
    use Concerns\CanBeDisabled;
    use Concerns\CanBeUnique;
    use Concerns\CanBeLengthConstrained;
    use Concerns\HasPlaceholder;

    public $emptyOptionsMessage = 'forms::fields.select.emptyOptionsMessage';

    public $getDisplayValue;

    public $getOptionSearchResults;

    public $noSearchResultsMessage = 'forms::fields.select.noSearchResultsMessage';

    public $options = [];

    public function __construct($name)
    {
        parent::__construct($name);

        $this->placeholder('forms::fields.select.placeholder');

        $this->getDisplayValueUsing(function ($value) {
            return $this->options[$value] ?? null;
        });

        $this->getOptionSearchResultsUsing(function ($search) {
            return collect($this->options)
                ->filter(fn ($option) => Str::of($option)->lower()->contains($search))
                ->toArray();
        });
    }

    public function emptyOptionsMessage($message)
    {
        $this->emptyOptionsMessage = $message;

        return $this;
    }

    public function getDisplayValue($value)
    {
        $callback = $this->getDisplayValue;

        return $callback($value);
    }

    public function getOptionSearchResults($search)
    {
        $search = (string) Str::of($search)->trim()->lower();

        $callback = $this->getOptionSearchResults;

        return $callback($search);
    }

    public function getDisplayValueUsing($callback)
    {
        $this->getDisplayValue = $callback;

        return $this;
    }

    public function getOptionSearchResultsUsing($callback)
    {
        $this->getOptionSearchResults = $callback;

        return $this;
    }

    public function noSearchResultsMessage($message)
    {
        $this->noSearchResultsMessage = $message;

        return $this;
    }

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }

    public function relation($name, $callback = null)
    {
        $relationName = (string) Str::of($name)->before('.');
        $displayColumnName = (string) Str::of($name)->after('.');

        $this->getDisplayValueUsing(function ($value) use ($callback, $displayColumnName, $relationName) {
            $relation = (new $this->model())->{$relationName}();

            $query = $relation->getRelated();

            if ($callback) {
                $query = $callback($query);
            }

            $record = $query->where($relation->getOwnerKeyName(), $value)->first();

            return $record ? $record->getAttributeValue($displayColumnName) : null;
        });

        $this->getOptionSearchResultsUsing(function ($search) use ($callback, $displayColumnName, $relationName) {
            $relation = (new $this->model())->{$relationName}();

            $query = $relation->getRelated();

            if ($callback) {
                $query = $callback($query);
            }

            return $query
                ->where($displayColumnName, 'like', "%{$search}%")
                ->pluck($displayColumnName, $relation->getOwnerKeyName())
                ->toArray();
        });

        $this->label(
            (string) Str::of($name)
                ->before('.')
                ->kebab()
                ->replace(['-', '_'], ' ')
                ->ucfirst(),
        );

        $setUpRules = function ($component) use ($relationName) {
            $relation = (new $component->model())->{$relationName}();

            $model = get_class($relation->getModel());
            $column = $relation->getOwnerKeyName();

            $component->addRules([$component->name => "exists:{$model},{$column}"]);
        };

        if ($this->model) {
            $setUpRules($this);
        } else {
            $this->pendingModelModifications[] = $setUpRules;
        }

        return $this;
    }
}
