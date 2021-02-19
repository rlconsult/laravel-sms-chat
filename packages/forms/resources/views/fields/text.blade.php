<x-forms::field-group
    :column-span="$field->columnSpan"
    :error-key="$field->name"
    :for="$field->id"
    :help-message="__($field->helpMessage)"
    :hint="__($field->hint)"
    :label="__($field->label)"
    :required="$field->required"
>
    <x-forms::text-input
        :autocomplete="$field->autocomplete"
        :autofocus="$field->autofocus"
        :disabled="$field->disabled"
        :error-key="$field->name"
        :extra-attributes="$field->extraAttributes"
        :id="$field->id"
        :maxLength="$field->maxLength"
        :minLength="$field->minLength"
        :name="$field->name"
        :name-attribute="$field->nameAttribute"
        :placeholder="__($field->placeholder)"
        :required="$field->required"
        :type="$field->type"
    />
</x-forms::field-group>
