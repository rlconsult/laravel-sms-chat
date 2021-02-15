<x-forms::field-group
    :error-key="$field->name"
    :for="$field->id"
    :help-message="__($field->helpMessage)"
    :hint="__($field->hint)"
    :label="__($field->label)"
    :required="$field->required"
>
    <x-forms::textarea
        :autocomplete="$field->autocomplete"
        :autofocus="$field->autofocus"
        :disabled="$field->disabled"
        :error-key="$field->name"
        :extra-attributes="$field->extraAttributes"
        :id="$field->id"
        :name="$field->name"
        :name-attribute="$field->nameAttribute"
        :placeholder="__($field->placeholder)"
    />
</x-forms::field-group>
